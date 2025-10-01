<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Kelola Pembayaran</h1></header>
<nav>
    <a href="index.php">Home</a>
    <a href="anggota.php">Anggota</a>
    <a href="event.php">Event</a>
    <a href="daftar.php">Pendaftaran</a>
    <a href="pembayaran.php">Pembayaran</a>
    <a href="sponsor.php">Sponsor</a>
</nav>
<div class="container">
    <h2>Tambah Pembayaran</h2>
    <form method="post">
        <label>Pendaftaran:</label><br>
        <select name="id_pendaftaran" required>
            <option value="">-- Pilih Pendaftaran --</option>
            <?php
            $daftar = mysqli_query($koneksi, "SELECT p.id_pendaftaran,a.nama,e.nama_event 
                                              FROM pendaftaran_event p
                                              JOIN anggota a ON p.id_anggota=a.id_anggota
                                              JOIN event e ON p.id_event=e.id_event");
            while ($d = mysqli_fetch_assoc($daftar)) {
                echo "<option value='{$d['id_pendaftaran']}'>{$d['nama']} - {$d['nama_event']}</option>";
            }
            ?>
        </select><br><br>

        <input type="number" name="jumlah" placeholder="Jumlah Bayar" required><br><br>
        <select name="status">
            <option value="pending">Pending</option>
            <option value="lunas">Lunas</option>
        </select><br><br>

        <button type="submit" name="simpan">Simpan</button>
    </form>
    <hr>
    <h2>Data Pembayaran</h2>
    <table>
        <tr><th>Nama</th><th>Event</th><th>Jumlah</th><th>Status</th><th>Aksi</th></tr>
        <?php
        if (isset($_POST['simpan'])) {
            $id_pendaftaran = $_POST['id_pendaftaran'];
            $jumlah = $_POST['jumlah'];
            $status = $_POST['status'];
            mysqli_query($koneksi, "INSERT INTO pembayaran (id_pendaftaran,jumlah,status) VALUES ('$id_pendaftaran','$jumlah','$status')");
            header("Refresh:0");
        }

        $sql = mysqli_query($koneksi, "SELECT b.id_pembayaran,a.nama,e.nama_event,b.jumlah,b.status 
                                       FROM pembayaran b
                                       JOIN pendaftaran_event p ON b.id_pendaftaran=p.id_pendaftaran
                                       JOIN anggota a ON p.id_anggota=a.id_anggota
                                       JOIN event e ON p.id_event=e.id_event");
        while ($row = mysqli_fetch_assoc($sql)) {
            echo "<tr>
                <td>{$row['nama']}</td>
                <td>{$row['nama_event']}</td>
                <td>{$row['jumlah']}</td>
                <td>{$row['status']}</td>
                <td><a href='?hapus={$row['id_pembayaran']}'>Hapus</a></td>
            </tr>";
        }

        if (isset($_GET['hapus'])) {
            $id = $_GET['hapus'];
            mysqli_query($koneksi, "DELETE FROM pembayaran WHERE id_pembayaran='$id'");
            header("Location: pembayaran.php");
        }
        ?>
    </table>
</div>
</body>
</html>
