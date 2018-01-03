<?php
class File{
 
    // database connection and table name
    private $conn;
    private $table_name = "File";
 
    // object properties
    public $link;
    public $student_id;
    public $course_id;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
// read courses
function read(){
 
    // select all query
    $query = "SELECT Student.fullname, Course.name, File.link FROM File, Student, Course WHERE Student.student_id=File.student_id AND Course.course_id=File.course_id"; 
 
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
                link=:link, student_id=:student_id, course_id=:course_id";
				
	print $query;
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
	$this->link=htmlspecialchars(strip_tags($this->link));
	$this->student_id=htmlspecialchars(strip_tags($this->student_id));
	$this->course_id=htmlspecialchars(strip_tags($this->course_id));
 
    // bind values
	$stmt->bindParam(":link", $this->link);
	$stmt->bindParam(":student_id", $this->student_id);
	$stmt->bindParam(":course_id", $this->course_id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}



}
?>