<?php
class Publisher{
 
    // database connection and table name
    private $conn;
    private $table_name = "publishers";
 
    // object properties
    public $idpublisher;
    public $name;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read publishers
    function read(){
    
        // select all query
        $query = 
    "SELECT
        idpublisher, name
    FROM
        publishers";
    
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
                    publishers
                SET
                    name=:name";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->title=htmlspecialchars(strip_tags($this->name));                
    
        // bind values
        $stmt->bindParam(":name", $this->name);
        
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
            idpublisher, name
        FROM
            publishers
        WHERE
            idpublisher = ?
        GROUP BY
            b.title";        
        
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of publisher to be updated
        $stmt->bindParam(1, $this->idpublisher);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->idpublisher = $row['idpublisher'];
        $this->name = $row['name'];
    }

    // update the publisher
    function update(){
    
        // update query
        $query = "UPDATE
                    publishers
                SET
                idpublisher = :idpublisher,
                " . (($this->name != "nothing")?("name = :name, "):"") . "
                WHERE
                    idpublisher = :idpublisher";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->idpublisher=htmlspecialchars(strip_tags($this->idpublisher));
        $this->name=htmlspecialchars(strip_tags($this->name));
    
        // bind new values
        $stmt->bindParam(':idpublisher', $this->idpublisher);
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
        $query = "DELETE FROM publishers WHERE idpublisher = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->idpublisher=htmlspecialchars(strip_tags($this->idpublisher));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->idpublisher);
    
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
                    idpublisher, name
                FROM
                    publishers
                WHERE
                    idpublisher LIKE ? OR name LIKE ?";

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