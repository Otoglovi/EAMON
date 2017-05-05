<?php
/**
 * Code below was developed with the help of :
 * https://www.apptha.com/blog/how-to-build-a-rest-api-using-php/
 *  By: Mohammed Bilal Shareef
 */

//Database connection
require_once '../connection.php';

$request_method = $_SERVER["REQUEST_METHOD"];
$incomingUrl = explode("/", substr($_SERVER['REQUEST_URI'], 11));
/*echo 'We are here' . $request_method;
die(
    'gone too soon');
$tyt="/api/users/Kwame/XXXX/da@gmail.com/5253582/student/Kwame";
echo $request_method;
$request_method = "POST";
print_r($incomingUrl);
exit;
*/
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
        $cnt_param = count($incomingUrl);

        if($cnt_param == 6){

            insert_users($incomingUrl);
        }else {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode($response[0] = "Invalid Number of Parameters");
        }
        break;
    case 'PUT':
        // Update User
        update_user($incomingUrl);
        break;
    case 'DELETE':
        //Delete User
        delete_user($incomingUrl);
        break;
    default:
        //Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        echo json_encode($response[0] = "Method Not Allowed");
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

function insert_users($user)
{

    global $link;
    $username=$user[0];
    $password=$user[1];
    $email=$user[2];
    $phone=$user[3];
    $type=$user[4];
    $fullName=$user[5];
    $query = "INSERT INTO users(username, password, email, phone, type, fullName)
              VALUES 
              ('$username','$password', '$email','$phone','$type','$fullName')";
     //   echo $query;

    //mysqli_query($link, $query) or die(mysqli_error($link));
    if(mysqli_query($link, $query))
    {
        $response = array(
            'status' => 1,
            'status_message' =>'User Added Successfully.'
        );
    }
    else
    {
        $response = array(
            'status' => 0,
            'status_message' =>'User Addition Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function delete_user($user)
{
    global $link;
    foreach ($user as $value) {

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

function update_user($incomingUrl)
{
    global $link;

    //array('id','username','password','email', 'phone','type','fullName');
    $query = "UPDATE users set";

    $id = "";
    if(in_array('id', $incomingUrl)){
        $param_pos = array_search('id', $incomingUrl);


        $query .=" id='{$incomingUrl[$param_pos + 1]}' ";
        $id = $incomingUrl[$param_pos + 1];
    }
    if(in_array('username', $incomingUrl)){
        $param_pos = array_search('username', $incomingUrl);

        $query .=", username='{$incomingUrl[$param_pos + 1]}' ";
    }
    if(in_array('password', $incomingUrl)){
        $param_pos = array_search('password', $incomingUrl);

        $query .=", password='{$incomingUrl[$param_pos + 1]}' ";
    }
    if(in_array('email', $incomingUrl)){
        $param_pos = array_search('email', $incomingUrl);

        $query .=", email='{$incomingUrl[$param_pos + 1]}' ";
    }
    if(in_array('phone', $incomingUrl)){
        $param_pos = array_search('phone', $incomingUrl);

        $query .=", phone='{$incomingUrl[$param_pos + 1]}' ";
    }
    if(in_array('type', $incomingUrl)){
        $param_pos = array_search('type', $incomingUrl);

        $query .=", type='{$incomingUrl[$param_pos + 1]}' ";
    }
    if(in_array('fullName', $incomingUrl)){
        $param_pos = array_search('fullName', $incomingUrl);

        $query .=", fullName='{$incomingUrl[$param_pos + 1]}' ";
    }

    $query .= " where id='$id'";
    $response = array();
    //echo $query;
    $result = $link->query($query) or die($link->error);
    if ($link->affected_rows > 0) {
        header("HTTP/1.0 201 User Modified Successfully");
        echo json_encode($response[0]="User Modified Successfully");
    } else {
        header("HTTP/1.0 40, User ID Does Not Exist");
    }
}