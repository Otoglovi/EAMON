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

function insert_experiment()
{
    global $link;
    $experiment_id=$_POST["id"];
    $title=$_POST["title"];
    $description=$_POST["description"];
    $created=$_POST["created"];
    $status=$_POST["status"];
    $student=$_POST["student"];
    $eao=$_POST["eao"];
    $startdate=$_POST["startdate"];
    $enddate=$_POST["enddate"];
    $ethics=$_POST["ethics"];
    $otherfiles=$_POST["otherfiles"];
    $query="INSERT INTO experiments SET id='{$experiment_id}', title={$title}, description={$description}, created={$created}, status={$status}, student={$student}, eao={$eao}, startdate={$startdate}, enddate={$enddate}, ethics={$ethics}, otherfiles='{$otherfiles}'";
    if(mysqli_query($link, $query))
    {
        $response=array(
            'status' => 1,
            'status_message' =>'Product Added Successfully.'
        );
    }
    else
    {
        $response=array(
            'status' => 0,
            'status_message' =>'Product Addition Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}