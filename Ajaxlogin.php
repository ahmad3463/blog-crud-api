<?php
include "config/db.php";

header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $useremail = trim($_POST['useremail']);
    $userpass = trim($_POST['userpass']);

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = :email");
    $stmt->execute([":email" => $useremail]);

    if($stmt->rowCount() == 0){
        echo json_encode([
            "status" => false,
            "message" => "Email not found. Please sign up first"
        ]);
        exit;
    }

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if(password_verify($userpass , $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        echo json_encode([
            "status" => true,
            "message" => "Login successful!",
            "redirect" => "dashboard.html"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Invalid password."
        ]);
    }
}
