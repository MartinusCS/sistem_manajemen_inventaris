<?php
session_start();
include '../koneksi/functions.php';
$conn = getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST['nama_barang'];
    $kategori_barang = $_POST['kategori_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $harga_per_unit = $_POST['harga_per_unit'];
    $tanggal_masuk = $_POST['tanggal_masuk'];

    // Persiapkan statement
    $sql = "INSERT INTO tb_barang (nama_barang, kategori_barang, jumlah_barang, harga_per_unit, tanggal_masuk) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameter
    // Ubah tipe data parameter pada bind_param
    $stmt->bind_param("ssiis", $nama_barang, $kategori_barang, $jumlah_barang, $harga_per_unit, $tanggal_masuk);

    // Eksekusi statement
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Data Barang berhasil ditambahkan";
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Data Barang gagal ditambahkan: " . $stmt->error;
        header("Location: ../index.php");
        exit();
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>
