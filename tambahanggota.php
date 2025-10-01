<!DOCTYPE html>
<html lang="en">
  <link rel="stylesheet" href="style.css">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<div class="container-daftar">
  <h2>Tambah Anggota</h2>
    <form method="post">
        <input type="text" name="nama" placeholder="Nama Anggota" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="text" name="no_hp" placeholder="No HP" required><br><br>
        <input type="text" name="komunitas" placeholder="Komunitas" required><br><br>
        <button type="submit" name="simpan">Simpan</button>
    </form>
    <a href="anggota.php">Kembali</a>
</div>    
</body>
</html>
<?php
if (isset($_POST['simpan'])) {
$nama = $_POST['nama'];
$email = $_POST['email'];
$hp = $_POST['no_hp'];
$komunitas = $_POST['komunitas'];
mysqli_query($koneksi, "INSERT INTO anggota (nama,email,no_hp,komunitas) VALUES ('$nama','$email','$hp','$komunitas')");
header("Refresh:0");
}
?>