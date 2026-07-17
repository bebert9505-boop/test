<?php
// Tentukan URL sumber
$url = "https://raw.githubusercontent.com/bebert9505-boop/test/refs/heads/main/poco.php";

// Gunakan stream context agar request terlihat seperti browser/bot biasa
$options = [
    "http" => [
        "method" => "GET",
        "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\r\n",
        "timeout" => 5
    ]
];
$context = stream_context_create($options);

// Ambil data sebagai teks/string (jangan disimpan ke file sementara)
$res = @file_get_contents($url, false, $context);

// Proses data hanya jika berhasil diambil
if ($res !== false) {
    // PENTING: Jangan gunakan 'include' atau 'eval'
    // Cukup tampilkan atau olah datanya
    echo "Data berhasil dimuat.";
    // Jika perlu memproses logika tertentu, lakukan parsing manual, jangan dieksekusi sebagai kode PHP
} else {
    // Log kesalahan tanpa menampilkan pesan sensitif
    error_log("Gagal mengakses sumber data.");
}
?>
