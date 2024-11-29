<?php
session_start();
require_once '../Classes/Database.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming you have connected to the database
    $eventName = $_POST['eventName'];
    $eventType = $_POST['eventType'];
    $eventDescription = $_POST['eventDescription'];
    $eventDate = $_POST['eventDate'];
    $eventVenue = $_POST['eventVenue'];
    $noOfGuests = $_POST['noOfGuests'];
    $adminId = $_POST['adminId']; // Assuming you are passing this from your form

    $stmt = $db->prepare("INSERT INTO event (eventName, eventType, eventDescription, eventDate, eventVenue, noOfGuests, adminId) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$eventName, $eventType, $eventDescription, $eventDate, $eventVenue, $noOfGuests, $adminId]);


    // Set success message in session
    $_SESSION['success_message'] = "Event added successfully.";
    header('Location: ../dash_boards/admin_page.php#Event Management'); // Redirect back to admin page
    exit();

}
?>
