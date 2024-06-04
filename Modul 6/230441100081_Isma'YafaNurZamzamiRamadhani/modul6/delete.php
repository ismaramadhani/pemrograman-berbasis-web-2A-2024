<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "registrasi");

// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Mendapatkan NIM dari URL
if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    
    // Menghapus data mahasiswa berdasarkan NIM
    $query = "DELETE FROM biodata WHERE nim='$nim'";
    
    if (mysqli_query($koneksi, $query)) {
        // Redirect ke halaman read.php dengan pesan sukses
        header("Location: read.php?status=success");
        exit();
    } else {
        // Redirect ke halaman read.php dengan pesan error
        header("Location: read.php?status=error");
        exit();
    }
} else {
    // Redirect ke halaman read.php jika NIM tidak ditemukan
    header("Location: read.php?status=missing");
    exit();
}

// Menutup koneksi
mysqli_close($koneksi);
?>
