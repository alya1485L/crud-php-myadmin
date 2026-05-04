<?php
require_once 'config/koneksi.php';

// Validasi ID dari URL
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    die('ID tidak valid');
}

// Prepare query
$stmt = $conn->prepare("DELETE FROM tb_absensi WHERE id = ?");

if (!$stmt) {
    die('Prepare gagal: ' . $conn->error);
}

// Bind parameter
$stmt->bind_param("i", $id);

// Eksekusi
if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal menghapus data: " . $stmt->error;
}
?>