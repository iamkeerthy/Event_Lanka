<?php
session_start();
require_once '../Classes/Database.php';
require_once '../Classes/User.php';

$database = new Database();
$db = $database->getConnection();

$userId = $_SESSION['user_id'];

// Fetch user data
$user = new User($db);
$userData = $user->fetchUserData($userId); // Assuming fetchUserData method exists in User class

if (!$userData) {
    $_SESSION['error'] = "User data not found.";
    header('Location: ../login/login_form.php');
    exit();
}

// Display user data
$username = htmlspecialchars($userData['username'] ?? ''); // Default to empty string if not set
$userEmail = htmlspecialchars($userData['email'] ?? ''); // Default to empty string if not set
$profilePicture = htmlspecialchars($userData['profile_picture'] ?? 'default_avatar.png'); // Fallback to default image if not set
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Provider Dashboard</title>
    <link rel="stylesheet" href="../css/provider.css">
    <style>
     .message {
    margin-bottom: 20px;
    padding: 10px;
    border-radius: 5px;
    font-size: 16px;
    text-align: center;
}

.success {
    background-color: #d4edda;
    color: #155724;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
}

    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Service Provider Dashboard</h2>
        <ul>
            <li><a href="#S_Dashboard">Dashboard</a></li>
            <li><a href="#S_Profile">Profile</a></li>
            <li><a href="#S_Services">My Services</a></li>
            <li><a href="#S_Notifications">Notifications</a></li>
            <li><a href="#S_Payments">Payments</a></li>
            <li><a href="../index.php">Back to Home page</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <header>
        <h1>Welcome To The Event Lanka, <?php echo htmlspecialchars($username); ?>!</h1>
        </header>
        <section class="profile" id="S_Profile">
            <h2>My Profile</h2>
            <form id="profileForm" method="POST" enctype="multipart/form-data" action="../bacend_logics_scripts/service_update_profile copy.php">
                <img src="../img/user.png" alt="User Avatar" class="user-avatar" id="userAvatar">
                <label for="username">Name:</label>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>

                <label for="userEmail">Email:</label>
                <input type="email" id="userEmail" name="userEmail" value="<?php echo $userEmail; ?>" required>

                <label for="profilePicture">Profile Picture:</label>
                <input type="file" id="profilePicture" name="profilePicture">

                <button type="submit">Update Profile</button>
            </form>
        </section>
        
        <?php
                require_once '../Classes/Database.php'; // Adjust the path as necessary

                $database = new Database();
                $db = $database->getConnection();

                // Initialize variables
                $totalServices = 0;
                $totalBookings = 0;
                $totalIncome = 0;

                // Get total services
                $queryServices = "SELECT COUNT(*) as total FROM serviceprovider WHERE userId = :userId"; // Adjust the table if needed
                $stmtServices = $db->prepare($queryServices);
                $stmtServices->bindParam(':userId', $_SESSION['user_id']); // Assuming you have user_id in session
                $stmtServices->execute();
                $totalServices = $stmtServices->fetchColumn();

                // Get total bookings
                $queryBookings = "SELECT COUNT(*) as total FROM usereventbooking WHERE userId = :userId"; // Adjust the table if needed
                $stmtBookings = $db->prepare($queryBookings);
                $stmtBookings->bindParam(':userId', $_SESSION['user_id']); // Assuming you have user_id in session
                $stmtBookings->execute();
                $totalBookings = $stmtBookings->fetchColumn();

                // Get total income
                $queryIncome = "SELECT SUM(amount) as total FROM payment WHERE userId = :userId"; // Adjust the table if needed
                $stmtIncome = $db->prepare($queryIncome);
                $stmtIncome->bindParam(':userId', $_SESSION['user_id']); // Assuming you have user_id in session
                $stmtIncome->execute();
                $totalIncome = $stmtIncome->fetchColumn();
                ?>


        <section class="dashboard-overview" id="S_Dashboard">
    <h2>Dashboard Overview</h2>
    <div class="card">
        <h3>Total Services</h3>
        <p><?php echo htmlspecialchars($totalServices); ?></p>
    </div>
    <div class="card">
        <h3>Total Bookings</h3>
        <p><?php echo htmlspecialchars($totalBookings); ?></p>
    </div>
    <div class="card">
        <h3>Total Income</h3>
        <p>$<?php echo htmlspecialchars($totalIncome); ?></p>
    </div>
</section>

<?php


// Check if there's an upload message in the session
if (isset($_SESSION['uploadMessage']) && !empty($_SESSION['uploadMessage'])) {
    echo "<div class='upload-message'>" . htmlspecialchars($_SESSION['uploadMessage']) . "</div>";
    // Clear the message after displaying it
    unset($_SESSION['uploadMessage']);
}
?>


<section class="my-services" id="S_Services">
    <h2>My Services</h2>

    <!-- Service Update Form -->
    <form id="serviceForm" action="../bacend_logics_scripts/upload_service.php" method="post" enctype="multipart/form-data">
        <input type="hidden" id="service_id" name="service_id" value=""> <!-- Hidden field for service ID -->

        <!-- Service Name -->
        <div class="form-group">
            <label for="serviceName">Service Name</label>
            <input type="text" id="serviceName" name="serviceName" class="form-control" placeholder="Enter Service Name" required>
        </div>

        <!-- Service Description -->
        <div class="form-group">
            <label for="serviceDescription">Service Description</label>
            <textarea id="serviceDescription" name="serviceDescription" class="form-control" placeholder="Enter Service Description" required></textarea>
        </div>

        <!-- Service Price -->
        <div class="form-group">
            <label for="servicePrice">Service Price</label>
            <input type="number" step="0.01" id="servicePrice" name="servicePrice" class="form-control" placeholder="Enter Service Price" required>
        </div>

        <!-- Service Image -->
        <div class="form-group">
            <label for="serviceImage">Service Image</label>
            <input type="file" id="serviceImage" name="serviceImage" class="form-control"> <!-- Optional -->
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Service</button>
    </form>

    <!-- Service List Table -->



    <?php
// Display success message
if (!empty($_SESSION['message'])) {
    echo "<div class='success-message'>" . htmlspecialchars($_SESSION['message']) . "</div>";
    unset($_SESSION['message']); // Clear the message after displaying it
}

// Display error message
if (!empty($_SESSION['error'])) {
    echo "<div class='error-message'>" . htmlspecialchars($_SESSION['error']) . "</div>";
    unset($_SESSION['error']); // Clear the error message after displaying it
}
?>

<section>
    <h3>Existing Services</h3>
    <table>
        <thead>
            <tr>
                <th>Service</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include the Service class (ensure correct path)
            require_once '../Classes/Service.php'; 

            // Instantiate the Service class and pass the database connection
            $service = new Service($db);

            // Fetch services uploaded by the logged-in user (assuming session contains userId)
            $userId = $_SESSION['user_id'];

            $services = $service->fetchServicesByUserId($userId);

            // Check if any services were found
            if (empty($services)) {
                echo '<tr><td colspan="4">No services found.</td></tr>';
            } else {
                // Loop through each service and display it in a table row
                foreach ($services as $serviceItem) {
                    echo '<tr>';
                    // Display service name
                    echo '<td>' . htmlspecialchars($serviceItem['serviceName']) . '</td>';
                    
                    // Display service description
                    echo '<td>' . htmlspecialchars($serviceItem['serviceDescription']) . '</td>';
                    
                    // Display service image
                    $imagePath = !empty($serviceItem['serviceImage']) ? htmlspecialchars($serviceItem['serviceImage']) : '../Images Project/default.jpeg';
                    echo '<td><img src="' . $imagePath . '" alt="Service Image" class="service-image" style="width: 100px;"></td>';
                    
                    // Actions: Modify and Delete buttons
                    echo '<td>
                            
                            <form action="../bacend_logics_scripts/delete_service.php" method="POST" style="display: inline;">
                                <input type="hidden" name="service_id" value="' . htmlspecialchars($serviceItem['serviceId']) . '">
                                <button type="submit" class="delete" onclick="return confirm(\'Are you sure you want to delete this service?\');">Delete</button>
                            </form>
                          </td>';
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>
</section>


<script>
    // Confirm delete function to avoid accidental deletions
    function confirmDelete(serviceId) {
        if (confirm('Are you sure you want to delete this service?')) {
            window.location.href = '../backend_logics_scripts/delete_service.php?service_id=' + serviceId;
        }
    }
</script>

<script>
function confirmDelete(serviceId) {
    if (confirm("Are you sure you want to delete this service?")) {
        // Create a form dynamically and submit the request
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '../backend_logics_scripts/delete_service.php'; // Backend script to handle deletion

        // Add a hidden input field with the serviceId
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'service_id';
        input.value = serviceId;
        form.appendChild(input);

        // Append the form to the body and submit it
        document.body.appendChild(form);
        form.submit();
    }
}
</script>


</section>




<script>
function confirmDelete(serviceId) {
    const confirmed = confirm("Are you sure you want to request deletion of this service?");
    if (confirmed) {
        $.post('../bacend_logics_scripts/service_action.php', {
            service_id: serviceId,
            action: 'delete_request' // Mark as delete request, not immediate delete
        }, function(response) {
            alert('Delete request submitted. Waiting for admin approval.');
        });
    }
}


</script>


<section class="notifications" id="S_Notifications">
    <h2>Notifications</h2>
    <ul>
        <?php
        // Sample notifications for demonstration
        $sampleNotifications = [
            [
                'message' => 'Your service request has been approved.',
                'createdAt' => '2024-10-15 10:30:00',
            ],
            [
                'message' => 'You have a new booking for Event X.',
                'createdAt' => '2024-10-14 14:45:00',
            ],
            [
                'message' => 'Payment of $300 has been received.',
                'createdAt' => '2024-10-13 09:00:00',
            ],
            [
                'message' => 'Your service was reviewed by a user.',
                'createdAt' => '2024-10-12 16:20:00',
            ],
            [
                'message' => 'Admin has rejected your service update request.',
                'createdAt' => '2024-10-11 11:15:00',
            ],
        ];

        // Check if notifications are set, if not, use sample notifications
        if (empty($notifications)) {
            foreach ($sampleNotifications as $notification) {
                echo '<li>' . htmlspecialchars($notification['message']) . ' on ' . htmlspecialchars($notification['createdAt']) . '</li>';
            }
        } else {
            // Display actual notifications from the database
            while ($notification = $stmtNotifications->fetch(PDO::FETCH_ASSOC)) {
                echo '<li>' . htmlspecialchars($notification['message']) . ' on ' . htmlspecialchars($notification['createdAt']) . '</li>';
            }
        }
        ?>
    </ul>
    <script>
        // Close notification function
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('close-notification')) {
                e.target.parentElement.style.display = 'none';
            }
        });
    </script>
</section>





<section class="payments" id="S_Payments">
    <h2>Payments</h2>
    <table>
        <thead>
            <tr>
                <th>Order Count</th>
                <th>Completed Orders</th>
                <th>Pending Orders</th>
                <th>Amount Paid</th>
                <th>Pending Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>20</td>
                <td>15</td>
                <td>5</td>
                <td>3000</td>
                <td>2000</td>
            </tr>
            <tr>
                <td>10</td>
                <td>8</td>
                <td>2</td>
                <td>1500</td>
                <td>500</td>
            </tr>
            <tr>
                <td>5</td>
                <td>5</td>
                <td>0</td>
                <td>1200</td>
                <td>0</td>
            </tr>
        </tbody>
    </table>
</section>


     

    <script>
        // Chart.js for reports
        var ctx1 = document.getElementById('incomeChart').getContext('2d');
        var incomeChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Income',
                    data: [1200, 1900, 3000, 500, 2000, 3000, 4500],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx2 = document.getElementById('serviceChart').getContext('2d');
        var serviceChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Wedding Catering', 'DJ Services', 'Event Planning', 'Decoration Services'],
                datasets: [{
                    label: 'Services',
                    data: [10, 15, 5, 7],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });
    </script>
</body>
</html>
