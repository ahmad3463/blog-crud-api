<?php
require_once "config/db.php";

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");


$query = "SELECT * FROM posts";
$stmt = $conn->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// foreach($results as $result){
    
        echo json_encode($results);
    
        
// }

?>