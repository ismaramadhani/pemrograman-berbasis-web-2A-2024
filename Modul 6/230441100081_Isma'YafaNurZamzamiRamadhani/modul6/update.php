<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "registrasi"); // Sesuaikan dengan nama database anda

// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_nim = mysqli_real_escape_string($koneksi, $_POST['old_nim']);
    $nim = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $umur = mysqli_real_escape_string($koneksi, $_POST['umur']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $prodi = mysqli_real_escape_string($koneksi, $_POST['prodi']);
    $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
    $asal_kota = mysqli_real_escape_string($koneksi, $_POST['asal_kota']);

    // Cek apakah NIM baru sudah ada di database
    $check_nim = mysqli_query($koneksi, "SELECT nim FROM biodata WHERE nim = '$nim' AND nim != '$old_nim'");
    if (mysqli_num_rows($check_nim) > 0) {
        echo "NIM baru sudah ada, gunakan NIM lain.";
        exit();
    }

    // Query untuk memperbarui data
    $query = "UPDATE biodata SET nim='$nim', nama='$nama', umur='$umur', jenis_kelamin='$jenis_kelamin', prodi='$prodi', jurusan='$jurusan', asal_kota='$asal_kota' WHERE nim='$old_nim'";

    if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil diperbarui";
        header("Location: read.php"); // Redirect ke halaman read.php setelah update
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi); // Tutup koneksi
?>
