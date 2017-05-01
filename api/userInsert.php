<?php
/**
 * Code below was developed with the help of :
 * https://www.apptha.com/blog/how-to-build-a-rest-api-using-php/
 *  By: Mohammed Bilal Shareef
 */

//Database connection
require_once '../connection.php';

$verb = $_SERVER['REQUEST_METHOD'];

if ($verb == 'GET'){


} elseif ($verb == 'POST'){

} elseif ($verb == 'DELETE'){

}

/*$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        //echo $_GET['user']." WE ARE HERE";
        //Retrieve Users
        if (!empty($_GET["users"])) {
            $user = ($_GET["users"]);
            get_users($user);
        } else {
            get_users();
        }
        break;
    case 'POST':
        // Insert User
        insert_user();
        break;
        //header("HTTP/1.0 405 Method Not Allowed");
    case 'PUT':
        // Update User
        //$users = intval($_GET["user"]);
        //update_user($users);
        //break;
        header("HTTP/1.0 405 Method Not Allowed");
    case 'DELETE':
        //Delete User
        //$users = intval($_GET["user"]);
        //delete_user($users);
        header("HTTP/1.0 405 Method Not Allowed");
        break;
    default:
        //Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
/*
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    insert_user();
}
function insert_user()
{
    global $link;
    $username=$_POST["username"];
    $password=$_POST["password"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $type=$_POST["type"];
    $fullName=$_POST["fullName"];
    $query="INSERT INTO experiments SET username={$username}, password={$password}, email={$email}, phone={$phone}, type={$type}, fullName='{$fullName}'";
    if(mysqli_query($link, $query))
    {
        $response = array(
            'status' => 1,
            'status_message' =>'Product Added Successfully.'
        );
    }
    else
    {
        $response = array(
            'status' => 0,
            'status_message' =>'Product Addition Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}*/