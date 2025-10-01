<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Event Organizer Komunitas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Event Organizer Komunitas</h1>
</header>
<nav>
    <a href="index.php">Home</a>
    <a href="anggota.php">Anggota</a>
    <a href="event.php">Event</a>
    <a href="daftar.php">Pendaftaran</a>
    <a href="pembayaran.php">Pembayaran</a>
    <a href="sponsor.php">Sponsor</a>
</nav>
<div class="container">
    <h2>Daftar Event</h2>
    <table>
        <tr>
            <th>Nama Event</th>
            <th>Tanggal</th>
            <th>Lokasi</th>
            <th>Deskripsi</th>
        </tr>
        <?php
        $sql = mysqli_query($koneksi, "SELECT * FROM event ORDER BY tanggal DESC");
        while ($row = mysqli_fetch_assoc($sql)) {
            echo "<tr>
                <td>{$row['nama_event']}</td>
                <td>{$row['tanggal']}</td>
                <td>{$row['lokasi']}</td>
                <td>{$row['deskripsi']}</td>
            </tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
