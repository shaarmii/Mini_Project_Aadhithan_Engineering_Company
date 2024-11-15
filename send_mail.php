<?php
// Load Composer's autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the database connection file
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password is usually empty
$dbname = "engineering_db"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];


    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contact_form (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute the statement and check for errors
    if (!$stmt->execute()) {
        echo "Error storing data in database: " . $stmt->error;
    }

    

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'shaarmi947@gmail.com';
        $mail->Password = 'sfmwvmirzyynvmpd';
        $mail->SMTPSecure ='tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('gajendran361@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "Name: $name<br>Email: $email<br>Message: $message";

        // Send the email
        $mail->send();
        echo "Message has been sent successfully!";
    } catch (Exception $e) {
        echo "Oops! Something went wrong and we couldn't send your message. Error: {$mail->ErrorInfo}";
    }
}
?>

