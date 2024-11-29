<?php
session_start();
require_once '../Classes/Database.php';

$database = new Database();
$db = $database->getConnection();

if (!isset($_SESSION['user_id'])) {
    // If user is not logged in, redirect to login page
    header('Location: ../login/login_form.php');
    exit();
}

// Assuming the package is passed as a GET parameter
$package = $_GET['package'] ?? '';

if ($package) {
    // Here you would add your logic to handle the purchase
    // For example, you might insert a record into a purchases table
    // Or initiate a payment process

    $_SESSION['success'] = "You have successfully purchased the $package package!";
} else {
    $_SESSION['error'] = "Invalid package selected.";
}

// Redirect back to a relevant page, maybe a dashboard or packages page
header('Location: ../dash_boards/user_page.php');
exit();
?>
