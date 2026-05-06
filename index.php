<?php
require_once 'config/koneksi.php';

$query = "SELECT * FROM tb_absensi ORDER BY id DESC";
$result = $conn->query($query);

if (!$result) {
  die("Query gagal: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Absensi</title>
  <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f3e5f5; /* Latar belakang ungu muda */
        margin: 0;
        padding: 40px 20px;
    }
    .container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        max-width: 900px;
        margin: 0 auto; /* Supaya posisinya di tengah */
        border-top: 5px solid #9c27b0; /* Garis atas ungu */
    }
    h2 {
        text-align: center;
        color: #7b1fa2;
        margin-top: 0;
        margin-bottom: 25px;
    }
    .btn-tambah {
        background-color: #9c27b0; /* Tombol ungu */
        color: white;
        padding: 10px 18px;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
        font-size: 14px;
        transition: background 0.3s;
        display: inline-block;
        margin-bottom: 20px;
    }
    .btn-tambah:hover {
        background-color: #7b1fa2;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #ce93d8; /* Garis tabel ungu pudar */
        padding: 12px;
        text-align: left;
    }
    th {
        background-color: #9c27b0; /* Header tabel ungu */
        color: white;
    }
    tr:nth-child(even) {
        background-color: #faf5fb; /* Efek belang-belang super tipis */
    }
    tr:hover {
        background-color: #f3e5f5; /* Warna baris saat disorot mouse */
    }
    .aksi-link {
        text-decoration: none;
        font-weight: bold;
        padding: 4px 8px;
        border-radius: 4px;
    }
    .edit { color: #1976d2; }
    .edit:hover { background-color: #e3f2fd; }
    .hapus { color: #d32f2f; }
    .hapus:hover { background-color: #ffebee; }
  </style>
</head>
<body>

<div class="container">
    <h2>Data Absensi Siswa</h2>
    
    <a href="tambah.php" class="btn-tambah">+ Tambah Data</a>

    <table>
      <tr>
        <th>No</th>
        <th>Nama Siswa</th>
        <th>Kelas</th>
        <th>Keterangan</th>
        <th>Tanggal</th>
        <th style="text-align: center;">Aksi</th>
      </tr>
      
      <?php $no = 1; while ($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= htmlspecialchars($row['nama_siswa']); ?></td>
        <td><?= htmlspecialchars($row['kelas']); ?></td>
        <td><?= htmlspecialchars($row['status']); ?></td>
        <td><?= htmlspecialchars($row['tanggal']); ?></td>
        <td style="text-align: center;">
          <a href="edit.php?id=<?= $row['id']; ?>" class="aksi-link edit">Edit</a> |
          <a href="hapus.php?id=<?= $row['id']; ?>" class="aksi-link hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
        </td>
      </tr>
      <?php } ?>
      
    </table>
</div>

</body>
</html>