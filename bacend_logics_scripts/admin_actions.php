<?php
session_start();
require_once '../Classes/Database.php';
$database = new Database();
$db = $database->getConnection();

// // Check if the admin is logged in
// if (!isset($_SESSION['admin_id'])) {
//     // Redirect to login page if admin_id is not set
//     header('Location: ../login.php'); 
//     exit();
// }

$adminId = $_SESSION['admin_id'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $providerId = $_POST['provider_id'] ?? null;
    $message = '';

    // Sanitize the action value and determine the new status and message
    if (in_array($action, ['block', 'approve', 'reject'])) {
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

        // Update the service provider status
        if (!empty($providerId)) {
            try {
                $updateQuery = "UPDATE serviceprovider SET status = :status WHERE providerId = :id";
                $stmt = $db->prepare($updateQuery);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':id', $providerId);
                if ($stmt->execute()) {
                    // Insert notification after updating the status
                    $notifQuery = "INSERT INTO notifications (userId, serviceProviderId, adminId, message) 
                                   VALUES (NULL, :provider_id, :admin_id, :message)";
                    $notifStmt = $db->prepare($notifQuery);
                    $notifStmt->bindParam(':provider_id', $providerId);  // This is a provider action, so userId can be NULL
                    $notifStmt->bindParam(':admin_id', $adminId);
                    $notifStmt->bindParam(':message', $message);
                    
                    // Check if notification insertion is successful
                    if ($notifStmt->execute()) {
                        // Redirect back with success message
                        $_SESSION['success_message'] = ucfirst($action) . ' successful.';
                    } else {
                        $_SESSION['error_message'] = 'Notification insertion failed.';
                    }
                } else {
                    // Error occurred
                    $_SESSION['error_message'] = 'Action failed. Please try again.';
                }
            } catch (PDOException $e) {
                // Log the error message
                $_SESSION['error_message'] = 'Database error: ' . $e->getMessage();
            }
            header('Location: ../dash_boards/admin_page.php#Service Providers');
            exit();
        }
    }
}
?>
