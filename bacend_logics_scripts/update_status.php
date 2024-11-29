<?php
require_once '../Classes/Database.php';
session_start(); // Ensure session is started

$database = new Database();
$db = $database->getConnection();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $userId = $_POST['user_id'] ?? null;
    $providerId = $_POST['provider_id'] ?? null;

    // If action is for user management
    if ($userId) {
        $table = 'user';
        $idField = 'userId';
    }

    // If action is for service provider management
    if ($providerId) {
        $table = 'serviceprovider';
        $idField = 'providerId';
    }

    // Sanitize the action value
    if (in_array($action, ['block', 'approve', 'reject'])) {
        // Update the status based on the action
        $status = '';
        if ($action === 'block') {
            $status = 'blocked';
            $message = 'Your account has been blocked by the admin.';
        } elseif ($action === 'approve') {
            $status = 'approved';
            $message = 'Your account has been approved by the admin.';
        } elseif ($action === 'reject') {
            $status = 'rejected';
            $message = 'Your account has been rejected by the admin.';
        }

        // Update the respective table
        if (!empty($table) && !empty($idField)) {
            $id = $userId ?? $providerId;
            $updateQuery = "UPDATE $table SET status = :status WHERE $idField = :id";
            $stmt = $db->prepare($updateQuery);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
  // Assuming $userId is obtained from your previous actions
$userId = $_POST['user_id']; // Adjust this according to your form submission

// Check if the user exists
$checkUserQuery = "SELECT * FROM registereduser WHERE userId = :userId";
$checkStmt = $db->prepare($checkUserQuery);
$checkStmt->bindParam(':userId', $userId);
$checkStmt->execute();

if ($checkStmt->rowCount() > 0) {
    // User exists, proceed with notification insertion
    $insertQuery = "INSERT INTO notifications (userId, message, createdAt, isRead, serviceProviderId, adminId) 
                    VALUES (:userId, :message, NOW(), 0, :serviceProviderId, :adminId)";
    
    // Prepare and execute the insert statement here...
} else {
    // User does not exist, handle the error
    echo "Error: User with ID $userId does not exist.";
}



                // Redirect back with success message
                $_SESSION['success_message'] = ucfirst($action) . ' successful.';
                header('Location: ../dash_boards/admin_page.php#User Management');
                exit();
            } else {
                // Error occurred
                $_SESSION['error_message'] = 'Action failed. Please try again.';
                header('Location: ../dash_boards/admin_page.php');
                exit();
            }
        }
    }
}
?>
