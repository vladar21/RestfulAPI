<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/publisher.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare publisher object
$publisher = new Publisher($db);
 
// get id of book to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of book to be edited
$publisher->idpublisher = $data->idpublisher;
 
// set book property values
$publisher->name = (isset($data->name))?($data->name):("nothing");

// update the book
if($k = $publisher->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Publisher was updated."));
}// if unable to update the book, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update publisher."));
    var_dump("k = ", $k);
}

?>