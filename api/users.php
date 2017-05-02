<?php
/**
 * Code below was developed with the help of :
 * https://www.apptha.com/blog/how-to-build-a-rest-api-using-php/
 *  By: Mohammed Bilal Shareef
 */

//Database connection
require_once '../connection.php';

$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
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
        $user = intval($_GET["users"]);
        insert_user();
        break;
    case 'PUT':
        // Update User
        //$users = intval($_GET["user"]);
        //update_user($users);
        //break;
    case 'DELETE':
        //Delete User
        //$users = intval($_GET["user"]);
        //delete_user($users);
        break;
    default:
        //Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function get_users($user)
{
    global $link;
    $query = "SELECT id, username,email, phone, type, fullName FROM users";
    if (intval($user) > 0) {
        $query .= ' WHERE id="' . $user . '" LIMIT 1';
    }
    $response = array();
    $result = mysqli_query($link, $query);
    $count_rows = $result->num_rows;
    if ($count_rows >0) {
        while ($row = mysqli_fetch_assoc($result))
        {
            $response[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        header("HTTP/1.0 204 No Content Found");
    }
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
}