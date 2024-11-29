<?php
// Include your database connection
require '../Classes/Database.php';

// Initialize the database
$database = new Database();
$db = $database->getConnection();

// Check if packageId is passed
if (isset($_GET['packageId'])) {
    $packageId = $_GET['packageId'];

    // Fetch the package details
    $stmt = $db->prepare("SELECT * FROM packages WHERE packageId = :packageId");
    $stmt->bindParam(':packageId', $packageId);
    $stmt->execute();
    $package = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the package exists
    if ($package) {
        // Display the form with package details
        echo '<form method="post" action="update_package.php">
                <input type="hidden" name="packageId" value="' . htmlspecialchars($packageId) . '">
                <label>Package Name</label>
                <input type="text" name="packageName" value="' . htmlspecialchars($package['packageName']) . '">
                <label>Details</label>
                <textarea name="packageDetails">' . htmlspecialchars($package['packageDetails']) . '</textarea>
                <label>Price</label>
                <input type="text" name="packagePrice" value="' . htmlspecialchars($package['packagePrice']) . '">
                <button type="submit">Update Package</button>
              </form>';
    } else {
        echo "Package not found.";
    }
} else {
    echo "Package ID not provided.";
}
?>
