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
include_once '../objects/course.php';
 
$database = new Database();
$db = $database->getConnection();
 
$course = new Course($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set course property values
$course->name = $data->name;

 
// create the course
if($course->create()){
    echo '{';
        echo '"message": "Product was created."';
    echo '}';
}
 
// if unable to create the course, tell the user
else{
    echo '{';
        echo '"message": "Unable to create course."';
    echo '}';
}
?>