
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
            $targetDir = "uploads/"; // Specify the directory for uploads
            
            // Append user ID and timestamp to the original file name
            $fileExtension = strtolower(pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION));
            $fileName = 'profile_' . $userId . '_' . time() . '.' . $fileExtension;
            $profilePicture = $targetDir . $fileName;

            // Check for valid image types
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($fileExtension, $allowedTypes)) {
                // Move the uploaded file
                if (!move_uploaded_file($_FILES['profilePicture']['tmp_name'], $profilePicture)) {
                    $_SESSION['error'] = "Failed to upload image.";
                    header('Location: ../dash_boards/user_page.php#S_Profile');
                    exit();
                }
            } else {
                $_SESSION['error'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                header('Location: ../dash_boards/user_page.php#S_Profile');
                exit();
            }
        }

        // Prepare the SQL update query
        $query = "UPDATE user SET username = :username, email = :userEmail";
        
        // If a new profile picture is uploaded, include it in the update
        if ($profilePicture) {
            $query .= ", profilePicture = :profilePicture"; 
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
    header('Location: ../dash_boards/user_page.php#S_Profile');
    exit();
}
?>