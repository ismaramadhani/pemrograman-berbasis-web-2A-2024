<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Cek apakah data mahasiswa sudah ada di sesi
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

// Ambil data mahasiswa dari sesi
$students = $_SESSION['students'];

$editIndex = null;
$editStudent = ['nim' => '', 'name' => '', 'address' => '', 'year' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        // Handle add
        $students[] = [
            'nim' => $_POST['nim'],
            'name' => $_POST['name'],
            'address' => $_POST['address'],
            'year' => $_POST['year'],
        ];
    } elseif (isset($_POST['update'])) {
        // Handle update
        $id = $_POST['id'];
        $students[$id] = [
            'nim' => $_POST['nim'],
            'name' => $_POST['name'],
            'address' => $_POST['address'],
            'year' => $_POST['year'],
        ];
    } elseif (isset($_POST['delete'])) {
        // Handle delete
        $id = $_POST['id'];
        array_splice($students, $id, 1);
    } elseif (isset($_POST['edit'])) {
        // Handle edit
        $editIndex = $_POST['id'];
        $editStudent = $students[$editIndex];
    }

    // Simpan data mahasiswa ke sesi
    $_SESSION['students'] = $students;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

h1 {
    color: #333;
    font-size: 2em;
    margin-bottom: 20px;
}

nav {
    margin-bottom: 20px;
}

nav a {
    text-decoration: none;
    color: white;
    background-color: #007bff;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background-color 0.3s;
    font-size: 1rem;
}

nav a:hover {
    background-color: #0056b3;
}

form {
  width: 400px;
  margin: 50px auto;
  padding: 60px;
  background: #fff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form h2 {
    margin-top: 0;
    margin-bottom: 20px;
}

form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

form input[type="text"] {
    width: calc(100% - 22px);
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

form button {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

form button:hover {
    background-color: #218838;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin: 20px 0;
}

table,
th,
td {
  border: 1px solid #ddd;
}

table th,
table td {
  padding: 10px;
  text-align: left;
}

table button {
    background-color: #007bff;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.3s;
}

table button:hover {
    background-color: #0056b3;
}

table button + button {
    margin-left: 5px;
}

    </style>
</head>
<body>
    <h1>Data Mahasiswa</h1>
    <nav>
        <a href="home.php">Home</a> | <a href="logout.php">Logout</a>
    </nav>
    <form method="post">
        <h2><?php echo is_null($editIndex) ? 'Tambah Data Mahasiswa' : 'Edit Data Mahasiswa'; ?></h2>
        <input type="hidden" name="id" value="<?php echo $editIndex; ?>">
        <label>NIM:</label>
        <input type="text" name="nim" value="<?php echo htmlspecialchars($editStudent['nim']); ?>" required>
        <label>Nama:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($editStudent['name']); ?>" required>
        <label>Alamat:</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($editStudent['address']); ?>" required>
        <label>Angkatan:</label>
        <input type="text" name="year" value="<?php echo htmlspecialchars($editStudent['year']); ?>" required>
        <button type="submit" name="<?php echo is_null($editIndex) ? 'add' : 'update'; ?>">
            <?php echo is_null($editIndex) ? 'Tambah' : 'Update'; ?>
        </button>
    </form>

    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Angkatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $id => $student): ?>
                <tr>
                    <form method="post">
                        <td><?php echo htmlspecialchars($student['nim']); ?></td>
                        <td><?php echo htmlspecialchars($student['name']); ?></td>
                        <td><?php echo htmlspecialchars($student['address']); ?></td>
                        <td><?php echo htmlspecialchars($student['year']); ?></td>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <button type="submit" name="edit">Edit</button>
                            <button type="submit" name="delete">Delete</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
