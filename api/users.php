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
        if (!empty($_GET["user"])) {
            $users = intval($_GET["user"]);
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
        $users = intval($_GET["user"]);
        update_user($users);
        break;
    case 'DELETE':
        //Delete User
        $users = intval($_GET["user"]);
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
//    header('Content-Type: application/json');
//    echo json_encode($response);
    echo $users;
}




//Close database connection
mysqli_close($connection);