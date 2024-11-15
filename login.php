<?php
session_start();

// Dummy credentials (for demonstration purposes)
$valid_username = 'admin'; // Replace with your desired username
$valid_password = '12345'; // Replace with your desired password

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the credentials are valid
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.html"); // Redirect to the homepage
        exit;
    } else {
        echo "<script>alert('Invalid credentials, please try again.');</script>";
        echo "<script>window.location.href='login.html';</script>"; // Redirect back to login
    }
}
?>
