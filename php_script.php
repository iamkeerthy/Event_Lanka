<?php
session_start();
include 'login/config.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (isset($_SESSION['user_name'])) {
        // Retrieve form data
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $subject = $conn->real_escape_string($_POST['subject']);
        $message = $conn->real_escape_string($_POST['message']);

        // Insert the message into the database
        $sql = "INSERT INTO messages (name, email, phone, subject, message) VALUES ('$name', '$email', '$phone', '$subject', '$message')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to index.php after successful submission
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Redirect to the login page if the user is not logged in
        header("Location: login/login_form.php");
        exit();
    }
}

$conn->close();
?>
