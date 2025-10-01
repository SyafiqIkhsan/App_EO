<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Anggota</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Kelola Anggota Komunitas</h1></header>
<nav>
    <a href="index.php">Home</a>
    <a href="anggota.php">Anggota</a>
    <a href="event.php">Event</a>
    <a href="daftar.php">Pendaftaran</a>
    <a href="pembayaran.php">Pembayaran</a>
    <a href="sponsor.php">Sponsor</a>
</nav>
<div class="container">
    <h2>Tambah Anggota</h2>
    <form method="post">
        <input type="text" name="nama" placeholder="Nama Anggota" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="text" name="no_hp" placeholder="No HP" required><br><br>
        <input type="text" name="komunitas" placeholder="Komunitas" required><br><br>
        <button type="submit" name="simpan">Simpan</button>
    </form>
    <hr>
    <h2>Daftar Anggota</h2>
    <table>
        <tr><th>Nama</th><th>Email</th><th>No HP</th><th>Komunitas</th><th>Aksi</th></tr>
        <?php
        if (isset($_POST['simpan'])) {
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $hp = $_POST['no_hp'];
            $komunitas = $_POST['komunitas'];
            mysqli_query($koneksi, "INSERT INTO anggota (nama,email,no_hp,komunitas) VALUES ('$nama','$email','$hp','$komunitas')");
            header("Refresh:0");
        }

        $sql = mysqli_query($koneksi, "SELECT * FROM anggota");
        while ($row = mysqli_fetch_assoc($sql)) {
            echo "<tr>
                <td>{$row['nama']}</td>
                <td>{$row['email']}</td>
                <td>{$row['no_hp']}</td>
                <td>{$row['komunitas']}</td>
                <td><a href='?hapus={$row['id_anggota']}'>Hapus</a></td>
            </tr>";
        }

        if (isset($_GET['hapus'])) {
            $id = $_GET['hapus'];
            mysqli_query($koneksi, "DELETE FROM anggota WHERE id_anggota='$id'");
            header("Location: anggota.php");
        }
        ?>
    </table>
</div>
</body>
</html>
