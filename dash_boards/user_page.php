<?php
session_start();
require_once '../Classes/Database.php';
require_once '../Classes/User.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login_form.php');
    exit();
}

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Fetch user data
$userId = $_SESSION['user_id'];
$user = new User($db);
$userData = $user->fetchUserData($userId);

if (!$userData) {
    $_SESSION['error'] = "User data not found.";
    header('Location: ../login/login_form.php');
    exit();
}

// Sanitize user data
$username = htmlspecialchars($userData['username'] ?? ''); 
$userEmail = htmlspecialchars($userData['email'] ?? ''); 
$userAvatar = htmlspecialchars($userData['profilePicture'] ?? 'uploads/default.png'); 

// Fetch user events
$userEventsQuery = "
SELECT e.eventName, e.eventDate, sp.providerName AS serviceProvider
FROM event e
JOIN usereventbooking ub ON e.eventId = ub.eventId
JOIN serviceprovider sp ON ub.userId = sp.userId
WHERE ub.userId = :userId";

$stmt = $db->prepare($userEventsQuery);
$stmt->bindParam(':userId', $userId);
$stmt->execute();
$userEvents = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch user services
$userServicesQuery = "
SELECT s.serviceName, sp.providerName AS providerName, s.status
FROM services s
JOIN serviceprovider sp ON s.userId = sp.userId
WHERE s.userId = :userId";
$stmt = $db->prepare($userServicesQuery);
$stmt->bindParam(':userId', $userId);
$stmt->execute();
$userServices = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch payments
$paymentsQuery = "
SELECT p.paymentId, e.eventName, p.advanceAmount AS advance, p.dueAmount AS balance
FROM payment p
JOIN event e ON p.packageId = e.eventId
WHERE p.userId = :userId";
$stmt = $db->prepare($paymentsQuery);
$stmt->bindParam(':userId', $userId);
$stmt->execute();
$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);



// Fetch notifications
$notificationsQuery = "SELECT message FROM notifications WHERE userId = :userId";
$stmt = $db->prepare($notificationsQuery);
$stmt->bindParam(':userId', $userId);
$stmt->execute();
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/user.css">
</head>
<body>
<div class="sidebar">
    <h2>User Dashboard</h2>
    <ul>
        <li><a href="#U_Profile">Profile</a></li>
        <li><a href="#Events">My Events</a></li>
        <li><a href="#U_Service">My Services</a></li>
        <li><a href="#U_Notifications">Notifications</a></li>
        <li><a href="#U_Payments">Payments</a></li>
        <li><a href="../index.php">Back to Home page</a></li>
        <li><a href="../logout.php">Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <header>
        <h1>Welcome To The Event Lanka, <?php echo $username; ?>!</h1>
    </header>

    <section class="profile" id="U_Profile">
    <?php
// Assuming $userId is the logged-in user's ID
$query = "SELECT username, email, profilePicture FROM user WHERE userId = :userId";
$stmt = $db->prepare($query);
$stmt->bindParam(':userId', $userId);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);
$userAvatar = $user['profilePicture'] ?? '../Images Project/user_Icon.png'; // Default image if no profile picture is available
?>
    <h2>My Profile</h2>
    <form id="profileForm" method="POST" enctype="multipart/form-data" action="../bacend_logics_scripts/user_update_profile.php">
    <img src="../Images Project/user_Icon.png" alt="User Avatar" class="user-avatar" id="userAvatar">
        <label for="profilePicture">Profile Picture:</label>
        <input type="file" id="profilePicture" name="profilePicture" accept="image/*">
        <label for="username">Name:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
        <label for="userEmail">Email:</label>
        <input type="email" id="userEmail" name="userEmail" value="<?php echo htmlspecialchars($userEmail); ?>" required>
        <button type="submit" name="submit">Update Profile</button>
    </form>
</section>


   <!-- My Events Section -->
<section class="my-events" id="Events">
    <h2>My Events</h2>
    <table>
        <thead>
            <tr>
                <th>Event</th>
                <th>Date</th>
                <th>Service Provider</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Wedding Ceremony</td>
                <td>2024-11-05</td>
                <td>Moonlight Wedding Planners</td>
            </tr>
            <tr>
                <td>Corporate Gala</td>
                <td>2024-10-20</td>
                <td>City Lights Event Organizers</td>
            </tr>
            <tr>
                <td>Birthday Party</td>
                <td>2024-12-01</td>
                <td>FunTime Events</td>
            </tr>
        </tbody>
    </table>
</section>

<!-- My Services Section -->
<section class="my-services" id="U_Service">
    <h2>My Services</h2>
    <table>
        <thead>
            <tr>
                <th>Service</th>
                <th>Provider</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Catering Service</td>
                <td><a href="#">Royal Caterers</a></td>
                <td>Confirmed</td>
            </tr>
            <tr>
                <td>Photography</td>
                <td><a href="#">Pixel Perfect Studio</a></td>
                <td>Pending</td>
            </tr>
            <tr>
                <td>Music and DJ</td>
                <td><a href="#">Vibe Creators</a></td>
                <td>Completed</td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Notifications Section -->
<section class="notifications" id="U_Notifications">
    <h2>Notifications</h2>
    <ul>
        <li>Your wedding booking at Badulla Municipal Council Hall has been confirmed!</li>
        <li>The payment for your Corporate Gala event has been received.</li>
        <li>Your birthday party booking is awaiting approval.</li>
    </ul>
    <ul>
      
    </ul>
</section>

<!-- Payments Section -->
<section class="payments" id="U_Payments">
    <h2>Payments</h2>
    <table>
        <thead>
            <tr>
                <th>Event</th>
                <th>Advance Payment</th>
                <th>Balance Payment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Wedding Ceremony</td>
                <td>$1000</td>
                <td>$1500</td>
                <td>
                    <form method="POST" action="../payments/payment.php">
                        <input type="hidden" name="eventId" value="1">
                        <button type="submit" class="pay-balance">Pay Balance</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>Corporate Gala</td>
                <td>$500</td>
                <td>$1000</td>
                <td>
                    <form method="POST" action="../payments/payment.php">
                        <input type="hidden" name="eventId" value="2">
                        <button type="submit" class="pay-balance">Pay Balance</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>Birthday Party</td>
                <td>$200</td>
                <td>$800</td>
                <td>
                    <form method="POST" action="../payments/payment.php">
                        <input type="hidden" name="eventId" value="3">
                        <button type="submit" class="pay-balance">Pay Balance</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</section>



<script>
    function payBalance(eventId) {
        alert('Balance Payment for Event ID: ' + eventId + ' Completed');
    }
</script>
</body>
</html>
