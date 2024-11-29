<?php
session_start();

require_once '../Classes/Database.php';
require_once '../Classes/User.php';
require_once '../Classes/Package.php'; // Include the PackageManager class

$database = new Database();
$db = $database->getConnection();

$userId = $_SESSION['user_id'];

// Fetch user data
$user = new User($db);
$userData = $user->fetchUserData($userId);

if (!$userData) {
    $_SESSION['error'] = "User data not found.";
    header('Location: ../login/login_form.php');
    exit();
}

// Instantiate PackageManager
$packageManager = new Package($db); // Ensure the class is instantiated

// Sanitize user data
$username = htmlspecialchars($userData['username'] ?? '');
$userEmail = htmlspecialchars($userData['email'] ?? '');
$userAvatar = htmlspecialchars($userData['profilePicture'] ?? 'uploads/default.png');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
    <style>
        #success-message {
            display: none;
            /* Initially hide the message */
            background-color: #d4edda;
            /* Green background */
            color: #155724;
            /* Dark green text */
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #c3e6cb;
            /* Light green border */
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="#A_Dashboard">Dashboard</a></li>
            <li><a href="#User Management">User Management</a></li>
            <li><a href="#Service Providers">Service Provider Management</a></li>
            <li><a href="#Services">Services Management</a></li>
            <li><a href="#A_Packages">Packages Management</a></li>
            <li><a href="#Existing Events">Existing Events</a></li>
            <li><a href="#Existing Packages">Existing Packages</a></li>
            <li><a href="../index.php">Back to Home page</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <header>
            <h1>Welcome Back Sir.. <?php echo $username; ?>!</h1>
        </header>

        <section class="section" id="A_Dashboard">
            <h2>Dashboard Overview</h2>
            <p>Total Users: 1500</p>
            <p>Total Events: 120</p>
            <p>Pending Approvals: 10</p>
        </section>

        <?php
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <section class="section" id="User Management">
            <h2>User Management</h2>
            <table>
                <thead>
                    <tr>
                        <th>Profile Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../Classes/Database.php';
                    $database = new Database();
                    $db = $database->getConnection();

                    // Fetch users from the database
                    $usersQuery = "SELECT * FROM user"; // Adjust the query as needed
                    $stmt = $db->prepare($usersQuery);
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td><img src="' . ($row['profilePicture'] ? $row['profilePicture'] : '../img/user.png') . '" alt="User Avatar" width="40"></td>';
                        echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['status']) . '</td>'; // Show user status here
                        echo '<td>
                        <form action="../bacend_logics_scripts/update_status.php" method="POST" style="display: inline;">
                            <input type="hidden" name="user_id" value="' . $row['userId'] . '">
                            <input type="hidden" name="action" value="block">
                            <button type="submit">Block</button>
                        </form>
                        <form action="../bacend_logics_scripts/update_status.php" method="POST" style="display: inline;">
                            <input type="hidden" name="user_id" value="' . $row['userId'] . '">
                            <input type="hidden" name="action" value="approve">
                            <button type="submit">Approve</button>
                        </form>
                        <form action="../bacend_logics_scripts/update_status.php" method="POST" style="display: inline;">
                            <input type="hidden" name="user_id" value="' . $row['userId'] . '">
                            <input type="hidden" name="action" value="reject">
                            <button type="submit">Reject</button>
                        </form>
                      </td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="section" id="Service Providers">
            <h2>Service Provider Management</h2>
            <table>
                <thead>
                    <tr>
                        <th>Profile Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Service Details</th>
                        <th>Status</th> <!-- New Status Column -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../Classes/Database.php';
                    $database = new Database();
                    $db = $database->getConnection();

                    // Fetch service providers from the database, including the status
                    $serviceProvidersQuery = "SELECT * FROM serviceprovider";
                    $stmt = $db->prepare($serviceProvidersQuery);
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td><img src="../uploads/' . htmlspecialchars($row['profileImage'] ?? '../Images Project/user_Icon.png') . '" alt="Provider Avatar" width="40"></td>';
                        echo '<td>' . htmlspecialchars($row['providerName']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['contactInfo']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['serviceDetails']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['status']) . '</td>'; // Displaying the status
                        echo '<td>
                        <form action="../bacend_logics_scripts/admin_actions.php" method="POST" style="display: inline;">
                            <input type="hidden" name="provider_id" value="' . $row['providerId'] . '">
                            <input type="hidden" name="action" value="block">
                            <button type="submit">Block</button>
                        </form>
                        <form action="../bacend_logics_scripts/admin_actions.php" method="POST" style="display: inline;">
                            <input type="hidden" name="provider_id" value="' . $row['providerId'] . '">
                            <input type="hidden" name="action" value="approve">
                            <button type="submit">Approve</button>
                        </form>
                        <form action="../bacend_logics_scripts/admin_actions.php" method="POST" style="display: inline;">
                            <input type="hidden" name="provider_id" value="' . $row['providerId'] . '">
                            <input type="hidden" name="action" value="reject">
                            <button type="submit">Reject</button>
                        </form>
                      </td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="section" id="Services">
            <h2>Services Management</h2>
            <table>
                <thead>
                    <tr>
                        <th>Service Name</th>
                        <th>Description</th>
                        <th>Provider</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch services from the database
                    $servicesQuery = "
            SELECT s.serviceId, s.serviceName, s.serviceDescription, sp.providerName, s.status 
            FROM services s
            JOIN serviceprovider sp ON s.userId = sp.userId"; // Join on userId

                    $stmt = $db->prepare($servicesQuery);
                    $stmt->execute();

                    // Check if the query was successful
                    if ($stmt) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['serviceName']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['serviceDescription']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['providerName']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['status']) . '</td>';
                            echo '<td>
                            <form action="../bacend_logics_scripts/service_actions.php" method="POST" style="display: inline;">
                                <input type="hidden" name="service_id" value="' . htmlspecialchars($row['serviceId']) . '">
                                <input type="hidden" name="action" value="approve">
                                <button type="submit">Approve</button>
                            </form>
                            <form action="../bacend_logics_scripts/service_actions.php" method="POST" style="display: inline;">
                                <input type="hidden" name="service_id" value="' . htmlspecialchars($row['serviceId']) . '">
                                <input type="hidden" name="action" value="reject">
                                <button type="submit">Reject</button>
                            </form>
                          </td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5">No services available.</td></tr>'; // Handle no services case
                    }
                    ?>
                </tbody>
            </table>
        </section>
<section>
<form action="../bacend_logics_scripts/package_management.php" method="POST">
    <label for="existingPackage">Select Package to Update:</label>
    <select name="existingPackage" id="existingPackage" required>
        <?php
        // Fetch all packages to populate the dropdown
        $package = new Package($db);
        $packages = $package->fetchAllPackages();
        
        foreach ($packages as $pkg) {
            echo "<option value='{$pkg['packageId']}'>{$pkg['packageName']}</option>";
        }
        ?>
    </select>

    <label for="packageDetails">Package Details:</label>
    <textarea name="packageDetails" required></textarea>

    <label for="packagePrice">Package Price (LKR):</label>
    <input type="number" name="packagePrice" step="0.01" required>

    <input type="hidden" name="adminId" value="<?php echo $_SESSION['adminId']; ?>">
    
    <button type="submit">Update Package</button>
</form>


</section>
            <section class="section" id="Existing Events">
                <h3>Existing Events</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Event Type</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Venue</th>
                            <th>Guests</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $eventsQuery = "SELECT * FROM event";
                        $stmt = $db->prepare($eventsQuery);
                        $stmt->execute();

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['eventName']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['eventType']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['eventDescription']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['eventDate']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['eventVenue']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['noOfGuests']) . '</td>';
                            echo '<td>
                      <form method="post" action="../bacend_logics_scripts/delete_event.php" style="display:inline;">
                          <input type="hidden" name="eventId" value="' . htmlspecialchars($row['eventId']) . '">
                          <button type="submit" onclick="return confirm(\'Are you sure you want to delete this event?\')">Delete</button>
                      </form>
                    </td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </section>

            <section class="section" id="Existing Packages">
                <h3>Existing Packages</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Package Name</th>
                            <th>Details</th>
                            <th>Service Provider</th>
                            <th>Price</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query to get package details along with service provider's name
                        $stmt = $db->query("
                SELECT p.*, sp.providerName 
                FROM packages p 
                JOIN serviceprovider sp ON p.providerId = sp.providerId
            ");

                        // Loop through the fetched data and display in the table
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['packageName']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['packageDetails']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['providerName']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['packagePrice']) . '</td>';
                            
                       
                        }
                        ?>
                    </tbody>
                </table>
            </section>

    </div>
</body>

</html>