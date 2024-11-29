<?php
session_start();
require_once '../Classes/Database.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id']; // Assuming user_id is stored in session
    $rating = $_POST['rating'];
    $comments = htmlspecialchars(strip_tags($_POST['comments']));

    // Validate the data
    if (!empty($rating) && !empty($comments)) {
        $query = "INSERT INTO feedback (userId, rating, comments) VALUES (:userId, :rating, :comments)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comments', $comments);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Feedback submitted successfully!";
        } else {
            $_SESSION['error'] = "Error submitting feedback.";
        }
    } else {
        $_SESSION['error'] = "All fields are required.";
    }

    // Redirect back to the feedback page
    header('Location: your_feedback_page.php');
    exit();
}
?>
