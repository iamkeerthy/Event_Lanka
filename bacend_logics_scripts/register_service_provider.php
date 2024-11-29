<?php
session_start();

require_once '../Classes/Database.php'; 
require_once '../Classes/User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $database = new Database();
    $db = $database->getConnection(); 

    $user = new User($db); 

    $providerName = htmlspecialchars(strip_tags($_POST['providerName']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $contactInfo = htmlspecialchars(strip_tags($_POST['contactInfo']));
    $username = htmlspecialchars(strip_tags($_POST['username']));
    $password = $_POST['password']; 
    $userType = 'serviceProvider'; 

    $user->username = $username;
    $user->password = $password; 
    $user->email = $email;
    $user->userType = $userType;

    // Check if passwords match
    if ($_POST['password'] !== $_POST['cpassword']) {
        echo "<script>alert('Passwords do not match!'); window.location.href='../login/serviceprovider_registration.php';</script>";
        exit();
    }

    // Check for duplicate username or email in the users table
    $checkQuery = "SELECT * FROM user WHERE username = :username OR email = :email LIMIT 1";
    $checkStmt = $db->prepare($checkQuery);
    
    $checkStmt->bindParam(':username', $username);
    $checkStmt->bindParam(':email', $email);
    
    $checkStmt->execute();
    $existingUser = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
    if ($existingUser) {
        // Duplicate found, show error message
        if ($existingUser['username'] == $username) {
            echo "<script>alert('The username is already taken. Please choose another username.'); window.location.href='../login/serviceprovider_registration.php';</script>";
        } elseif ($existingUser['email'] == $email) {
            echo "<script>alert('The email is already registered. Please use another email.'); window.location.href='../login/serviceprovider_registration.php';</script>";
        }
        exit();
    }

    // If no duplicates found, proceed with registration
    if ($user->register()) {

        // Insert into the serviceprovider table
        $query = "INSERT INTO serviceprovider (userId, providerName, contactInfo, serviceDetails) VALUES (:userId, :providerName, :contactInfo, :serviceDetails)";
        $stmt = $db->prepare($query);

        $userId = $user->userId;
        $serviceDetails = htmlspecialchars(strip_tags($_POST['serviceDetails']));

        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':providerName', $providerName);
        $stmt->bindParam(':contactInfo', $contactInfo);
        $stmt->bindParam(':serviceDetails', $serviceDetails);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful! Your account is pending admin approval.'); window.location.href='../index.php';</script>";
        } else {
            echo "<script>alert('Failed to register service provider details.'); window.location.href='../login/serviceprovider_registration.php';</script>";
        }
    } else {
        echo "<script>alert('Failed to register user.'); window.location.href='../login/serviceprovider_registration.php';</script>";
    }
}
?>
