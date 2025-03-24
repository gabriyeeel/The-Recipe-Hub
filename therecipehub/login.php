<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password == $row['password']) { // Insecure, but keeping as per your request
            $_SESSION['user_ID'] = $row['user_ID'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_lvl'] = $row['user_lvl'];

            if ($row['user_lvl'] == 1) {
                header("Location: admin.php");
            } else {
                header("Location: home.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "Wrong password.";
        }
    } else {
        $_SESSION['error'] = "Email not found.";
    }
    $_SESSION['email_input'] = $email;
}

header("Location: login-signup.php");
exit();
?>
