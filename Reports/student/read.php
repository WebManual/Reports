<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/student.php';
 
// instantiate database and course object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$student = new Student($db);
 
// query courses
$stmt = $student->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // courses array
    $student_arr=array();
    $student_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $student_item=array(
            "student_id" => $student_id,
            "fullname" => $fullname,
            "birthday" => $birthday,
            "group_id" => $group_name,
            "sex" => $sex,
            "status" => $status,
        );

 
        array_push($student_arr["records"], $student_item);
    }
 
    echo json_encode($student_arr);
}
 
else{
    echo json_encode(
        array("message" => "Courses not found.")
    );
}
?>