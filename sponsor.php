<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Sponsor Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Kelola Sponsor</h1></header>
<nav>
    <a href="index.php">Home</a>
    <a href="anggota.php">Anggota</a>
    <a href="event.php">Event</a>
    <a href="daftar.php">Pendaftaran</a>
    <a href="pembayaran.php">Pembayaran</a>
    <a href="sponsor.php">Sponsor</a>
</nav>
<div class="container">
    <h2>Tambah Sponsor</h2>
    <form method="post">
        <input type="text" name="nama_sponsor" placeholder="Nama Sponsor" required><br><br>
        <input type="text" name="kontak" placeholder="Kontak Sponsor" required><br><br>
        <input type="number" name="kontribusi" placeholder="Kontribusi (Rp)" required><br><br>

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

        <button type="submit" name="simpan">Simpan</button>
    </form>
    <hr>
    <h2>Data Sponsor</h2>
    <table>
        <tr><th>Nama Sponsor</th><th>Kontak</th><th>Kontribusi</th><th>Event</th><th>Aksi</th></tr>
        <?php
        if (isset($_POST['simpan'])) {
            $nama = $_POST['nama_sponsor'];
            $kontak = $_POST['kontak'];
            $kontribusi = $_POST['kontribusi'];
            $id_event = $_POST['id_event'];
            mysqli_query($koneksi, "INSERT INTO sponsor (nama_sponsor,kontak,kontribusi,id_event) 
                                    VALUES ('$nama','$kontak','$kontribusi','$id_event')");
            header("Refresh:0");
        }

        $sql = mysqli_query($koneksi, "SELECT s.id_sponsor,s.nama_sponsor,s.kontak,s.kontribusi,e.nama_event 
                                       FROM sponsor s
                                       JOIN event e ON s.id_event=e.id_event");
        while ($row = mysqli_fetch_assoc($sql)) {
            echo "<tr>
                <td>{$row['nama_sponsor']}</td>
                <td>{$row['kontak']}</td>
                <td>{$row['kontribusi']}</td>
                <td>{$row['nama_event']}</td>
                <td><a href='?hapus={$row['id_sponsor']}'>Hapus</a></td>
            </tr>";
        }

        if (isset($_GET['hapus'])) {
            $id = $_GET['hapus'];
            mysqli_query($koneksi, "DELETE FROM sponsor WHERE id_sponsor='$id'");
            header("Location: sponsor.php");
        }
        ?>
    </table>
</div>
</body>
</html>
