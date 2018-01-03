<?php
class Student{
 
    // database connection and table name
    private $conn;
    private $table_name = "Student";
 
    // object properties
    public $student_id;
    public $fullname;
    public $birthday;
    public $group_id;
    public $sex;
    public $status;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
// read courses
function read(){
 
    // select all query
    $query = "SELECT Student.student_id, Student.fullname, DATE_FORMAT(Student.birthday, '%d.%m.%Y') as birthday, `Group`.`group_name`, Student.sex, Student.status FROM Student, `Group` WHERE Student.group_id=`Group`.`group_id`";
 
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
                fullname=:fullname, birthday=:birthday, group_id=:group_id, sex=:sex, status=:status ";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->fullname=htmlspecialchars(strip_tags($this->fullname));
    $this->birthday=htmlspecialchars(strip_tags($this->birthday));
    $this->group_id=htmlspecialchars(strip_tags($this->group_id));
    $this->sex=htmlspecialchars(strip_tags($this->sex));
    $this->status=htmlspecialchars(strip_tags($this->status));
    
 
    // bind values
    $stmt->bindParam(":fullname", $this->fullname);
    $stmt->bindParam(":birthday", $this->birthday);
    $stmt->bindParam(":group_id", $this->group_id);
    $stmt->bindParam(":sex", $this->sex);
    $stmt->bindParam(":status", $this->status);
 
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
    $query = "SELECT Student.student_id, Student.fullname, DATE_FORMAT(Student.birthday, '%d.%m.%Y') as birthday, `Group`.`group_name`, Student.sex, Student.status FROM `Group`, Student WHERE `Group`.`group_id`=`Student`.`group_id` AND 
                student_id = ?
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of course to be updated
    $stmt->bindParam(1, $this->student_id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 

    $this->student_id = $row['student_id'];
    $this->fullname = $row['fullname'];
    $this->birthday = $row['birthday'];
    $this->group_name = $row['group_name'];
    $this->sex = $row['sex'];
    $this->status = $row['status'];
}
    
    
// update the product
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                fullname = :fullname,
                birthday = :birthday,
                group_id = :group_id,
                sex = :sex,
                status = :status
            WHERE
                student_id = :student_id";
				
	
    
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->fullname=htmlspecialchars(strip_tags($this->fullname));
    $this->birthday=htmlspecialchars(strip_tags($this->birthday));
    $this->group_id=htmlspecialchars(strip_tags($this->group_id));
    $this->sex=htmlspecialchars(strip_tags($this->sex));
    $this->status=htmlspecialchars(strip_tags($this->status));
    $this->student_id=htmlspecialchars(strip_tags($this->student_id));
 
    // bind new values
    $stmt->bindParam(':fullname', $this->fullname);
    $stmt->bindParam(':birthday', $this->birthday);
    $stmt->bindParam(':group_id', $this->group_id);
    $stmt->bindParam(':sex', $this->sex);
    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(':student_id', $this->student_id);
    
    print $this->fullname;
    print $this->student_id;
 
    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}
    
// delete the product
function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE student_id = ?";

 
   // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
 
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