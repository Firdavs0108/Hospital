<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Replace with your database connection logic
    $conn = new mysqli("localhost", "root", "W@2915djkf$", "user_registration");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn->query("DELETE FROM users");

    echo json_encode(['success' => true]);

    $conn->close();
}

?>

