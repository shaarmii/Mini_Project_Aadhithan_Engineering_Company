<?php
// db_connection.php
$servername = "localhost";
$username = "root"; // default username for XAMPP
$password = ""; // default password is usually empty
$dbname = "engineering_db"; // change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
