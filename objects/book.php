<?php
class Book{
 
    // database connection and table name
    private $conn;
    private $table_name = "books";
 
    // object properties
    public $idbook;
    public $publisher;
    public $title;
    public $authors;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
    
        // select all query
        $query = 
    "SELECT
        b.idbook, b.title, p.name as 'publisher', GROUP_CONCAT(a.name) as 'authors'
    FROM
        authors ats
    LEFT JOIN
        books b
            ON b.idbook = ats.idbook
    LEFT JOIN
        author a
            ON ats.idauthor = a.idauthor
    LEFT JOIN
        publishers p
            ON p.idpublisher = b.idpublisher
    GROUP BY
        b.title;";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create book
    function create(){
        
        // query to insert record
        $query = "INSERT INTO
                    books
                SET
                    title=:title, idpublisher=:idpublisher";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->idpublisher=htmlspecialchars(strip_tags($this->idpublisher));        
    
        // bind values
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":idpublisher", $this->idpublisher);
        
        // execute query
        if($stmt->execute()){
            return true; 
        }
    
        return false;
        
    }

    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query = 
        "SELECT
            b.idbook, b.title, p.name as 'publisher', GROUP_CONCAT(a.name) as 'authors'
        FROM
            authors ats
        LEFT JOIN
            books b
                ON b.idbook = ats.idbook
        LEFT JOIN
            author a
                ON ats.idauthor = a.idauthor
        LEFT JOIN
            publishers p
                ON p.idpublisher = b.idpublisher
        WHERE
            b.idbook = ?
        GROUP BY
            b.title";        
        //LIMIT
        //    0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->idbook);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->idbook = $row['idbook'];
        $this->title = $row['title'];
        $this->publisher = $row['publisher'];
        $this->authors = $row['authors'];
    }

    // update the product
    function update(){
    
        // update query
        $query = "UPDATE
                    books
                SET
                idbook = :idbook,
                " . (($this->title != "nothing")?("title = :title, "):"") . "
                " . (($this->idpublisher != "nothing")?("idpublisher = :idpublisher"):"") . "    
                WHERE
                    idbook = :idbook";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->idbook=htmlspecialchars(strip_tags($this->idbook));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->idpublisher=htmlspecialchars(strip_tags($this->idpublisher));
    
        // bind new values
        $stmt->bindParam(':idbook', $this->idbook);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':idpublisher', $this->idpublisher);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // delete the product
    function delete(){
    
        // delete query
        $query = "DELETE FROM books WHERE idbook = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->idbook=htmlspecialchars(strip_tags($this->idbook));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->idbook);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    // search products
    function search($keywords){
    
        // select all query
        $query = "SELECT
                    c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        categories c
                            ON p.category_id = c.id
                WHERE
                    p.name LIKE ? OR p.description LIKE ? OR c.name LIKE ?
                ORDER BY
                    p.created DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
    
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read products with pagination
    public function readPaging($from_record_num, $records_per_page){
    
        // select query
        $query = "SELECT
                    c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        categories c
                            ON p.category_id = c.id
                ORDER BY p.created DESC
                LIMIT ?, ?";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind variable values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        // return values from database
        return $stmt;
    }

    // used for paging products
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }
}
?>