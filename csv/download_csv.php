<?php
include 'functions.php';
$conn = getConnection();

// Set header untuk memberitahu browser bahwa ini adalah file CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="data_barang.csv"');

// Membuka output sebagai file CSV
$output = fopen('php://output', 'w');

// Menulis header kolom CSV
fputcsv($output, ['Nama Barang', 'Kategori Barang', 'Jumlah Barang', 'Harga per Unit', 'Tanggal Masuk'], ';');

$query = mysqli_query($conn, "SELECT * FROM tb_barang ORDER BY id_barang ASC");

while ($row = mysqli_fetch_assoc($query)) {
    fputcsv($output, [
        $row['nama_barang'],
        $row['kategori_barang'],
        $row['jumlah_barang'],
        $row['harga_per_unit'],
        $row['tanggal_masuk']
    ]);
}

fclose($output);
exit();
?>
