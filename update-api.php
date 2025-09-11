<?php

require_once "config/db.php";

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers , Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input") , true);
$blog_id = $data['bid'];
$title = $data['title'];
$content = $data['content'];
$category = $data['category'];
$tags = $data['tags'];

try{
    $stmt = $conn->prepare("UPDATE  posts SET title =:title , content =:content  , category =:category  , tags =:tags WHERE id =:bid");

    $stmt->execute([
        ":bid" => $blog_id,
        ":title" => $title,
        ":content" => $content,
        ":category" => $category,
        ":tags" => $tags
        
    ]);
    
    
    // foreach($results as $result){

    if ($stmt->rowCount() > 0) {
        echo json_encode(["message" => "Blog has been updated", "status" => true]);
    } else {
        echo json_encode(["message" => "No changes made or Blog not found", "status" => false]);
    }
        
            
    // }
}catch(PDOException $e){
    echo json_encode(["message" => "Error " . $e->getMessage() , "status" => false]);
}



?>