<?php
require_once "config/db.php";

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (!isset($data['bid']) || empty($data['bid'])) {
    echo json_encode(["message" => "Blog ID is required", "status" => false]);
    exit;
}

$blog_id = $data['bid'];

try {
    $query = "SELECT * FROM posts WHERE id = :bid";
    $stmt = $conn->prepare($query);
    $stmt->execute([":bid" => $blog_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode(["message" => $result, "status" => true]);
    } else {
        echo json_encode(["message" => "Data not found", "status" => false]);
    }

} catch (PDOException $e) {
    echo json_encode(["message" => "Error: " . $e->getMessage(), "status" => false]);
}
?>
