<?php

/* Simple api that requires an api key and does two things
 * 
 * Usage: called with url-parameters 
 * ?apikey=[value]&action=update&value=[value]
 * ?apikey=[value]&action=get
 *  
 */ 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "Database/DbGateway.php";
include "Database/DbConnector.php";

use Database\DbGateway;
use Database\DbConnector;

$correctApikey = "5519";
$apikey = "";
$action = "";
$id = "";

//get apikey and action from the request
if(isset($_GET['apikey'])) {
    $apikey = $_GET['apikey'];
}
if(isset($_GET['action'])) {
    $action = $_GET['action'];
}
if(isset($_GET['id'])) {
    $id = $_GET['id'];
}

//make sure we have a correct apikey and action
$isBadApikey = strcmp($apikey, $correctApikey);
$isBadAction = ($action == "get" || $action == "put") ? false : true;
//exit early if not.. 
if($isBadApikey) {
    stopExecution("401","Unauthorized");
}
if($isBadAction) {
    stopExecution("400","Called with invalid parameters");
}

//establish connection to database and the DbGateway
$db_conn = (new DbConnector())->getConnection();
$db = new DbGateway($db_conn);

// 
// HANDLE GET
//
if($action == "get") {
    if($id) {
        if(!is_numeric($id)) {
            $result = array('status' => "0", 'errorMessage' => "Id must be numeric");
        } 
        else {
            $result = $db->find($id);  //if id is used, fetch one row    
        }
    }
    else {
        $result = $db->findAll();  //no id = fetch all posts
    }
    
    $status = $result['status'];
    if($result['status']) {
        $response = array('status'=> $result['status'], 'data' => $result['data']);    
    }
    else {
        $response = array('status'=> $result['status'], 'errorMessage' => $result['error']);   
    }
}

// 
// HANDLE PUT
//
if($action == "put") {
    $value = "";
    if(isset($_GET['value'])) {
        $value = $_GET['value'];
    }
    //check if input value is numeric otherwise give an error
    if(!is_numeric($value)) {
        $response = array('status' => "0", 'errorMessage' => "Value must be numeric");
    } 
    else {
        $result = $db->insert($value);  //insert value
        if($result['status']) {
            $response = array('status'=> $result['status'], 'data' => $result['data']);    
        }
        else {
            $response = array('status'=> $result['status'], 'errorMessage' => $result['error']);   
        }
    }
}

//finally convert response to json and print it..
$json = json_encode($response);
if ($json === false) {
    // Avoid echo of empty string (which is invalid JSON), and
    // JSONify the error message instead:
    $json = json_encode(["jsonError" => json_last_error_msg()]);
    // Set HTTP response status code to: 500 - Internal Server Error
    http_response_code(500);
}
header('Content-type: application/json');
echo($json); 
exit();

function stopExecution($errorCode, $errorMsg) {
    http_response_code($errorCode);
    if($errorMsg) {
        print($errorMsg);
    }
    exit;
}

?>

