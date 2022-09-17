<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "309_project1";

$conn = mysqli_connect($host, $user, $password, $database);

if($conn == false) {
    echo "There's and error in Database Connection" . mysqli_connect_error();
}