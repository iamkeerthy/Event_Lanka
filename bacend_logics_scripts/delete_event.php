<?php
// Database connection
require '../Classes/Database.php'; // Adjust path if necessary

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the event ID is received
    if (isset($_POST['eventId'])) {
        $eventId = $_POST['eventId']; // Get the event ID from the form

        // Initialize the database
        $database = new Database();
        $db = $database->getConnection();

        // Prepare and execute the delete query
        $stmt = $db->prepare("DELETE FROM event WHERE eventId = :eventId");
        $stmt->bindParam(':eventId', $eventId); // Bind the event ID to the query

        // Execute and check the result
        if ($stmt->execute()) {
            // Redirect to the admin dashboard
            header("Location: ../dash_boards/admin_page.php#Existing Events ? message=Event+deleted+successfully");
            exit(); // Terminate the script to ensure the redirection happens
        } else {
            echo "Error: Unable to delete event.";
        }
    } else {
        echo "Error: Event ID is missing.";
    }
} else {
    echo "Invalid request method.";
}
