<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/author.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare book object
$author = new Author($db);
 
// set ID property of record to read
$author->idauthor = isset($_GET['idauthor']) ? $_GET['idauthor'] : die();
 
// read the details of book to be edited
$author->readOne();
 
if($author->name!=null){
    // create array
    $author_arr = array(
        "idauthor" =>  $author->idauthor,
        "name" => $author->name
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($author_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user book does not exist
    echo json_encode(array("message" => "Author does not exist."));
}
?>