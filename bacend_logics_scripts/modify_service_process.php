<?php
session_start();
require_once '../Classes/Service.php'; // Include your Service class
require_once '../Classes/Database.php'; // Include your database connection

// Create a new instance of the Database class to get the $db connection
$database = new Database(); // Assuming your Database class has a constructor that creates a PDO instance
$db = $database->getConnection(); // Get the database connection

// Instantiate the Service class with the database connection
$service = new Service($db); // Create an instance of the Service class

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    if (isset($_POST['service_id']) && !empty($_POST['service_id'])) {
        $service->serviceId = htmlspecialchars($_POST['service_id']);
        
        // Fetch existing service details to pre-populate the form if necessary
        $existingService = $service->fetchServiceById($service->serviceId);
        
        if ($existingService) {
            // Validate and assign serviceName and serviceDescription
            $service->serviceName = htmlspecialchars(strip_tags($_POST['serviceName'] ?? $existingService['serviceName']));
            $service->serviceDescription = htmlspecialchars(strip_tags($_POST['serviceDescription'] ?? $existingService['serviceDescription']));
        } else {
            $_SESSION['error'] = "Service not found.";
            header('Location: ../dash_boards/serviceprovider.php#S_Profile');
            exit();
        }

        // Handle file upload
        if (!empty($_FILES['serviceImage']['name'])) {
            $targetDirectory = "../uploads/";
            $targetFile = $targetDirectory . basename($_FILES["serviceImage"]["name"]);
            
            // Move uploaded file
            if (move_uploaded_file($_FILES["serviceImage"]["tmp_name"], $targetFile)) {
                $service->serviceImage = htmlspecialchars($targetFile); // Save the new image path
            } else {
                $_SESSION['error'] = "Sorry, there was an error uploading your file.";
                header('Location: ../dash_boards/serviceprovider.php#S_Profile');
                exit();
            }
        } else {
            // Keep the existing image if no new image is uploaded
            $service->serviceImage = $existingService['serviceImage'];
        }

        // Update service in the database
        if ($service->updateService()) {
            $_SESSION['success'] = "Service updated successfully.";
        } else {
            $_SESSION['error'] = "Failed to update the service.";
        }
    } else {
        $_SESSION['error'] = "Invalid service ID.";
    }
    
    // Redirect back to the services page
    header('Location: ../dash_boards/serviceprovider.php#S_Profile');
    exit();
}
