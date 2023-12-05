<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Connection to MySQL database (replace with your credentials)
    $host = 'localhost';
    $db = 'user_registration';
    $user = 'root';
    $pass = 'W@2915djkf$';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert or update user data in the database
        $stmt = $conn->prepare("INSERT INTO users (full_name, age, phone_number, address, city, zip_code)
                               VALUES (:full_name, :age, :phone_number, :address, :city, :zip_code)
                               ON DUPLICATE KEY UPDATE
                               full_name = :full_name, age = :age, phone_number = :phone_number,
                               address = :address, city = :city, zip_code = :zip_code");

        $stmt->bindParam(':full_name', $_POST['full_name']);
        $stmt->bindParam(':age', $_POST['age']);
        $stmt->bindParam(':phone_number', $_POST['phone_number']);
        $stmt->bindParam(':address', $_POST['address']);
        $stmt->bindParam(':city', $_POST['city']);
        $stmt->bindParam(':zip_code', $_POST['zip_code']);
        $stmt->execute();

        // Fetch and return the user's data
        $stmt = $conn->prepare("SELECT * FROM users WHERE full_name = :full_name");
        $stmt->bindParam(':full_name', $_POST['full_name']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode($user);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
