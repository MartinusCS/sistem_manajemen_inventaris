<?php
include 'koneksi/functions.php';
$conn = getConnection();
session_start();

// Cek jika ada pesan sukses
if (isset($_SESSION['success_message'])) {
    echo '<script>alert("' . $_SESSION['success_message'] . '");</script>';
    unset($_SESSION['success_message']); // Hapus pesan setelah ditampilkan
}

// Cek jika ada pesan error
if (isset($_SESSION['error_message'])) {
    echo '<script>alert("' . $_SESSION['error_message'] . '");</script>';
    unset($_SESSION['error_message']); // Hapus pesan setelah ditampilkan
}

// Menangani pencarian
$searchQuery = '';
if (isset($_GET['search'])) {
    $searchQuery = mysqli_real_escape_string($conn, $_GET['search']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEM MANAJEMEN INVENTARIS</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #2e2f44;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #212529;
            color: white;
            position: fixed;
            padding: 20px;
            top: 0;  /* Pastikan berada di atas */
            left: 0; /* Posisi di kiri layar */
            z-index: 1000; /* Pastikan sidebar berada di atas */
        }

        .sidebar h1 {
            font-size: 16px;
            margin: 10px auto; /* Otomatis jarak dari atas dan bawah */
            text-align: center; /* Mengatur teks berada di tengah */
            display: flex;
            justify-content: center; /* Konten Flex ditengah secara horizontal */
            align-items: center; /* Konten Flex ditengah secara vertikal */
            font-weight: bold;
        }

        .content h2 {
            font-size: 36px;
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .content h2:hover {
            color: white; /* Mengubah warna teks menjadi putih saat dihover */
        }
        

        .sidebar hr {
            border-color: #444;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 5px 0;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar ul li a:hover, .sidebar ul li a.active {
            background-color: #696969;
        }

        .content {
            margin-left: 270px; /* Menghindari sidebar */
            margin-top: 20px; /* Sedikit turun */
            padding: 20px;
            border-radius: 10px;
            max-width: 80%;
            background-color: #4a4b6f;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        .btn-add {
            background-color: #18d7c2;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            margin-right: 64.5%;
        }

        .btn-add:hover {
            background-color: #14b39e;
        }

        .search-container {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            justify-content: flex-start; /* Pindahkan ke kiri */
            align-items: center; /* Menjaga agar tombol dan input berada pada posisi yang sama */
        }

        .form-control {
            width: 200px; /* Panjang input search 50px */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <i class="bi bi-person-circle" style="font-size: 100px; display: block; text-align: center;"></i>
        <h1>GUDANG BARANG</h1>
        <hr>
        <ul>
            <li><a href="index.php" class="active"><i class="bi bi-list"></i> Barang</a></li>
        </ul>
    </div>

    <div class="content">
        <h2 class="mt-5">Data Barang</h2><br>
        <div class="search-container">
            <button class="btn btn-add" onclick="location.href='barang/tambah_barang.php';">Tambah Data</button>
            <form class="d-flex" role="search" method="GET">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?php echo $searchQuery; ?>">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>

        <table class="table table-dark table-striped mt-3">
            <thead>
                <tr>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Kategori Barang</th>
                    <th scope="col">Jumlah Barang</th>
                    <th scope="col">Harga per Unit</th>
                    <th scope="col">Tanggal Masuk</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Jika ada query pencarian
                if ($searchQuery) {
                    $query = mysqli_query($conn, "SELECT * FROM tb_barang WHERE nama_barang LIKE '%$searchQuery%' ORDER BY id_barang ASC");
                } else {
                    $query = mysqli_query($conn, "SELECT * FROM tb_barang ORDER BY id_barang ASC");
                }

                if (mysqli_num_rows($query) == 0) { ?>
                    <tr>
                        <td colspan="6">Tidak ada data</td>
                    </tr>
                <?php } else {
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($data['nama_barang']); ?></td>
                            <td><?php echo htmlspecialchars($data['kategori_barang']); ?></td>
                            <td><?php echo htmlspecialchars($data['jumlah_barang']); ?></td>
                            <td>Rp<?php echo number_format($data['harga_per_unit'], 2, ',', '.'); ?></td>
                            <td><?php echo htmlspecialchars($data['tanggal_masuk']); ?></td>
                            <td>
                                <a href="barang/edit_barang.php?id=<?php echo $data['id_barang']; ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="barang/hapus_barang.php?id=<?php echo $data['id_barang']; ?>" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" 
                                   class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                <?php } } ?>
            </tbody>
        </table>
        <a href="csv/download_csv.php" class="btn btn-success">Unduh CSV</a>
    </div>
</body>
</html>
