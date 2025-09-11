<?php
require_once "config/db.php";

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers , Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input") , true);

$blog_id = $data['bid'];

try{

    $stmt = $conn->prepare("DELETE  FROM posts WHERE id = :bid");

$stmt->execute([":bid" => $blog_id]);


// foreach($results as $result){
        if($stmt->rowCount() > 0 ){

            echo json_encode(value: ["message" => "data has been delete" , "status" => true ]);
        }else{
            echo json_encode(["message" => "data not found" , "status" => false]);
        }
    
        
// }

}catch(PDOException $e){
    echo json_encode(value: ["message" => "Error" . $e->getMessage() , "status" => false]);
}



?>