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

        $stmt = $conn->prepare("UPDATE users
                               SET full_name = :full_name, age = :age, phone_number = :phone_number,
                                   address = :address, city = :city, zip_code = :zip_code
                               WHERE id = :user_id"); // Assuming 'id' is the primary key
        $stmt->bindParam(':full_name', $_POST['full_name']);
        $stmt->bindParam(':age', $_POST['age']);
        $stmt->bindParam(':phone_number', $_POST['phone_number']);
        $stmt->bindParam(':address', $_POST['address']);
        $stmt->bindParam(':city', $_POST['city']);
        $stmt->bindParam(':zip_code', $_POST['zip_code']);
        $stmt->bindParam(':user_id', $_POST['id']); // Assuming 'id' is sent in the POST data
        $stmt->execute();

        $stmt = $conn->query("SELECT * FROM users WHERE id = :user_id LIMIT 1");
        $stmt->bindParam(':user_id', $_POST['id']); // Assuming 'id' is sent in the POST data
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode($user);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

