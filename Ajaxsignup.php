<?php 
include "config/db.php";
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username  = trim($_POST['username']);
    $useremail = trim($_POST['useremail']);
    $userpass  = trim($_POST['userpass']);

    // Check if email already exists
    $stmtCheck = $conn->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
    $stmtCheck->execute([":email" => $useremail]);

    if ($stmtCheck->rowCount() > 0) {
        echo json_encode([
            "message" => "Email already registered. Please login.",
            "status" => false
        ]);
        exit;
    }

    // Hash password
    $hashedPassword = password_hash($userpass, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) 
                                VALUES (:username, :email, :password)");
        $stmt->execute([
            ":username" => $username,
            ":email"    => $useremail,
            ":password" => $hashedPassword,
        ]);

        if ($stmt->rowCount() > 0) {
            $userId = $conn->lastInsertId();

            // ✅ create session immediately after signup
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;

            echo json_encode([
                "message"  => "Signup successful. Redirecting...",
                "status"   => true,
                "redirect" => "dashboard.html"
            ]);
            exit;
        } else {
            echo json_encode([
                "message" => "Something went wrong. Please try again.",
                "status"  => false
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            "message" => "Error: " . $e->getMessage(),
            "status"  => false
        ]);
    }
}
?>
