<?php
require_once 'config/koneksi.php';

$query  = "SELECT * FROM tb_absensi ORDER BY id DESC";
$result = $conn->query($query);

if (!$result) {
    die('Query error: ' . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Absensi</title>
</head>
<body>

<h2>Data Absensi Siswa</h2>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Siswa</th>
        <th>Kelas</th>
        <th>Tanggal</th>
        <th>Status</th>
    </tr>

    <?php $no = 1; ?>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($row['nama_siswa']); ?></td>
        <td><?= htmlspecialchars($row['kelas']); ?></td>
        <td><?= $row['tanggal']; ?></td>
        <td><?= $row['status']; ?></td>
        </td>
    </tr>
    <?php endwhile; ?>

    <style>
    table {
        margin: 0 auto; /* bikin ke tengah */
        border-collapse: collapse;
        width: 70%;
        font-family: Arial, sans-serif;
    }

    th {
        background-color: #a7edfa; /* warna header */
        color: white;
    }

    th, td {
        padding: 10px;
        text-align: center;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2; /* zebra strip */
    }

    tr:hover {
        background-color: #ddd; /* efek hover */
    }
</style>
</table>

</body>
</html>