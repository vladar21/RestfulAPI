<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/authors.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare author object
$authors = new Authors($db);
 
// get id of author to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of author to be edited
$authors->idauthors = $data->idauthors;
 
// set author property values
$authors->idbook = (isset($data->idbook))?($data->idbook):("0");
$authors->idauthor = (isset($data->idauthor))?($data->idauthor):("0");

// update the author
if($k = $authors->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Authors was updated."));
}// if unable to update the author, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update authors."));
    var_dump("k = ", $k);
}

?>