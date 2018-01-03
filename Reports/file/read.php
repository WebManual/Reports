<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/file.php';
 
// instantiate database and course object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$file = new File($db);
 
// query courses
$stmt = $file->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // courses array
    $file_arr=array();
    $file_arr["records"]=array();
 
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $file_item=array(
            "course_id" => $name,
            "student_id" => $fullname,
            "link" => $link,
        );
 
        array_push($file_arr["records"], $file_item);
    }
 
    echo json_encode($file_arr);
}
 
else{
    echo json_encode(
        array("message" => "Files not found.")
    );
}
?>