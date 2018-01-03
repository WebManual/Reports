<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/student.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$student = new Student($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited
$student->student_id = $data->student_id;
 
// set product property values
$student->fullname = $data->fullname;
$student->birthday = $data->birthday;
$student->group_id = $data->group_id;
$student->sex = $data->sex;
$student->status = $data->status;

// update the product
if($student->update()){
    echo '{';
        echo '"message": "Student was updated."';
    echo '}';
}
 
// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to update student."';
    echo '}';
}
?>