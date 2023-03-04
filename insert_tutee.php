<?php

include('connection/connect.php');

$pass = 'password';
$password = password_hash($pass, PASSWORD_DEFAULT);

$insert = mysqli_query($db, "INSERT INTO `tutees`(`id`, `username`, `f_name`, `l_name`, `email`, `course`, `y_lvl`, `password`, `num`, `dp`, `code`, `status`, `active_status`) VALUES ('1','sample','sample','name','samplename@gmail.com','BS INFO TECH','III','$password','09451236547','','','Yes','0')");

if($insert) {
    echo 'success';
} else {
    echo 'Error : '.mysqli_error($db);
}