<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/book.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare book object
$book = new Book($db);
 
// get id of book to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of book to be edited
$book->idbook = $data->idbook;
 
// set book property values
$book->idbook = $data->idbook;
(isset($data->title))?($book->title = $data->title):($book->title = "nothing");
(isset($data->idpublisher))?($book->idpublisher = $data->idpublisher):($book->idpublisher = "nothing");
 
// update the book
if($k = $book->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Book was updated."));
}// if unable to update the book, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update book."));
    dump("k = ", $k);
}

?>