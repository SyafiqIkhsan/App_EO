<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Kelola Event</h1></header>
<nav>
    <a href="index.php">Home</a>
    <a href="anggota.php">Anggota</a>
    <a href="event.php">Event</a>
    <a href="daftar.php">Pendaftaran</a>
    <a href="pembayaran.php">Pembayaran</a>
    <a href="sponsor.php">Sponsor</a>
</nav>
<div class="container">
    <h2>Tambah Event</h2>
    <form method="post">
        <input type="text" name="nama_event" placeholder="Nama Event" required><br><br>
        <input type="date" name="tanggal" required><br><br>
        <input type="text" name="lokasi" placeholder="Lokasi" required><br><br>
        <textarea name="deskripsi" placeholder="Deskripsi"></textarea><br><br>
        <button type="submit" name="simpan">Simpan</button>
    </form>
    <hr>
    <h2>Daftar Event</h2>
    <table>
        <tr><th>Nama Event</th><th>Tanggal</th><th>Lokasi</th><th>Aksi</th></tr>
        <?php
        if (isset($_POST['simpan'])) {
            $nama = $_POST['nama_event'];
            $tgl  = $_POST['tanggal'];
            $lok  = $_POST['lokasi'];
            $desc = $_POST['deskripsi'];
            mysqli_query($koneksi, "INSERT INTO event (nama_event,tanggal,lokasi,deskripsi) VALUES ('$nama','$tgl','$lok','$desc')");
            header("Refresh:0");
        }

        $sql = mysqli_query($koneksi, "SELECT * FROM event");
        while ($row = mysqli_fetch_assoc($sql)) {
            echo "<tr>
                <td>{$row['nama_event']}</td>
                <td>{$row['tanggal']}</td>
                <td>{$row['lokasi']}</td>
                <td><a href='?hapus={$row['id_event']}'>Hapus</a></td>
            </tr>";
        }

        if (isset($_GET['hapus'])) {
            $id = $_GET['hapus'];
            mysqli_query($koneksi, "DELETE FROM event WHERE id_event='$id'");
            header("Location: event.php");
        }
        ?>
    </table>
</div>
</body>
</html>
