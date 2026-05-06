<?php
require_once 'config/koneksi.php';

// Cek apakah id ada
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID tidak ditemukan");
}

$id = intval($_GET['id']); // biar aman (hindari SQL injection)

// Query hapus
$query = "DELETE FROM tb_absensi WHERE id=$id";

if ($conn->query($query)) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal hapus: " . $conn->error;
}
?>