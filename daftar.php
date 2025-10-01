<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Pendaftaran Event</h1></header>
<nav>
    <a href="index.php">Home</a>
    <a href="anggota.php">Anggota</a>
    <a href="event.php">Event</a>
    <a href="daftar.php">Pendaftaran</a>
    <a href="pembayaran.php">Pembayaran</a>
    <a href="sponsor.php">Sponsor</a>
</nav>
<div class="container">
    <h2>Daftar Anggota ke Event</h2>
    <form method="post">
        <label>Anggota:</label><br>
        <select name="id_anggota" required>
            <option value="">-- Pilih Anggota --</option>
            <?php
            $anggota = mysqli_query($koneksi, "SELECT * FROM anggota");
            while ($a = mysqli_fetch_assoc($anggota)) {
                echo "<option value='{$a['id_anggota']}'>{$a['nama']} - {$a['komunitas']}</option>";
            }
            ?>
        </select><br><br>

        <label>Event:</label><br>
        <select name="id_event" required>
            <option value="">-- Pilih Event --</option>
            <?php
            $event = mysqli_query($koneksi, "SELECT * FROM event");
            while ($e = mysqli_fetch_assoc($event)) {
                echo "<option value='{$e['id_event']}'>{$e['nama_event']} ({$e['tanggal']})</option>";
            }
            ?>
        </select><br><br>

        <button type="submit" name="simpan">Daftar</button>
    </form>
    <hr>
    <h2>Data Pendaftaran</h2>
    <table>
        <tr><th>Nama Anggota</th><th>Event</th><th>Tanggal Daftar</th><th>Aksi</th></tr>
        <?php
        if (isset($_POST['simpan'])) {
            $id_anggota = $_POST['id_anggota'];
            $id_event = $_POST['id_event'];
            mysqli_query($koneksi, "INSERT INTO pendaftaran_event (id_anggota,id_event) VALUES ('$id_anggota','$id_event')");
            header("Refresh:0");
        }

        $sql = mysqli_query($koneksi, "SELECT p.id_pendaftaran,a.nama,e.nama_event,p.tanggal_daftar 
                                       FROM pendaftaran_event p 
                                       JOIN anggota a ON p.id_anggota=a.id_anggota
                                       JOIN event e ON p.id_event=e.id_event");
        while ($row = mysqli_fetch_assoc($sql)) {
            echo "<tr>
                <td>{$row['nama']}</td>
                <td>{$row['nama_event']}</td>
                <td>{$row['tanggal_daftar']}</td>
                <td><a href='?hapus={$row['id_pendaftaran']}'>Hapus</a></td>
            </tr>";
        }

        if (isset($_GET['hapus'])) {
            $id = $_GET['hapus'];
            mysqli_query($koneksi, "DELETE FROM pendaftaran_event WHERE id_pendaftaran='$id'");
            header("Location: daftar.php");
        }
        ?>
    </table>
</div>
</body>
</html>
