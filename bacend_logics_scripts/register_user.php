<?php
session_start(); // Start the session

require_once '../Classes/Database.php'; 
require_once '../Classes/User.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $database = new Database();
    $db = $database->getConnection(); 

    $user = new User($db);

    // Collect and sanitize input
    $username = htmlspecialchars(strip_tags(trim($_POST['username'])));
    $password = $_POST['password']; 
    $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
    $userType = 'registered'; 

    // Set properties for the user object
    $user->username = $username;
    $user->password = $password; // This will be hashed in the register method
    $user->email = $email;
    $user->userType = $userType;

    // Check if passwords match
    if ($password !== $_POST['cpassword']) {
        $_SESSION['error'] = "Passwords do not match!";
        header('Location: ../login/register_form.php');
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format!";
        header('Location: ../login/register_form.php');
        exit();
    }

    // Check if username or email already exists
    if ($user->userExists($username, $email)) {
        $_SESSION['error'] = "This username or email already exists!";
        header('Location: ../login/register_form.php');
        exit();
    }

    try {
        // Attempt to register the user
        if ($user->register()) {
            $_SESSION['success'] = "Registration successful! You can now log in.";
            header('Location: ../login/login_form.php');
            exit();
        } else {
            throw new Exception("Registration failed. Please try again.");
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: ../login/register_form.php');
        exit();
    }
}
?>
