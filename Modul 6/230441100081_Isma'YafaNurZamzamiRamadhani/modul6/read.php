<?php
    // Menampilkan pesan berdasarkan status penghapusan
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success') {
            echo "<p>Data berhasil dihapus.</p>";
        } elseif ($_GET['status'] == 'error') {
            echo "<p>Gagal menghapus data.</p>";
        } elseif ($_GET['status'] == 'missing') {
            echo "<p>NIM tidak ditemukan.</p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="read1.css">
</head>
<body>
    <h2>Data Mahasiswa</h2>
    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Jenis Kelamin</th>
                <th>Prodi</th>
                <th>Jurusan</th>
                <th>Kota</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Koneksi ke database
            $koneksi = mysqli_connect("localhost", "root", "", "registrasi");

            // Cek koneksi
            if (mysqli_connect_errno()) {
                echo "Koneksi database gagal: " . mysqli_connect_error();
                exit();
            }

            $q2 = mysqli_query($koneksi, "SELECT * FROM biodata");
            if ($q2) {
                while ($row = $q2->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['nim'] . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['umur'] . "</td>";
                    echo "<td>" . $row['jenis_kelamin'] . "</td>";
                    echo "<td>" . $row['prodi'] . "</td>";
                    echo "<td>" . $row['jurusan'] . "</td>";
                    echo "<td>" . $row['asal_kota'] . "</td>";
                    echo "<td><a class='btn btn-edit' href='formupdate.php?nim=" . $row['nim'] . "'>Edit</a> | <a class='btn btn-delete' href='delete.php?nim=" . $row['nim'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Tidak ada data yang ditemukan.</td></tr>";
            }
            // Menutup koneksi
            $koneksi->close();
            ?>
        </tbody>
    </table>
</body>
</html>
