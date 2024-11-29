<?php
// Database connection
require '../Classes/Database.php'; // Adjust this path according to your project structure

// Check if eventId is set in the URL
if (!isset($_GET['eventId'])) {
    die('Event ID not specified.');
}

$eventId = $_GET['eventId'];

// Fetch existing event details from the database
$stmt = $db->prepare("SELECT * FROM event WHERE eventId = :eventId");
$stmt->bindParam(':eventId', $eventId);
$stmt->execute();
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    die('Event not found.');
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventName = $_POST['eventName'];
    $eventType = $_POST['eventType'];
    $eventDescription = $_POST['eventDescription'];
    $eventDate = $_POST['eventDate'];
    $eventVenue = $_POST['eventVenue'];
    $noOfGuests = $_POST['noOfGuests'];

    // Update the event in the database
    $updateStmt = $db->prepare("UPDATE event SET eventName = :eventName, eventType = :eventType, eventDescription = :eventDescription, eventDate = :eventDate, eventVenue = :eventVenue, noOfGuests = :noOfGuests WHERE eventId = :eventId");
    $updateStmt->bindParam(':eventName', $eventName);
    $updateStmt->bindParam(':eventType', $eventType);
    $updateStmt->bindParam(':eventDescription', $eventDescription);
    $updateStmt->bindParam(':eventDate', $eventDate);
    $updateStmt->bindParam(':eventVenue', $eventVenue);
    $updateStmt->bindParam(':noOfGuests', $noOfGuests);
    $updateStmt->bindParam(':eventId', $eventId);

    if ($updateStmt->execute()) {
        header("Location: ../dash_boards/admin_page.php#Event Management"); // Redirect back to the dashboard
        exit;
    } else {
        echo "Error updating event.";
    }
}
?>