<?php

// Connection to MySQL database (replace with your credentials)
$host = 'localhost';
$db = 'user_registration';
$user = 'root';
$pass = 'W@2915djkf$';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch and return the user's data
    $stmt = $conn->query("SELECT * FROM users LIMIT 1");
    
    // Check if there are rows in the result set
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($user);
    } else {
        // No user records found
        echo json_encode(['message' => 'No user records found']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
}

?>
