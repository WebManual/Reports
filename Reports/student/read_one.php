<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/student.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$student = new Student($db);
 
// set ID property of product to be edited
$student->student_id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$student->readOne();
 
// create array
$student_arr = array(
    "student_id" =>  $student->student_id,
    "fullname" => $student->fullname,
    "birthday" => $student->birthday,
    "group_name" => $student->group_name,
    "sex" => $student->sex,
    "status" => $student->status,
    
);
 
// make it json format
print_r(json_encode($student_arr));
?>