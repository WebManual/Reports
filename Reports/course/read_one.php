<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/course.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$course = new Course($db);
 
// set ID property of product to be edited
$course->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$course->readOne();
 
// create array
$course_arr = array(
    "course_id" =>  $course->course_id,
    "name" => $course->name,
    
);
 
// make it json format
print_r(json_encode($course_arr));
?>