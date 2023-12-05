<?php

$host = 'localhost';
$db = 'user_registration';
$user = 'root';
$pass = 'W@2915djkf$';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Delete all user profiles
    $deletedRows = $conn->exec("DELETE FROM users");

    if ($deletedRows !== false) {
        // Operation was successful
        echo json_encode(['success' => true]);
    } else {
        // No records were deleted
        echo json_encode(['success' => false, 'message' => 'No records to delete']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

?>
