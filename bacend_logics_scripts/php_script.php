<?php
session_start();
require_once '../Classes/Database.php'; // Ensure you have a Database class to handle DB connections

// Create a connection to the database
$database = new Database();
$db = $database->getConnection();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $phone = htmlspecialchars(strip_tags($_POST['phone']));
    $subject = htmlspecialchars(strip_tags($_POST['subject']));
    $message = htmlspecialchars(strip_tags($_POST['message']));

    // Prepare the SQL statement
    $query = "INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (:name, :email, :phone, :subject, :message)";
    $stmt = $db->prepare($query);

    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':message', $message);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        $_SESSION['success'] = "Your message has been sent successfully!";
    } else {
        $_SESSION['error'] = "There was an error sending your message. Please try again later.";
    }

    // Redirect back to the contact page
    header('Location: contact.php'); // Update with the correct path to your contact page
    exit();
}
?>
