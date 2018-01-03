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
include_once '../objects/group.php';
 
$database = new Database();
$db = $database->getConnection();
 
$group = new Group($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set course property values
$group->group_name = $data->group_name;
$group->group_year = $data->group_year;


 
// create the course
if($group->create()){
    echo '{';
        echo '"message": "Group was created."';
    echo '}';
}
 
// if unable to create the course, tell the user
else{
    echo '{';
        echo '"message": "Unable to create group."';
    echo '}';
}
?>