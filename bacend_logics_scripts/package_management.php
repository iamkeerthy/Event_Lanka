<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include_once '../Classes/Database.php'; 
    include_once '../Classes/Package.php'; 

    $database = new Database(); 
    $db = $database->getConnection();

    $package = new Package($db);

    // Get packageId of the package to update
    $packageId = $_POST['existingPackage'];

    // Set package properties from POST data
    $package->packageDetails = $_POST['packageDetails'];
    $package->packagePrice = $_POST['packagePrice'];

    // Check if adminId is set
    if (isset($_POST['adminId'])) {
        $package->adminId = $_POST['adminId']; 
    } else {
        echo "Admin ID is not set.";
        exit;
    }

    // Attempt to update the package
    try {
        if ($package->updatePackage($packageId)) {
            $_SESSION['success_message'] = "Package updated successfully.";
        } else {
            $_SESSION['error_message'] = "Failed to update package.";
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Error: " . $e->getMessage();
    }

    // Redirect back to the package management page after processing
    header("Location: ../dash_boards/admin_page.php");
    exit;
}


?>