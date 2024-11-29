<?php
session_start();

// Include necessary classes and database connection
require_once '../Classes/Database.php';
require_once '../Classes/Service.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the service_id is provided
    if (!empty($_POST['service_id'])) {
        $serviceId = $_POST['service_id'];

        // Get the database connection
        $db = (new Database())->getConnection();

        // Instantiate the Service class
        $service = new Service($db);
        $service->serviceId = $serviceId; // Set the service ID

        // Perform deletion and check the result
        if ($service->deleteService()) {
            // Redirect to the services page with success message
            $_SESSION['message'] = "Service deleted successfully!";
            header('Location: ../dash_boards/serviceprovider.php#S_Profile');
            exit();
        } else {
            // Redirect to the services page with an error message
            $_SESSION['error'] = "Failed to delete the service. Please try again.";
            header('Location: ../dash_boards/serviceprovider.php#S_Profile');
            exit();
        }
    } else {
        // Redirect if no service_id was provided
        $_SESSION['error'] = "No service selected for deletion.";
        header('Location: ../dash_boards/serviceprovider.php#S_Profile');
        exit();
    }
}
?>
