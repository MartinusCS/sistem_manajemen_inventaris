<?php
include '../koneksi/functions.php';
$conn = getConnection();

$id_barang = $_POST['id_barang'];
$nama_barang = $_POST['nama_barang'];
$kategori_barang = $_POST['kategori_barang'];
$jumlah_barang = $_POST['jumlah_barang'];
$harga_per_unit = $_POST['harga_per_unit'];
$tanggal_masuk = $_POST['tanggal_masuk'];


$query = "UPDATE tb_barang SET nama_barang='$nama_barang', kategori_barang='$kategori_barang', jumlah_barang='$jumlah_barang', harga_per_unit='$harga_per_unit', tanggal_masuk='$tanggal_masuk' WHERE id_barang='$id_barang'";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<script>alert('Data berhasil diupdate!'); window.location='../index.php';</script>";
} else {
    echo "<script>alert('Data gagal diupdate!'); window.location='edit_pengguna.php?id=$id_barang';</script>";
}
?>
