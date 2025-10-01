<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id_anggota=$id");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];

    $update = mysqli_query($koneksi, "UPDATE anggota 
        SET nama='$nama', email='$email', telepon='$telepon' 
        WHERE id_anggota=$id");

    if ($update) {
        header("Location: index.php");
    } else {
        echo "Update gagal: " . mysqli_error($koneksi);
    }
}
?>

<h2>Edit Anggota</h2>
<form method="POST">
    Nama: <input type="text" name="nama" value="<?= $data['nama'] ?>"><br>
    Email: <input type="text" name="email" value="<?= $data['email'] ?>"><br>
    Telepon: <input type="text" name="telepon" value="<?= $data['telepon'] ?>"><br>
    <button type="submit" name="submit">Update</button>
</form>
