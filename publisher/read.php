<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/book.php';
 
// instantiate database and book object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$book = new Book($db);
 
// query books
$stmt = $book->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // books array
    $books_arr=array();
    $books_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $book_item=array(
            "idbook" => $idbook,
            "title" => $title,
            "publisher" => $publisher,
            "authors" => $authors      
        );
 
        array_push($books_arr["records"], $book_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show books data in json format
    echo json_encode($books_arr);
} 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no books found
    echo json_encode(
        array("message" => "No books found.")
    );
}