<?php
include 'db_connect.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password']; // Huwag i-hash ang password

    // Check if email or username already exists
    $check_query = "SELECT * FROM users WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Email or Username already exists!";
    } else {
        // Insert user data into database
        $sql = "INSERT INTO users (fname, lname, username, email, contact, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $fname, $lname, $username, $email, $contact, $password);

        if ($stmt->execute()) {
            // Alert at redirect
            echo "<script>alert('Account created!'); window.location.href='login.php';</script>";
            exit();
        } else {
            echo "Error: " . $stmt->error; // Show error if insertion fails
        }
    }
}
?>