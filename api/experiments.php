<?php
/**
 * Code below was developed with the help of :
 * https://www.apptha.com/blog/how-to-build-a-rest-api-using-php/
 *  By: Mohammed Bilal Shareef
 */

//Database connection
require_once '../connection.php';

$request_method = $_SERVER["REQUEST_METHOD"];
$incomingUrl = explode("/", substr($_SERVER['REQUEST_URI'], 17));

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

        if($cnt_param == 10){

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

function insert_experiments($experiment)
{
    global $link;
    $title=$experiment[0];
    $description=$experiment[1];
    $created=$experiment[2];
    $status=$experiment[3];
    $student=$experiment[4];
    $eao=$experiment[5];
    $startdate=$experiment[6];
    $enddate=$experiment[7];
    $ethics=$experiment[8];
    $otherfiles=$experiment[9];
    $query = "INSERT INTO experiments (title, description, created, status, student, eao, startdate, enddate, ethics, otherfiles) 
              VALUES 
              ('$title','$description', '$created','$status','$student','$eao','$startdate','$enddate','$ethics','$otherfiles')";
    echo $query;
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
        header("HTTP/1.0 201 Experiment Deleted Successfully");
        echo json_encode($response[0]="Experiment Deleted successfully");
    } else {
        header("HTTP/1.0 204 No Content Found");

    }
}

function update_experiments($experiment)
{
    global $link;
    $query = "update users set";

    $id = "";
    if(in_array('id', $experiment)){
        $param_pos = array_search('id', $experiment);


        $query .=" id='{$experiment[$param_pos + 1]}' ";
        $id = $experiment[$param_pos + 1];
    }
    if(in_array('title', $experiment)){
        $param_pos = array_search('title', $experiment);

        $query .=", title='{$experiment[$param_pos + 1]}' ";
    }
    if(in_array('description', $experiment)){
        $param_pos = array_search('description', $experiment);

        $query .=", description='{$experiment[$param_pos + 1]}' ";
    }
    if(in_array('created', $experiment)){
        $param_pos = array_search('created', $experiment);

        $query .=", created='{$experiment[$param_pos + 1]}' ";
    }
    if(in_array('status', $experiment)){
        $param_pos = array_search('status', $experiment);

        $query .=", status='{$experiment[$param_pos + 1]}' ";
    }
    if(in_array('student', $experiment)){
        $param_pos = array_search('student', $experiment);

        $query .=", student='{$experiment[$param_pos + 1]}' ";
    }
    if(in_array('eao', $experiment)){
        $param_pos = array_search('eao', $experiment);

        $query .=", eao='{$experiment[$param_pos + 1]}' ";
    }
    if(in_array('startdate', $experiment)){
        $param_pos = array_search('startdate', $experiment);

        $query .=", startdate='{$experiment[$param_pos + 1]}' ";
    }
    if(in_array('enddate', $experiment)){
        $param_pos = array_search('enddate', $experiment);

        $query .=", enddate='{$experiment[$param_pos + 1]}' ";
    }
    if(in_array('ethics', $experiment)){
        $param_pos = array_search('ethics', $experiment);

        $query .=", ethics='{$experiment[$param_pos + 1]}' ";
    }
    if(in_array('otherfiles', $experiment)){
        $param_pos = array_search('otherfiles', $experiment);

        $query .=", otherfiles='{$experiment[$param_pos + 1]}' ";
    }

    $query .= " where id='$id'";
    $response = array();
    $result = $link->query($query) or die($link->error);
    if ($link->affected_rows > 0) {
        header("HTTP/1.0 201 Experiment Modified Successfully");
        echo json_encode($response[0]="Experiment Modified Successfully");
    } else {
        header("HTTP/1.0 40, Experiment ID Does Not Exist");
    }
}