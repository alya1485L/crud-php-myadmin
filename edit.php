<?php
require_once 'config/koneksi.php';

// 1. Ambil dan validasi ID dari URL
$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: index.php");
    exit;
}

// 2. Ambil data lama untuk ditampilkan di form
$stmt_select = $conn->prepare("SELECT * FROM tb_absensi WHERE id = ?");
$stmt_select->bind_param("i", $id);
$stmt_select->execute();
$result = $stmt_select->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Data tidak ditemukan!");
}

// 3. Proses Update data saat tombol simpan diklik
if (isset($_POST['update'])) {
    $nama_siswa = $_POST['nama_siswa'];
    $kelas      = $_POST['kelas'];
    $tanggal    = $_POST['tanggal'];
    $status     = $_POST['status'];

    $stmt_update = $conn->prepare("UPDATE tb_absensi SET nama_siswa=?, kelas=?, tanggal=?, status=? WHERE id=?");
    $stmt_update->bind_param("ssssi", $nama_siswa, $kelas, $tanggal, $status, $id);

    if ($stmt_update->execute()) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='index.php';</script>";
        exit;
    } else {
        echo "Gagal update: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Absensi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3e5f5; /* Background ungu muda */
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
            border-top: 5px solid #9c27b0; /* Garis ungu di atas */
        }
        h2 {
            text-align: center;
            color: #7b1fa2;
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
            box-sizing: border-box;
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
    <h2>Edit Absensi</h2>

    <form method="POST">
        <label>Nama Siswa</label>
        <input type="text" name="nama_siswa" value="<?= htmlspecialchars($data['nama_siswa']); ?>" required>

        <label>Kelas</label>
        <input type="text" name="kelas" value="<?= htmlspecialchars($data['kelas']); ?>" required>

        <label>Keterangan</label>
        <select name="status">
            <option value="Hadir" <?= $data['status'] == 'Hadir' ? 'selected' : ''; ?>>Hadir</option>
            <option value="Izin" <?= $data['status'] == 'Izin' ? 'selected' : ''; ?>>Izin</option>
            <option value="Sakit" <?= $data['status'] == 'Sakit' ? 'selected' : ''; ?>>Sakit</option>
            <option value="Alfa" <?= $data['status'] == 'Alfa' ? 'selected' : ''; ?>>Alfa</option>
        </select>

        <label>Tanggal</label>
        <input type="date" name="tanggal" value="<?= $data['tanggal']; ?>" required>

        <button type="submit" name="update">Update Data</button>
        <a href="index.php" class="btn-batal">Kembali ke Beranda</a>
    </form>
</div>

</body>
</html>