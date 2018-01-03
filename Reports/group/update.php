<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/group.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$group = new Group($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited
$group->group_id = $data->group_id;
 
// set product property values
$group->group_name = $data->group_name;
$group->group_year = $data->group_year;

// update the product
if($group->update()){
    echo '{';
        echo '"message": "Group was updated."';
    echo '}';
}
 
// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to update group."';
    echo '}';
}
?>