<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .form-container {
            background-color: #4a4b6f;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }

        .btn-add {
            background-color: #18d7c2;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-add:hover {
            background-color: #14b39e;
        }

        .btn-secondary {
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-secondary:hover {
            background-color: gray;
            color: black; 
        }

        .form-label {
            font-weight: bold;
            color: #fff;
        }

        table {
            color: #fff;
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
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <i class="bi bi-person-circle" style="font-size: 100px; display: block; text-align: center;"></i>
        <h1>GUDANG BARANG</h1>
        <hr>
        <ul>
            <li><a href="../index.php" class="active"><i class="bi bi-list"></i> Barang</a></li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        <h2 class="mt-5">Tambah Barang</h2>

        <!-- Form Tambah Barang -->
<div class="form-container">
    <form id="formBarang" method="POST" action="simpan_barang.php">
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control w-50" id="nama_barang" name="nama_barang" placeholder="Nama Barang" required>
        </div>
        <div class="mb-3">
        <label for="kategori_barang" class="form-label">Kategori Barang</label>
            <select class="form-control w-50" id="kategori_barang" name="kategori_barang" required>
                <option value="" disabled selected>Pilih Kategori</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Pakaian">Pakaian</option>
                <option value="Makanan">Makanan</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah_barang" class="form-label">Jumlah</label>
            <input type="number" class="form-control w-50" id="jumlah_barang" name="jumlah_barang" placeholder="Jumlah Barang" required min="0">
        </div>
        <div class="mb-3">
            <label for="harga_per_unit" class="form-label">Harga/Unit</label>
            <input type="number" class="form-control w-50" id="harga_per_unit" name="harga_per_unit" placeholder="Harga/Unit" required min="0">
        </div>
        <div class="mb-3">
            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
            <input type="date" class="form-control w-50 custom-date" id="tanggal_masuk" name="tanggal_masuk" required>
        </div>
        <div class="text-end mt-4">
            <button type="submit" class="btn btn-add">Tambah Barang</button>
            <a href="../index.php" class="btn btn-secondary ms-2">Kembali</a>
        </div>
    </form>
</div>


    <!-- Link Bootstrap JS (Optional for form validation or interactive elements) -->
    <script>
        document.getElementById('tanggal_masuk').setAttribute('max', new Date().toISOString().split('T')[0]);
    </script>
</body>
</html>
