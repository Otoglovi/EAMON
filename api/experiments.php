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
        // Insert Experiment
        $cnt_param = count($incomingUrl);

        if($cnt_param == 6){

            insert_experiments($incomingUrl);
        }else {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode($response[0] = "Invalid Number of Parameters");
        }
        break;
    case 'PUT':
        // Update Experiment
        update_experiments($incomingUrl);
        break;
    case 'DELETE':
        //Delete Experiment
        delete_experiments($incomingUrl);
        break;
    default:
        //Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        echo json_encode($response[0] = "Method Not Allowed");
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

function insert_experiments()
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
            'status_message' =>'Experiment Added Successfully.'
        );
    }
    else
    {
        $response=array(
            'status' => 0,
            'status_message' =>'Experiment Addition Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function delete_experiment($experiment)
{
    global $link;
    foreach ($experiment as $value) {

        $query = "DELETE FROM users WHERE id='$value'";
        $result = $link->query($query) or die($link->error);
        mysqli_free_result($result);
    }

    $response = array();
    if ($link->affected_rows > 0) {
        header("HTTP/1.0 201 User Deleted Successfully");
        echo json_encode($response[0]="User Deleted successfully");
    } else {
        header("HTTP/1.0 204 No Content Found");

    }
}

function update_experiments($experiment)
{
    global $link;

    array('id','username','password','email', 'phone','type','fullName');
    $query = "update users set";

    $id = "";
    if(in_array('id', $experiment)){
        $param_pos = array_search('id', $experiment);


        $query .=" id='{$experiment[$param_pos + 1]}' ";
        $id = $experiment[$param_pos + 1];
    }
    if(in_array('username', $experiment)){
        $param_pos = array_search('username', $experiment);

        $query .=", username='{$experiment[$param_pos + 1]}' ";
    }
    if(in_array('password', $experiment)){
        $param_pos = array_search('password', $experiment);

        $query .=", password='{$experiment[$param_pos + 1]}' ";
    }
    if(in_array('email', $experiment)){
        $param_pos = array_search('email', $experiment);

        $query .=", email='{$experiment[$param_pos + 1]}' ";
    }
    if(in_array('phone', $experiment)){
        $param_pos = array_search('phone', $experiment);

        $query .=", phone='{$experiment[$param_pos + 1]}' ";
    }



    $query .= " where id='$id'";
    $response = array();
    $result = $link->query($query) or die($link->error);
    if ($link->affected_rows > 0) {
        header("HTTP/1.0 201 User Modified Successfully");
        echo json_encode($response[0]="User Modified Successfully");
    } else {
        header("HTTP/1.0 40, User ID Does Not Exist");
    }
}