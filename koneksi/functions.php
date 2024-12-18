<?php
function getConnection() {
    $servername = "localhost"; // Ganti dengan nama server database jika tidak menggunakan server lokal
    $username = "root"; // Ganti dengan username database
    $password = ""; // Ganti dengan password database
    $dbname = "dbgudang"; // Ganti dengan nama database

    // Buat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    return $conn;
}
?>
