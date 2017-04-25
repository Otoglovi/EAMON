<?php
session_start();
require_once 'connection.php';

 $username=$_POST['username'];
$password=$_POST['password'];

$queryUserValidation="SELECT * FROM users WHERE username='$username' AND password='$password'";
$runqueryUserValidation=mysqli_query($link,$queryUserValidation);
if (mysqli_num_rows($runqueryUserValidation)=='1'){
    $a=mysqli_fetch_array($runqueryUserValidation);
    $_SESSION['role']=$a['type'];
    $_SESSION['fullname']=$a['fullName'];
    $_SESSION['user']=$username;
    echo true;
}else{
    echo false;
}

?>