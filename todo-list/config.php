<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "todo_list";

$koneksi = mysqli_connect($hostname, $username, $password, $database);

if (mysqli_connect_errno()) {
  echo "Gagal melakukan koneksi ke MySQL: " . mysqli_connect_errno();
}