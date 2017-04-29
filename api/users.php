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
        //echo $_GET['user']." WE ARE HERE";
        //Retrieve Users
        if (!empty($_GET["user"])) {
            $users = ($_GET["user"]);
            get_users($users);
        } else {
            get_users();
        }
        break;
//    case 'POST':
        //Insert User
        // insert_user();
        // break;
        header("HTTP/1.0 405 Method Not Allowed");
    case 'PUT':
        //Update User
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

function get_users($users)
{
    //echo $users."WE ARE   INSIDE ";
    global $link;
    $query = "SELECT * FROM users";
    if (strlen($users) > 0) {
        /** @var TYPE_NAME $users */
        $query .= " WHERE id=" . $users . " LIMIT 1";
    }
    /*   $response = array();

       $result = mysqli_query($link, $query);
       while ($row = mysqli_fetch_array($result)) {
           $response[] = $row;
          // echo var_dump($response[])." I N  SQL";
       }
       echo var_dump($response[])." after SQL";
   //    header('Content-Type: application/json');
   //    echo json_encode($response);
   //    echo $users;
   }

   */
    $response = array();
    $result = mysqli_query($link, $query);
    $row_cnt = $result->num_rows;
    if ($row_cnt >0) {
        while ($row = mysqli_fetch_array($result))
        {
            $response[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        header("HTTP/1.0 204 No Content Found");
    }
}