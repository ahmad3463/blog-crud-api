<?php
    include "config/db.php";

    if(isset($_SESSION['username'])){
        echo json_encode(["status" => true , "message" => $_SESSION['username']]);
    }else{
        echo json_encode(["status" => false , "message" => "user Not logged in"]);
    }
?>