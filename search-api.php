<?php
require_once "config/db.php";

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

try {
    // safe default
    $search = $_GET['search'] ?? '';  

    if (!empty($search)) {
        $stmt = $conn->prepare("SELECT * FROM posts WHERE title LIKE :title");
        $stmt->execute([":title" => "%$search%"]);
    } else {
        // if no search term, fetch all
        $stmt = $conn->prepare("SELECT * FROM posts");
        $stmt->execute();
    }

    $results = $stmt->fetchAll(PDO::FETCH_OBJ);

    if ($results) {
        echo json_encode([
            "message" => "data found",
            "status"  => true,
            "data"    => $results
        ]);
    } else {
        echo json_encode([
            "message" => "data not found",
            "status"  => false
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        "message" => "Error: " . $e->getMessage(),
        "status"  => false
    ]);
}
?>
