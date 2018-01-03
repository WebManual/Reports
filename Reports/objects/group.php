<?php
class Group{
 
    // database connection and table name
    private $conn;
    private $table_name = "Group";
 
    // object properties
    public $group_id;
    public $group_name;
	public $group_year;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
// read courses
function read(){
 
    // select all query
    $query = "SELECT
                `group_id`, `group_name`, `group_year`
            FROM
                `" . $this->table_name ."`";
 
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
               `" . $this->table_name ."` 
            SET
                group_name=:group_name, group_year=:group_year";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->group_name=htmlspecialchars(strip_tags($this->group_name));
    $this->group_year=htmlspecialchars(strip_tags($this->group_year));
 
    // bind values
    $stmt->bindParam(":group_name", $this->group_name);
    $stmt->bindParam(":group_year", $this->group_year);
 
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
                `group_id`, `group_name`, `group_year`
            FROM
                `" . $this->table_name ."` 
            WHERE
                group_id = ?
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->group_name = $row['group_name'];
    $this->group_id = $row['group_id'];
    $this->group_year = $row['group_year'];
}
    
    
// update the product
function update(){
 
    // update query
    $query = "UPDATE
               `" . $this->table_name ."` 
            SET
                 group_name=:group_name, group_year=:group_year
            WHERE
                group_id = :group_id";
				
	print  $query;
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
	$this->group_name=htmlspecialchars(strip_tags($this->group_name));
    $this->group_year=htmlspecialchars(strip_tags($this->group_year));
    $this->group_id=htmlspecialchars(strip_tags($this->group_id));
 
    // bind values
    $stmt->bindParam(":group_name", $this->group_name);
    $stmt->bindParam(":group_year", $this->group_year);
    $stmt->bindParam(":group_id", $this->group_id);
    
 
    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

// delete the course
function delete(){
 
    // delete query
     $query = "DELETE FROM `" . $this->table_name ."` WHERE group_id = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->group_id=htmlspecialchars(strip_tags($this->id));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
    
}



?>