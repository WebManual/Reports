<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/group.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$group = new Group($db);
 
// set ID property of product to be edited
$group->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$group->readOne();
 
// create array
$group_arr = array(
    "group_id" =>  $group->group_id,
    "group_name" => $group->group_name,
    "group_year" => $group->group_year

);
 
// make it json format
print_r(json_encode($group_arr));
?>