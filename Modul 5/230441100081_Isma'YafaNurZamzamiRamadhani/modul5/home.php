<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;
}

h1 {
    color: #333;
    font-size: 5rem;
    margin-bottom: 20px;
}

nav {
    margin-top: 20px;
}

nav a {
    text-decoration: none;
    color: white;
    background-color: #007bff;
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 1em;
}

nav a:hover {
    background-color: #0056b3;
}

nav a:not(:last-child) {
    margin-right: 10px;
}
    </style>
</head>
<body>
    <h1>Selamat datang <?php echo htmlspecialchars($_SESSION['user']); ?></h1>
    <nav>
        <a href="mahasiswa.php">Data Mahasiswa</a> <a href="logout.php">Logout</a>
    </nav>
</body>
</html>
