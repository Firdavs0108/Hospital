<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Replace with your database connection logic
    $conn = new mysqli("localhost", "root", "W@2915djkf$", "user_registration");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $full_name = $_POST["full_name"];
    $age = $_POST["age"];
    $phone_number = $_POST["phone_number"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $zip_code = $_POST["zip_code"];

    $sql = "INSERT INTO users (full_name, age, phone_number, address, city, zip_code)
            VALUES ('$full_name', $age, '$phone_number', '$address', '$city', '$zip_code')
            ON DUPLICATE KEY UPDATE
            full_name = '$full_name', age = $age, phone_number = '$phone_number',
            address = '$address', city = '$city', zip_code = '$zip_code'";

    if ($conn->query($sql) === TRUE) {
        $user_id = $conn->insert_id;
        $result = $conn->query("SELECT * FROM users WHERE id = $user_id");
        $user = $result->fetch_assoc();
        echo json_encode($user);
    } else {
        echo json_encode(["error" => $conn->error]);
    }

    $conn->close();
}

?>


?>
