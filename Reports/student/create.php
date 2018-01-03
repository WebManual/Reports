<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate course object
include_once '../objects/student.php';
 
$database = new Database();
$db = $database->getConnection();
 
$student = new Student($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set course property values
$student->fullname = $data->fullname;
$student->birthday = $data->birthday;
$student->group_id = $data->group_id;
$student->sex = $data->sex;
$student->status = $data->status;

 
// create the course
if($student->create()){
    echo '{';
        echo '"message": "Student was created."';
    echo '}';
}
 
// if unable to create the course, tell the user
else{
    echo '{';
        echo '"message": "Unable to create course."';
    echo '}';
}
?>