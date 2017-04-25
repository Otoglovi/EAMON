// Code below was developed with the help of :
// Limitless - Responsive Web Application Kit
// By: Eugene Kopyov

<?php

require_once 'connection.php';

 $key=$_POST['key'];
 $id=$_POST['id'];
$keyd=$key."d";
 $query=mysqli_query($link ,"UPDATE experiments SET status='$keyd' WHERE id='$id'");
if ($query){
    echo "Experiment successfully ".$keyd;
}else{
    echo "Action Failed";
}
