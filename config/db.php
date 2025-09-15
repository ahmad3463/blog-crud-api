<?php
session_start();
$servername = "localhost";
$dbname = "blogging_API";
$username = "root";
$password = "";


    try{

        $conn = new PDO("mysql:host=$servername;dbname=$dbname" , $username ,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

        // if($conn){
        //     echo "connected successfully";
        // }
    }catch(PDOException $e){
        echo "not Conntect" . $e->getmessage();
    }

?>