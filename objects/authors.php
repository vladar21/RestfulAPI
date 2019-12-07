<?php
class Authors{
 
    // database connection and table name
    private $conn;
    private $table_name = "authors";
 
    // object properties
    public $idauthors;
    public $idauthor;
    public $author;
    public $idbook;
    public $title;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read publishers
    function read(){
    
        // select all query
        $query = 
    "SELECT
        ats.idauthors as 'idauthors', ats.idauthor as 'idauthor', a.name as 'author', b.idbook as 'idbook', b.title as 'title'
    FROM
        authors ats
    LEFT JOIN
        author a
            ON a.idauthor = ats.idauthor
    LEFT JOIN
        books b
            ON b.idbook = ats.idbook";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create publisher
    function create(){
        
        // query to insert record
        $query = "INSERT INTO
                    authors
                SET
                    idauthor=:idauthor, idbook=:idbook";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->idauthor=htmlspecialchars(strip_tags($this->idauthor));   
        $this->idbook=htmlspecialchars(strip_tags($this->idbook));
    
        // bind values
        $stmt->bindParam(":idauthor", $this->idauthor);
        $stmt->bindParam(":idbook", $this->idbook);
        
        // execute query
        if($stmt->execute()){
            return true; 
        }
    
        return false;
        
    }

    // used when filling up the update publisher form
    function readOne(){
    
        // query to read single record
        $query = 
        "SELECT
            ats.idauthors as 'idauthors', ats.idauthor as 'idauthor', a.name as 'author', b.idbook as 'idbook', b.title as 'title'
        FROM
            authors ats
        LEFT JOIN
            author a
                ON a.idauthor = ats.idauthor
        LEFT JOIN
            books b
                ON b.idbook = ats.idbook
        WHERE
            ats.idauthors = ?";     
        
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of publisher to be updated
        $stmt->bindParam(1, $this->idauthors);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->idauthors = $row['idauthors'];
        $this->idauthor = $row['idauthor'];
        $this->author = $row['author'];
        $this->idbook = $row['idbook'];
        $this->title = $row['title'];
    }

    // update the publisher
    function update(){
    
        // update query
        $query = "UPDATE
                    author
                SET
                    idauthor = :idauthor
                    " . (($this->name != "nothing")?(", name = :name"):"") . "
                WHERE
                    idauthor = :idauthor";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);        
    
        // sanitize
        $this->idauthor = htmlspecialchars(strip_tags($this->idauthor));
        $this->name = htmlspecialchars(strip_tags($this->name));
    
        // bind new values
        $stmt->bindParam(':idauthor', $this->idauthor);
        $stmt->bindParam(':name', $this->name);
        
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // delete the publisher
    function delete(){
    
        // delete query
        $query = "DELETE FROM authors WHERE idauthors = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->idauthors=htmlspecialchars(strip_tags($this->idauthors));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->idauthors);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    // search books
    function search($keywords){
    
        // select all query
        $query = "SELECT
                    idauthor, name
                FROM
                    author
                WHERE
                    idauthor LIKE ? OR name LIKE ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
    
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }   
    
}
?>