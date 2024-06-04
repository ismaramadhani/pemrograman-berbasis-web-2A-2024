<?php
include "koneksi.php";
$nim = "";
$nama = "";
$umur = "";
$jenis_kelamin = "";
$prodi = "";
$jurusan = "";
$asal_kota = "";

if(isset($_POST['submit'])){
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $prodi = $_POST['prodi'];
    $jurusan = $_POST['jurusan'];
    $asal_kota = $_POST['asal_kota'];

    $sql = "INSERT INTO biodata (nim,nama,umur,jenis_kelamin,prodi,jurusan,asal_kota) VALUES ('$nim','$nama','$umur','$jenis_kelamin','$prodi','$jurusan','$asal_kota')";
    $q1 = mysqli_query($koneksi,$sql);
    if($q1){
        // Redirect ke halaman read setelah data berhasil ditambahkan
        header("Location: read.php");
        exit; // Pastikan untuk keluar dari skrip saat melakukan redirect
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST">
        <h2> Tambah Data Mahasiswa </h2>
        <!-- Hapus input hidden untuk ID jika tidak digunakan -->
        <label>NIM:</label>
        <input type="text" name="nim" value="<?php echo $nim ?>" ++>
        <label>Nama:</label>
        <input type="text" name="nama" value="<?php echo $nama ?>" required>
        <label>Umur:</label>
        <input type="text" name="umur" value="<?php echo $umur ?>" required>
        <label>Jenis Kelamin:</label>
        <input type="text" name="jenis_kelamin" value="<?php echo $jenis_kelamin ?>" required>
        <label>Prodi:</label>
        <input type="text" name="prodi" value="<?php echo $prodi ?>" required>
        <label>Jurusan:</label>
        <input type="text" name="jurusan" value="<?php echo $jurusan ?>" required>
        <label>Kota:</label>
        <input type="text" name="asal_kota" value="<?php echo $asal_kota ?>" required>
        <button type="submit" name="submit">Tambah</button>
    </form>
</body>
</html>
