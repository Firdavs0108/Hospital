<?php

// Replace with your database connection logic
$conn = new mysqli("localhost", "root", "W@2915djkf$", "user_registration");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM users LIMIT 1");

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode($user);
} else {
    echo json_encode(["error" => "User not found"]);
}

$conn->close();

?>

