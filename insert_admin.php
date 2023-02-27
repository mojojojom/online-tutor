<?php

include('connection/connect.php');

$pass = 'password';
$password = password_hash($pass, PASSWORD_DEFAULT);

$insert = mysqli_query($db, "INSERT INTO admin (username, email,password) VALUES ('admin', 'admin@gmail.com','$password')");

if($insert) {
    echo 'success';
} else {
    echo 'Error : '.mysqli_error($db);
}