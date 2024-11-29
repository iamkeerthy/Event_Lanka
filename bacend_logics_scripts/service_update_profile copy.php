<?php
session_start();
require_once '../Classes/Database.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $username = $_POST['username'] ?? '';
    $userEmail = $_POST['userEmail'] ?? '';
    $userId = $_SESSION['user_id']; // Assuming user ID is stored in session

    // Validate inputs
    if (!empty($username) && !empty($userEmail)) {
        // Handle file upload if a new file is provided
        $profilePicture = null; // Default to null
        if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == 0) {
            $targetDir = "../uploads/"; // Specify the directory for uploads
            $profilePicture = $targetDir . basename($_FILES['profilePicture']['name']);
            move_uploaded_file($_FILES['profilePicture']['tmp_name'], $profilePicture);
        }

        // Prepare the SQL update query
        $query = "UPDATE user SET username = :username, email = :userEmail";
        
        // If a new profile picture is uploaded, include it in the update
        if ($profilePicture) {
            $query .= ", profilePicture = :profilePicture"; // Make sure to use the correct column name
        }
        
        $query .= " WHERE userId = :userId"; // Adjust this based on your table

        $stmt = $db->prepare($query);

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':userEmail', $userEmail);
        $stmt->bindParam(':userId', $userId);

        // If there is a new profile picture, bind that parameter
        if ($profilePicture) {
            $stmt->bindParam(':profilePicture', $profilePicture);
        }

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['success'] = "Profile updated successfully!";
        } else {
            $_SESSION['error'] = "Error updating profile: " . implode(", ", $stmt->errorInfo());
        }
    } else {
        $_SESSION['error'] = "All fields are required.";
    }

    // Redirect back to the profile page
    header('Location: ../dash_boards/serviceprovider.php#S_Profile');
    exit();
}
