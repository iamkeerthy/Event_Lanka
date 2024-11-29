<?php
// Include your database connection
require '../Classes/Database.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the packageId is set
    if (isset($_POST['packageId'])) {
        $packageId = $_POST['packageId'];

        // Initialize the database
        $database = new Database();
        $db = $database->getConnection();

        // Prepare the delete query
        $stmt = $db->prepare("DELETE FROM packages WHERE packageId = :packageId");
        $stmt->bindParam(':packageId', $packageId);

        // Execute the query and handle the result
        if ($stmt->execute()) {
            header("Location: ../dash_boards/admin_page.php?message=Package+deleted+successfully");
            exit(); // Redirect to admin dashboard with success message
        } else {
            echo "Error: Unable to delete package.";
        }
    } else {
        echo "Error: Package ID is missing.";
    }
} else {
    echo "Invalid request method.";
}
?>
