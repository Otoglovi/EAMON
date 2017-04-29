<?php
/**
 * Code below was developed with the help of :
 * https://www.apptha.com/blog/how-to-build-a-rest-api-using-php/
 *  By: Mohammed Bilal Shareef
 */

//Database connection
require_once 'C:\Users\user\Documents\PhpstormProjects\EAMON\connection.php';

$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        //Retrieve Users
        if (!empty($_GET["users"])) {
            $users = intval($_GET["users"]);
            get_users($users);
        } else {
            get_users();
        }
        break;
    case 'POST':
        //Insert User
        insert_user();
        break;
    case 'PUT':
        //Update User
        $users = intval($_GET["users"]);
        update_user($users);
        break;
    case 'DELETE':
        //Delete User
        $users = intval($_GET["users"]);
        delete_user($users);
        break;
    default:
        //Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function get_users($users = 0)
{
    global $connection;
    $query = "SELECT * FROM users";
    if ($users != 0) {
        /** @var TYPE_NAME $users */
        $query .= " WHERE id=" . $users . " LIMIT 1";
    }
    $response = array();
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($result)) {
        $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function insert_user()
{
    global $connection;
    $user_name = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone"];
    $user_type = $_POST["type"];
    $full_name = $_POST["fullName"];
    $query = "INSERT INTO users SET username='{$user_name}', password='{$password}',
    email='{$email}', phone= '{$phone_number}', type='{$user_type}', fullName='{$full_name}'";

    if (mysqli_query($connection, $query))
    {
        $response = array(
            'status' => 1,
            'status_message' => 'User Added Successfully.'
        );
    }
    else
    {
        $response = array(
            'status' => 0,
            'status_message' => 'User Addition Failed.'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

function update_user($user_id)
{
    global $connection;
    parse_str(file_get_contents("php://input"), $post_vars);
    $user_name = $post_vars["username"];
    $password = $post_vars["password"];
    $email = $post_vars["email"];
    $phone_number = $post_vars["phone"];
    $user_type = $post_vars["type"];
    $full_name = $post_vars["fullName"];

    $query = "UPDATE users SET username='{$user_name}', password={$password},
    email={$email}, phone= {$phone_number}, type={$user_type}, fullName='{$full_name}' WHERE id =".$user_id;

    if (mysqli_query($connection, $query))
    {
        $response=array(
            'status' => 1,
            'status_message' =>'User Updated Successfully.'
        );
    }
    else
    {
        $response=array(
            'status' => 0,
            'status_message' =>'User Updation Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function delete_user($user_id)
{
    global $connection;
    $query = "DELETE FROM users WHERE id =".$user_id;
    if (mysqli_query($connection, $query))
    {
        $response=array(
            'status' => 1,
            'status_message' =>'User Deleted Successfully.'
        );
    }
    else
    {
        $response=array(
            'status' => 0,
            'status_message' =>'User Deletion Failed.'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
//Close database connection
mysqli_close($connection);