<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "registrasi");

// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Mendapatkan NIM dari URL
$nim = $_GET['nim'];

// Mendapatkan data mahasiswa berdasarkan NIM
$q = mysqli_query($koneksi, "SELECT * FROM biodata WHERE nim='$nim'");
$data = $q->fetch_assoc();

// Form untuk update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim_baru = $_POST['nim']; // Menangkap NIM baru
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $prodi = $_POST['prodi'];
    $jurusan = $_POST['jurusan'];
    $asal_kota = $_POST['asal_kota'];

    $query = "UPDATE biodata SET nim='$nim_baru', nama='$nama', umur='$umur', jenis_kelamin='$jenis_kelamin', prodi='$prodi', jurusan='$jurusan', asal_kota='$asal_kota' WHERE nim='$nim'";

    if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil diupdate.";
        // Redirect to the list page after update
        header("Location: read.php");
        exit();
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Update Data Mahasiswa</h2>
    <form method="POST" action="">
        <label>NIM:</label>
        <input type="text" name="nim" value="<?php echo $data['nim']; ?>"><br>
        <label>Nama:</label>
        <input type="text" name="nama" value="<?php echo $data['nama']; ?>"><br>
        <label>Umur:</label> 
        <input type="text" name="umur" value="<?php echo $data['umur']; ?>"><br>
        <label>Jenis Kelamin:</label> 
        <input type="text" name="jenis_kelamin" value="<?php echo $data['jenis_kelamin']; ?>"><br>
        <label>Prodi:</label>
        <input type="text" name="prodi" value="<?php echo $data['prodi']; ?>"><br>
        <label>Jurusan:</label>
        <input type="text" name="jurusan" value="<?php echo $data['jurusan']; ?>"><br>
        <label>Kota:</label>
        <input type="text" name="asal_kota" value="<?php echo $data['asal_kota']; ?>"><br>
        <button type="submit" value="Update"> Update </button>
    </form>
</body>
</html>
