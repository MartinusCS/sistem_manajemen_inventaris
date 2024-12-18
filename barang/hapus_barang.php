<?php
include '../koneksi/functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = getConnection();
    
    // Debug: Cek nilai ID
    echo "Data yang akan dihapus: " . htmlspecialchars($id) . "<br>";

    // Prepare the statement
    $stmt = $conn->prepare("DELETE FROM tb_barang WHERE id_barang = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Bind the parameter
    $stmt->bind_param("s", $id);
    if ($stmt->error) {
        die('Bind param failed: ' . htmlspecialchars($stmt->error));
    }
    
    // Execute the statement
    if ($stmt->execute()) {
        // Debug: Hapus berhasil
        echo "Data berhasil dihapus.";
        header("Location: ../index.php");
        exit;
    } else {
        echo "Gagal menghapus data: " . htmlspecialchars($stmt->error);
    }

    // Close the statement
    $stmt->close();
    // Close the connection
    $conn->close();
}
?>
