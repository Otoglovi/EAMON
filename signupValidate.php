// Code below was developed with the help of :
// Limitless - Responsive Web Application Kit
// By: Eugene Kopyov

<?php
session_start();
require_once 'connection.php';

 $fullname=$_POST['fullname'];
 $username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];
$phone=$_POST['phone'];

$queryUserValidation="SELECT * FROM users WHERE username='$username' LIMIT 1";
$runqueryUserValidation=mysqli_query($link,$queryUserValidation);
if (mysqli_num_rows($runqueryUserValidation)=='1'){
    echo 'exists';
}else{
    $queryInsert="INSERT into users(username,password,email,phone,type,fullName)VALUES('$username','$password','$email','$phone','student','$fullname')";
    $runQueryInsert=mysqli_query($link,$queryInsert);
    if($runQueryInsert){
        $_SESSION['user']=$username;
        $_SESSION['fullname']=$fullname;
        $_SESSION['role']='student';
        echo true;
    }else{
        echo false;
    }
}

?>