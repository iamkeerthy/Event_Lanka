<?php
session_start();

$uploadMessage = ''; // Variable to store success or error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    include '../Classes/Database.php';
    $conn = (new Database())->getConnection();

    // Ensure userId is retrieved from the session
    $userId = $_SESSION['user_id'] ?? '';
    if (empty($userId)) {
        $uploadMessage = "You must be logged in to upload a service.";
    } else {
        // Get form data and validate
        $serviceName = htmlspecialchars($_POST['serviceName'] ?? '');
        $serviceDescription = htmlspecialchars($_POST['serviceDescription'] ?? '');
        $tier = htmlspecialchars($_POST['tier'] ?? '');
        $servicePrice = $_POST['servicePrice'] ?? 0;

        // Validate service price
        if (!is_numeric($servicePrice) || $servicePrice < 0) {
            $uploadMessage = "Invalid price provided.";
        } else {
            // Initialize the image path variable
            $serviceImagePath = NULL;

            // Check if file is uploaded
            if (!empty($_FILES['serviceImage']) && $_FILES['serviceImage']['error'] == 0) {
                $serviceImage = $_FILES['serviceImage'];

                // Handle file upload
                $targetDir = "uploads/";
                $uniqueFileName = preg_replace("/[^a-zA-Z0-9\._-]/", "", uniqid() . "_" . basename($serviceImage['name']));
                $targetFile = $targetDir . $uniqueFileName;
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                // Validate image file type
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($imageFileType, $allowedTypes)) {
                    if ($serviceImage['size'] <= 5000000) {
                        $check = getimagesize($serviceImage['tmp_name']);
                        if ($check !== false) {
                            if (move_uploaded_file($serviceImage['tmp_name'], $targetFile)) {
                                $serviceImagePath = $targetFile;
                            } else {
                                $uploadOk = 0;
                                $uploadMessage = "Sorry, there was an error uploading your file.";
                            }
                        } else {
                            $uploadOk = 0;
                            $uploadMessage = "File is not a valid image.";
                        }
                    } else {
                        $uploadOk = 0;
                        $uploadMessage = "Sorry, your file is too large.";
                    }
                } else {
                    $uploadOk = 0;
                    $uploadMessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                }
            } else {
                $uploadOk = 1;
            }

            if ($uploadOk) {
                $sql = "INSERT INTO services (userId, serviceName, serviceDescription, tier, price, status, serviceImage)
                        VALUES (:userId, :serviceName, :serviceDescription, :tier, :price, 'pending', :serviceImage)";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':userId', $userId);
                $stmt->bindParam(':serviceName', $serviceName);
                $stmt->bindParam(':serviceDescription', $serviceDescription);
                $stmt->bindParam(':tier', $tier);
                $stmt->bindParam(':price', $servicePrice);
                $stmt->bindParam(':serviceImage', $serviceImagePath, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    $uploadMessage = "Service uploaded successfully!";
                } else {
                    $uploadMessage = "Failed to upload service. Error: " . implode(", ", $stmt->errorInfo());
                }
            }
        }
    }
}

// Store the upload message in session to be shown on the next page
$_SESSION['uploadMessage'] = $uploadMessage;

// Redirect back to the profile page
header('Location: ../dash_boards/serviceprovider.php#S_Profile');
exit();
?>
