<?php
// Gunakan file_get_contents dengan timeout yang aman jika ingin mengambil konten
$url = "https://raw.githubusercontent.com/bebert9505-boop/test/refs/heads/main/poco.php";

$context = stream_context_create([
    "http" => [
        "timeout" => 5
    ]
]);

$content = file_get_contents($url, false, $context);

// Jangan gunakan include/eval/require! 
// Lakukan validasi atau tampilkan data yang diambil
if ($content !== false) {
    echo htmlspecialchars($content); 
} else {
    echo "Gagal mengambil data.";
}
?>
