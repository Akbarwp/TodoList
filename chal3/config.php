<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "web_dev";

$koneksi = mysqli_connect($hostname, $username, $password, $database);

if (mysqli_connect_errno()) {
  echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_errno();
}
