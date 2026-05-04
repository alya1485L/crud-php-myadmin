 <?php
$stmt = $conn->prepare("UPDATE tb_absensi 
                        SET nama_siswa = ?, kelas = ?, tanggal = ?, status = ?
                        WHERE id = ?");

if (!$stmt) {
    die("Prepare gagal: " . $conn->error);
}

$stmt->bind_param("ssssi", $nama_siswa, $kelas, $tanggal, $status, $id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Update gagal: " . $stmt->error;
}
?>