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
        //Retrieve Experiments
        if (!empty($_GET["experiments"])) {
            $experiment = ($_GET["experiments"]);
            get_experiments($experiment);
        } else {
            get_experiments();
        }
        break;
//    case 'POST':
        //Insert User
        // insert_user();
        // break;
        header("HTTP/1.0 405 Method Not Allowed");
    case 'PUT':
        //Update User
        //$experiments = intval($_GET["user"]);
        //update_user($experiments);
        //break;
        header("HTTP/1.0 405 Method Not Allowed");
    case 'DELETE':
        //Delete User
        //$experiments = intval($_GET["user"]);
        //delete_user($experiments);
        header("HTTP/1.0 405 Method Not Allowed");
        break;
    default:
        //Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function get_experiments($experiment)
{
    global $link;
    $query = "SELECT `id`, `title`, `description`, `created`, `status`, `student`, `eao`, `startdate`, `enddate`, `ethics`, `otherfiles` FROM experiments";
    if (intval($experiment) > 0) {
        $query .= ' WHERE id="' . $experiment . '" LIMIT 1';
    }
    $response = array();
    $result = mysqli_query($link, $query);
    $row_cnt = $result->num_rows;
    if ($row_cnt >0) {
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