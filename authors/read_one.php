<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/authors.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare book object
$authors = new Authors($db);

// set ID property of record to read
$authors->idauthors = isset($_GET['idauthors']) ? $_GET['idauthors'] : die();
 
// read the details of book to be edited
$authors->readOne();

if($authors->idauthor!=null){
    // create array
    $authors_arr = array(
        "idauthors" => $authors->idauthors,
        "idauthor" => $authors->idauthor,
        "author" => $authors->author,
        "idbook" => $authors->idbook,
        "title" => $authors->title
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($authors_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user book does not exist
    echo json_encode(array("message" => "Authors does not exist."));
}
?>