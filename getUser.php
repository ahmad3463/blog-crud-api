<?php
    include "config/db.php";
    header("Content-Type: application/json");

    if(isset($_SESSION['username'])){
        echo json_encode(["status" => true , "message" => $_SESSION['username']]);
    }else{
        echo json_encode(["status" => false , "message" => "user Not logged in"]);
    }
?>