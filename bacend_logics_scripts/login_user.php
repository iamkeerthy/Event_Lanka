<?php

require_once '../Classes/Database.php';
require_once '../Classes/user.php';
require_once '../Classes/Admin.php';
require_once '../Classes/RegisteredUser.php';
require_once '../Classes/ServiceProvider.php';

session_start();

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if (isset($_POST['submit'])) {
    $username = htmlspecialchars(strip_tags($_POST['name']));
    $password = $_POST['password']; // Password should not be sanitized for hashing

    if ($user->login($username, $password)) {
        $_SESSION['user_name'] = $user->username; 
        $_SESSION['user_type'] = $user->userType;
        $_SESSION['user_id'] = $user->userId;

        // Check if the user is an admin and set adminId in session
        if ($user->userType === 'admin') {
            // Assuming your User class has a method to get adminId
            $adminId = $user->getAdminId(); // Fetch adminId from user class or similar logic
            $_SESSION['adminId'] = $adminId; // Set adminId in the session
        }

        header('Location: ../index.php'); 
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password. Please try again.";
        header('Location: ../login/login_form.php');
        exit();
    }
}
