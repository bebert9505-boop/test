<?php
// Gunakan API resmi GitHub
$url = "https://api.github.com/repos/bebert9505-boop/test/contents/poco.html";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// GitHub API WAJIB menyertakan User-Agent yang jelas
curl_setopt($ch, CURLOPT_USERAGENT, "Aplikasi-Saya-v1.0");
// Jika repositori bersifat privat, Anda harus menambahkan token otentikasi di sini

$response = curl_exec($ch);
curl_close($ch);

if ($response) {
    $data = json_decode($response, true);
    if (isset($data['content'])) {
        // Konten dari API dienkripsi dengan Base64, kita perlu mendekripsinya
        $html = base64_decode($data['content']);
        echo $html;
    } else {
        echo "File tidak ditemukan atau akses ditolak.";
    }
} else {
    echo "Gagal menghubungi GitHub API.";
}
?>
