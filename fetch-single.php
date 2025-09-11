<?php
require_once "config/db.php";

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$data = json_decode(file_get_contents("php://input") , true);

$blog_id = $data['bid'];

$query = "SELECT * FROM posts WHERE Id = :bid";
$stmt = $conn->prepare($query);

$stmt->execute([":bid" => $blog_id]);
$results = $stmt->fetch(PDO::FETCH_OBJ);

// foreach($results as $result){
        if($results){

            echo json_encode($results);
        }else{
            echo json_encode(["message" => "data not found"]);
        }
    
        
// }

?>