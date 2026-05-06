<?php
require_once 'config/koneksi.php';

if (isset($_POST['simpan'])) {
    $nama  = $_POST['nama_siswa'];
    $kelas = $_POST['kelas'];
    $ket   = $_POST['keterangan'];
    $tgl   = $_POST['tanggal'];

    // Query memasukkan data ke database
    $query = "INSERT INTO tb_absensi (nama_siswa, kelas, status, tanggal)
              VALUES ('$nama', '$kelas', '$ket', '$tgl')";

    if ($conn->query($query)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Absensi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3e5f5; /* Warna background ungu sangat muda */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 350px;
            border-top: 5px solid #9c27b0; /* Garis atas warna ungu */
        }
        h2 {
            text-align: center;
            color: #7b1fa2; /* Tulisan judul ungu */
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #4a148c;
            font-weight: bold;
            font-size: 14px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ce93d8;
            border-radius: 6px;
            box-sizing: border-box; /* Biar padding gak ngerusak lebar */
        }
        input:focus, select:focus {
            outline: none;
            border-color: #9c27b0;
            box-shadow: 0 0 5px rgba(156, 39, 176, 0.3);
        }
        button {
            width: 100%;
            background-color: #9c27b0; /* Tombol warna ungu */
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: background 0.3s;
        }
        button:hover {
            background-color: #7b1fa2;
        }
        .btn-batal {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #9c27b0;
            font-size: 14px;
        }
        .btn-batal:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Absensi</h2>
    
    <form method="POST">
        <label>Nama Siswa</label>
        <input type="text" name="nama_siswa" placeholder="Masukkan nama..." required>

        <label>Kelas</label>
        <input type="text" name="kelas" placeholder="Contoh: XII PPLG" required>

        <label>Keterangan</label>
        <select name="keterangan">
            <option value="Hadir">Hadir</option>
            <option value="Izin">Izin</option>
            <option value="Sakit">Sakit</option>
            <option value="Alfa">Alfa</option>
        </select>

        <label>Tanggal</label>
        <input type="date" name="tanggal" required value="<?= date('Y-m-d'); ?>">

        <button type="submit" name="simpan">Simpan Data</button>
        <a href="index.php" class="btn-batal">Kembali ke Beranda</a>
    </form>
</div>

</body>
</html>