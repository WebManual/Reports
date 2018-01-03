<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/course.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare course object
$course = new Course($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of course to be edited
$course->id = $data->id;
 
// set course property values
$course->name = $data->name;
 
// update the product
if($course->update()){
    echo '{';
        echo '"message": "Course was updated."';
    echo '}';
}
 
// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to update course."';
    echo '}';
}
?>