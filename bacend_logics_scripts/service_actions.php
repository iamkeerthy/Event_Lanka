<?php
session_start();
require_once '../Classes/Database.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serviceId = $_POST['service_id'] ?? null;
    $action = $_POST['action'] ?? null;

    if ($action && $serviceId) {
        $status = ($action === 'approve') ? 'approved' : 'rejected';
        $message = ($action === 'approve') ? 'Your service has been approved.' : 'Your service has been rejected.';

        // Update service status
        $query = "UPDATE services SET status = :status WHERE serviceId = :serviceId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':serviceId', $serviceId);

        if ($stmt->execute()) {
            // Fetch userId based on serviceId
            $userIdQuery = "SELECT userId FROM services WHERE serviceId = :serviceId";
            $userIdStmt = $db->prepare($userIdQuery);
            $userIdStmt->bindParam(':serviceId', $serviceId);
            $userIdStmt->execute();
            $userId = $userIdStmt->fetchColumn();

            // if ($userId) {
            //     // Insert notification for the service provider
            //     $notifQuery = "INSERT INTO notifications (userId, adminId, message) VALUES (:userId, :adminId, :message)";
            //     $notifStmt = $db->prepare($notifQuery);
            //     $notifStmt->bindParam(':userId', $userId);
            //     $notifStmt->bindParam(':adminId', $adminId);
            //     $notifStmt->bindParam(':message', $message);

            //     if ($notifStmt->execute()) {
            //         $_SESSION['success_message'] = ucfirst($action) . ' successful.';
            //     } else {
            //         $_SESSION['error_message'] = 'Notification insertion failed.';
            //     }
            // } else {
            //     $_SESSION['error_message'] = 'Service provider not found. Notification not sent.';
            // }
        }
    }

    header('Location: ../dash_boards/admin_page.php#Services');
    exit();
}
?>
