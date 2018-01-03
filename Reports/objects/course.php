<?php
class Course{
 
    // database connection and table name
    private $conn;
    private $table_name = "Course";
 
    // object properties
    public $course_id;
    public $name;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
// read courses
function read(){
 
    // select all query
    $query = "SELECT
                course_id, name
            FROM
                " . $this->table_name;
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
    
// create course
function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
 
    // bind values
    $stmt->bindParam(":name", $this->name);
 
    // execute query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}
    
// used when filling up the update course form
function readOne(){
 
    // query to read single record
    $query = "SELECT
                course_id, name
            FROM
                " . $this->table_name . "
            WHERE
                course_id = ?
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of course to be updated
    $stmt->bindParam(1, $this->id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->name = $row['name'];
    // set values to object properties
    $this->course_id = $row['course_id'];
}
    
    // update the course
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                name = :name
            WHERE
                course_id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->id=htmlspecialchars(strip_tags($this->id));

    // bind new values
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':id', $this->id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
    
// delete the course
function delete(){
 
    // delete query
     $query = "DELETE FROM " . $this->table_name . " WHERE course_id = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->course_id=htmlspecialchars(strip_tags($this->course_id));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->course_id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
    
}



?>