<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "registrasi";

$koneksi = mysqli_connect($servername,$username,$password,$database);

if ($koneksi){
    echo "databse terkoneksi";
} else {
    echo "databsae tidak konek";
}