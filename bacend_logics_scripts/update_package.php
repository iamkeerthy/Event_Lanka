<?php
// Include your database connection
require '../Classes/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['packageId'], $_POST['packageName'], $_POST['packageDetails'], $_POST['packagePrice'])) {
        $packageId = $_POST['packageId'];
        $packageName = $_POST['packageName'];
        $packageDetails = $_POST['packageDetails'];
        $packagePrice = $_POST['packagePrice'];

        // Initialize the database
        $database = new Database();
        $db = $database->getConnection();

        // Prepare the update query
        $stmt = $db->prepare("UPDATE packages SET packageName = :packageName, packageDetails = :packageDetails, packagePrice = :packagePrice WHERE packageId = :packageId");
        $stmt->bindParam(':packageName', $packageName);
        $stmt->bindParam(':packageDetails', $packageDetails);
        $stmt->bindParam(':packagePrice', $packagePrice);
        $stmt->bindParam(':packageId', $packageId);

        // Execute the update and handle the result
        if ($stmt->execute()) {
            header("Location: ../dash_boards/admin_page.php#Existing Packages?message=Package+updated+successfully");
            exit();
        } else {
            echo "Error: Unable to update package.";
        }
    } else {
        echo "Error: Missing package details.";
    }
} else {
    echo "Invalid request method.";
}
?>
