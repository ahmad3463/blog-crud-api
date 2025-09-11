<?php
require_once "config/db.php";

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: DELETE");
// header("Access-Control-Allow-Headers: Access-Control-Allow-Headers , Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input") , true);

$title = $data['title'];

try{

    $stmt = $conn->prepare("SELECT * FROM posts WHERE title LIKE  :title");

$stmt->execute([":title" => "%$title%"]);
$results = $stmt->fetchAll(pdo::FETCH_OBJ);


// foreach($results as $result){
        if($results ){

            echo json_encode(value: ["message" => "data found " , "status" => true , "data" => $results ]);
        }else{
            echo json_encode(["message" => "data not found" , "status" => false]);
        }
    
        
// }

}catch(PDOException $e){
    echo json_encode(value: ["message" => "Error" . $e->getMessage() , "status" => false]);
}



?>