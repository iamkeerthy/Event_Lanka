<?php
session_start();

include_once 'Classes/Database.php'; // Adjust the path as necessary
include_once 'Classes/Package.php'; // Adjust the path as necessary

// Create a database connection
$database = new Database();
$db = $database->getConnection();

// Fetch package details
$query = "SELECT packageName, packageDetails, packagePrice, packageImage FROM packages";
$stmt = $db->prepare($query);
$stmt->execute();

// Store fetched packages
$packages = $stmt->fetchAll(PDO::FETCH_ASSOC);


$isLoggedIn = isset($_SESSION['user_name']);
$userType = $isLoggedIn ? $_SESSION['user_type'] : null;
$userName = $isLoggedIn ? $_SESSION['user_name'] : null;

if (isset($_POST['paymentOption'])) {
    $selected_option = $_POST['paymentOption'];
    $_SESSION['payableOption'] = $_POST['paymentOption'];
    echo "You selected: " . $selected_option;
}
if (isset($_POST['payable_amount'])) {
    // Store the payable amount in the session
    $_SESSION['payableAmount'] = $_POST['payable_amount'];


    error_log('Payable amount received: ' . $_POST['payable_amount']);
}

if (isset($_POST['total_amount'])) {
    // Store the payable amount in the session
    $_SESSION['totalAmount'] = $_POST['total_amount'];
    error_log('total amount received: ' . $_POST['total_amount']);
    // Redirect to payment.php after setting the session
    header("Location: payments/payment.php");
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">

    </script>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventLanka</title>

    <link rel="stylesheet" href="styles/packages.css">

    <style type="text/css">

    </style>
</head>

<>
    <!-- header section starts -->
    <header class="header">
        <div class="logo">
            <img src="Images Project/logo.png" alt="EventLanka Logo">
            <a href="index.php">EventLanka</a>
        </div>
        <nav class="navbar">
            <a href="index.php">home</a>
            <a href="events.php">events</a>
            <a href="services.php">services</a>
            <a class='active' href="packages.php">packages</a>
            <a href="review.php">reviews</a>
            <a href="about_us.php">about us</a>
            <a href="contact_us.php">contact us</a>
        </nav>

        <div class="search-container">
            <input type="text" placeholder="Search...">
            <button><i class="bi bi-search"></i></button>
        </div>
        

        <div class="icons">
            <div class="user-avatar" id="userAvatar">
                <a href="<?php
                            if ($isLoggedIn) {
                                switch ($userType) {
                                    case 'admin':
                                        echo '../dash_boards/admin_page.php';
                                        break;
                                    case 'serviceProvider':
                                        echo '../dash_boards/serviceprovider.php';
                                        break;
                                    case 'registered':
                                        echo '../dash_boards/user_page.php';
                                        break;
                                    default:
                                        echo 'login/login_form.php';
                                }
                            } else {
                                echo 'login/login_form.php';
                            }
                            ?>">
                    <img src="Images Project/user_Icon.png" alt="User Avatar">
                </a>
            </div>

        </div>
        <div class="mobile">
            
            <i id="bar" class="fa-solid fa-bars"></i>
        </div>
          
    </header>

    <script>
        const menuIcon = document.querySelector('#bar');
        // const navbar = document.querySelector('.navbar');

        menuIcon.addEventListener('click', () => {
            navbar.classList.toggle('active');
        });
    </script>
    <!-- package start -->

    <section class="packages" id="packages">
        <h1 class="">Our Packages</h1>
        <!-- <div class="packages-container"> -->
        <div class="predefined-packages">

            <div class="events">
            <h2 class="heading">Wedding Packages</h2>
<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($packages as $package): ?>
        <div class="col"> <!-- Use a column for each package -->
            <div class="package" data-price="<?= htmlspecialchars($package['packagePrice']); ?>">
                <img src="<?= htmlspecialchars($package['packageImage']); ?>" alt="<?= htmlspecialchars($package['packageName']); ?>">
                <h3 class="title"><?= htmlspecialchars($package['packageName']); ?></h3>
                <h4 class="price">LKR <?= htmlspecialchars($package['packagePrice']); ?></h4>
                <ul>
                    <?php
                    $services = explode(',', $package['packageDetails']);
                    foreach ($services as $service): ?>
                        <li><i class="fas fa-check"></i> <?= htmlspecialchars(trim($service)); ?></li>
                    <?php endforeach; ?>
                    <li>
                        <label for="hall-select-<?= htmlspecialchars($package['packageName']); ?>">Select Hall:</label>
                        <select id="hall-select-<?= htmlspecialchars($package['packageName']); ?>">
                            <option value="hall1">Lee Meridiean</option>
                            <option value="hall2">Vanthu Banquets</option>
                        </select>
                    </li>
                </ul>
                <button class="btn" onclick="selectService(this)">Select</button>
            </div>
        </div> <!-- Closing the col div for each package -->
    <?php endforeach; ?>
</div>

            </div>
        </div>

        </div>

        <div class="events">
            <h2 class="heading">Event Packages</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <div class="col">
                    <div class="package" data-price="165000">
                        <img src="Images Project/dj-party.jpg" alt="DJ Party">
                        <h3 class="title">DJ Party</h3>
                        <h4 class="price">LKR 165,000</h4>
                        <ul>
                            <li><i class="fas fa-check"></i> DJ Services - maximum duration of 6 hours</li>
                            <li><i class="fas fa-check"></i> Lighting - LED Dance Floor & Disco Ball</li>
                            <li><i class="fas fa-check"></i> Sound System - Two high-quality sound systems for up to 150 guests</li>
                            <li><i class="fas fa-check"></i> Beverage Service: 2 beverage stations for refreshments</li>

                        </ul>
                        <button class="btn" onclick="selectService(this)">Select</button>
                    </div>
                </div>
                <div class="col">
                    <div class="package" data-price="100000">
                        <img src="Images Project/Birthday.jpg" alt="Birthday Party">
                        <h3 class="title">Birthday Party</h3>
                        <h4 class="price">LKR 100,000</h4>
                        <ul>
                            <li><i class="fas fa-check"></i> Decorations - one main theme and for a maximum of 15 tables setups.</li>
                            <li><i class="fas fa-check"></i> Cake - available in two flavors with berries</li>
                            <li><i class="fas fa-check"></i> Games and Activities - Musical Chairs , Photo Booth and Face painting</li>
                        </ul>
                        <button class="btn" onclick="selectService(this)">Select</button>
                    </div>
                </div>
                <div class="col">
                    <div class="package" data-price="350000">
                        <img src="Images Project/Sports.webp" alt="Sports Event">
                        <h3 class="title">Sports Event</h3>
                        <h4 class="price">LKR 75,000</h4>
                        <ul>
                            <li><i class="fas fa-check"></i> Decorations - 5 balloon bouquets & 3 large banners</li>
                            <li><i class="fas fa-check"></i> Equipment - 1 set of uniforms per team with 2 balls</li>
                            <li><i class="fas fa-check"></i> Referees: 1 referee per match</li>
                            <li><i class="fas fa-check"></i> Awards: one trophy & personalized certificates for all participants </li>

                        </ul>
                        <button class="btn" onclick="selectService(this)">Select</button>
                    </div>
                </div>
                <div class="col">
                    <div class="package" data-price="50000">
                        <img src="Images Project/socialevent.webp" alt="Personal Party">
                        <h3 class="title">Social Event</h3>
                        <h4 class="price">LKR 50,000</h4>
                        <ul>
                            <li><i class="fas fa-check"></i> Guest Capacity: Up to 100 guests</li>
                            <li><i class="fas fa-check"></i> Seating Arrangement: 10 tables with seating for 10 each</li>
                            <li><i class="fas fa-check"></i> Meal Service: Buffet-style featuring chicken, vegetarian dishes, and sides for up to 100 guests</li>

                        </ul>
                        <button class="btn" onclick="selectService(this)">Select</button>
                    </div>
                </div>

            </div>
        </div>
    </section>
    </div>

    <!-- Services packages -->
    <div class="packages-container">
        <div class="predefined-packages">
            <div class="events">
                <h2 class="heading">Services</h2>
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    
                    <div class="col">
                        <div class="package" data-price="80000">
                            <img src="Images Project/CateringBasic.jpg" alt="Catering Basic">
                            <h3 class="title">Catering Basic</h3>
                            <h4 class="price">LKR 80,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Basic Menu</li>
                                <li><i class="fas fa-check"></i> Drinks</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="120000">
                            <img src="Images Project/standardcatering.webp" alt="Catering Standard">
                            <h3 class="title">Catering Standard</h3>
                            <h4 class="price">LKR 120,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Standard Menu</li>
                                <li><i class="fas fa-check"></i> Drinks and Desserts</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="245000">
                            <img src="Images Project/cateringpremium.webp" alt="Catering Premium">
                            <h3 class="title">Catering Premium</h3>
                            <h4 class="price">LKR 245,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Premium Menu</li>
                                <li><i class="fas fa-check"></i> Drinks and Desserts</li>
                                <li><i class="fas fa-check"></i> Drink</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <!-- Add additional services in the same format -->
                    <div class="col">
                        <div class="package" data-price="50000">
                            <img src="Images Project/basichall.webp" alt="Wedding Hall Booking">
                            <h3 class="title">Basic Wedding Hall</h3>
                            <h4 class="price">LKR 50,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Venue</li>
                                <li><i class="fas fa-check"></i> Seating Arrangement</li>
                                <li><i class="fas fa-check"></i> Basic Decoration</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="70000">
                            <img src="Images Project/hallstandard.jpg" alt="Wedding Hall Booking">
                            <h3 class="title">Wedding Hall Standard</h3>
                            <h4 class="price">LKR 70,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Venue</li>
                                <li><i class="fas fa-check"></i> Seating Arrangement</li>
                                <li><i class="fas fa-check"></i> Standard Decoration</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>

                    <div class="col">
                        <div class="package" data-price="90000">
                            <img src="Images Project/premiumhall.png" alt="Wedding Hall Booking">
                            <h3 class="title">Wedding Hall Premium</h3>
                            <h4 class="price">LKR 90,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Venue</li>
                                <li><i class="fas fa-check"></i> Seating Arrangement</li>
                                <li><i class="fas fa-check"></i> Premium Decoration</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="40000">
                            <img src="Images Project/MAKEUP.jpg" alt="Basic Costume and Makeup">
                            <h3 class="title">Basic Costume and Makeup</h3>
                            <h4 class="price">LKR 40,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Basic Makeup</li>
                                <li><i class="fas fa-check"></i> Costume Rental</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="65000">
                            <img src="Images Project/StandardMakeup.jpeg" alt="Standard Costume and Makeup">
                            <h3 class="title">Standard Costume and Makeup</h3>
                            <h4 class="price">LKR 65,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Professional Makeup</li>
                                <li><i class="fas fa-check"></i> Designer Costume</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="90000">
                            <img src="Images Project/PremiumMakeup.jpeg" alt="Premium Costume and Makeup">
                            <h3 class="title">Premium Costume and Makeup</h3>
                            <h4 class="price">LKR 90,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Professional Makeup</li>
                                <li><i class="fas fa-check"></i> Designer Costume</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="50000">
                            <img src="Images Project/basicstage.jpeg" alt="Basic Stage Decoration">
                            <h3 class="title">Basic Stage Decoration</h3>
                            <h4 class="price">LKR 50,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Decorations</li>
                                <li><i class="fas fa-check"></i> Equipment</li>
                                <li><i class="fas fa-check"></i> Awards</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>

                    <div class="col">
                        <div class="package" data-price="75000">
                            <img src="Images Project/sstandard.jpeg" alt="Standard Stage Decoration">
                            <h3 class="title">Standard Stage Decoration</h3>
                            <h4 class="price">LKR 75,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Decorations</li>
                                <li><i class="fas fa-check"></i> Equipment</li>
                                <li><i class="fas fa-check"></i> Awards</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>

                    <div class="col">
                        <div class="package" data-price="95000">
                            <img src="Images Project/prestage.jpeg" alt="Premium Stage Decoration">
                            <h3 class="title">Premium Stage Decoration</h3>
                            <h4 class="price">LKR 95,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Decorations</li>
                                <li><i class="fas fa-check"></i> Equipment</li>
                                <li><i class="fas fa-check"></i> Lights</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="20000">
                            <img src="Images Project/Lightingbasic.jpg" alt="Decoration">
                            <h3 class="title">Decoration Lighting Basic</h3>
                            <h4 class="price">LKR 20,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Venue</li>
                                <li><i class="fas fa-check"></i> Basic Lights</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="30000">
                            <img src="Images Project/standardlighting.jpg" alt="Decoration">
                            <h3 class="title">Decoration Lighting Standard</h3>
                            <h4 class="price">LKR 30,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Venue</li>
                                <li><i class="fas fa-check"></i> Standard Lights</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="50000">
                            <img src="Images Project/premiumlighting.jpg" alt="Decoration">
                            <h3 class="title">Decoration Lighting Premium</h3>
                            <h4 class="price">LKR 50,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Venue</li>
                                <li><i class="fas fa-check"></i> Premium Lights</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>

                    <div class="col">
                        <div class="package" data-price="150000">
                            <img src="Images Project/Photography.jpg" alt="Photography Basic">
                            <h3 class="title">Photography Basic</h3>
                            <h4 class="price">LKR 150,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Photography</li>
                                <li><i class="fas fa-check"></i> Digital Images</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="200000">
                            <img src="Images Project/standardPhotography.png" alt="Photography Standard">
                            <h3 class="title">Photography Standard</h3>
                            <h4 class="price">LKR 200,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Photography</li>
                                <li><i class="fas fa-check"></i> Quality Album</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="225000">
                            <img src="Images Project/photographypremium.webp" alt="Photography Premium">
                            <h3 class="title">Photography Premium</h3>
                            <h4 class="price">LKR 225,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Photography</li>
                                <li><i class="fas fa-check"></i> Highsheet Album</li>
                                <li><i class="fas fa-check"></i> Two Location Outdoor </li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="120000">
                            <img src="Images Project/videographybasic.jfif" alt="Videography Basic">
                            <h3 class="title">Videography Basic</h3>
                            <h4 class="price">LKR 120,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Videography</li>
                                <li><i class="fas fa-check"></i> Edited Video</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="160000">
                            <img src="Images Project/standardvideography.jpg" alt="Videography Standard">
                            <h3 class="title">Videography Standard</h3>
                            <h4 class="price">LKR 160,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Videography</li>
                                <li><i class="fas fa-check"></i> HD Quality Video Album</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="200000">
                            <img src="Images Project/videography.jpg" alt="Videography Premium">
                            <h3 class="title">Videography Premium</h3>
                            <h4 class="price">LKR 200,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Videography</li>
                                <li><i class="fas fa-check"></i> Drone Shoot</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="10000">
                            <img src="Images Project/cars.jpg" alt="Basic Vehicle Hire">
                            <h3 class="title">Basic Vehicle Hire</h3>
                            <h4 class="price">LKR 10,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Car Hire</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="18000">
                            <img src="Images Project/standrad.jpg" alt="Standard Vehicle Hire">
                            <h3 class="title">Standard Vehicle Hire</h3>
                            <h4 class="price">LKR 18,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Car Hire</li>
                                <li><i class="fas fa-check"></i> Days(03)</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package" data-price="25000">
                            <img src="Images Project/premimum.jpg" alt="Premium Vehicle Hire">
                            <h3 class="title">Premium Vehicle Hire</h3>
                            <h4 class="price">LKR 25,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Car and Van Hire</li>
                                <li><i class="fas fa-check"></i> A Week</li>
                            </ul>
                            <button class="btn" onclick="selectService(this)">Select</button>
                        </div>
                    </div>
                 
                    <?php
                    // Fetch service details
                    $sql = "SELECT serviceName, Price, serviceImage, serviceDescription FROM services where status='approved'";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
        <div class="row row-cols-1 row-cols-md-4 g-4"></div>
        
                <?php if (!empty($services)): ?>
                    <?php foreach ($services as $service): ?>
                        <div class="col">
                            <div class="package" data-price="<?= htmlspecialchars($service['Price']); ?>">
                            <img src="<?= htmlspecialchars($service['serviceImage']); ?>" alt="<?= htmlspecialchars($service['serviceName']); ?>" 
                            style="width: 100%; height: 200px; object-fit: cover;">
                                <h3 class="title"><?= htmlspecialchars($service['serviceName']); ?></h3>
                                <h4 class="price">LKR <?= htmlspecialchars($service['Price']); ?></h4>
                                <ul>
                                    <li><i class="fas fa-check"></i> <?= htmlspecialchars($service['serviceDescription']); ?></li>
                                </ul>
                                <button class="btn" onclick="selectService(this)">Select</button>
                            </div>
                        </div> <!-- End column for each service -->
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col">
                        <p>No services found.</p>
                    </div>
                <?php endif; ?>
            </div> <!-- End row -->
        </div> <!-- End events -->
    </div> <!-- End predefined-packages -->
</div> <!-- End packages-container -->
                    
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
  </section>
  <section>
    <!-- Bill Summary -->
    <div class="bill-summary">
        <h3>Bill Summary</h3>
        <div class="bill-details" id="bill-details">
            <p id="selected-services">No services selected</p>


            <!-- Date Picker -->
            <label for="bookingDate">Select Booking Date:</label>
            <input type="date" id="bookingDate" onchange="validateBookingDate()">
            <p id="dateError" style="color: red; display: none;">Please select a valid date after the live date.</p>
            <!-- Confirm button will be enabled only after selecting a valid date -->
            <p>Total: <span id="total-amount">LKR 0</span></p>
        </div>
        <button class="btn" id="pay-button" type="button" onclick="handlePayNow()">Pay Now</button>
    </div>

    <!-- Confirmation Modal -->
    <div id="paymentConfirmationModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('paymentConfirmationModal').style.display='none'">&times;</span>
            <h3>Confirm Payment</h3>
            <div id="confirmationDetails"></div> <!-- Placeholder for package details -->
            <p>Selected Date: <span id="modalSelectedDate"></span></p> <!-- Display selected date here -->
            <p>Total: LKR <span id="modalTotalPrice"></span></p>
            <button class="btn" onclick="showPaymentOptions()">Confirm</button>
            <button class="btn" onclick="document.getElementById('paymentConfirmationModal').style.display='none'">Cancel</button>
        </div>
    </div>

    <!-- Modal for Payment Selection -->
    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('paymentModal').style.display='none'">&times;</span>
            <h3>Select Payment Option</h3>
            <p>Total Price: LKR <span id="totalPrice"></span></p>
            <form id="paymentForm" action="packages.php" method="POST">
                <input type="hidden" id="payableAmountInput" name="payable_amount">
                <input type="hidden" id="totalAmountInput" name="total_amount">
                <input type="hidden" id="eventDateInput" name="event_date">
                <label>
                    <input type="radio" name="paymentOption" value="full" required>
                    Full Payment
                </label>
                <label>
                    <input type="radio" name="paymentOption" value="advance" required>
                    Advance Payment (40%)
                </label>
                <button type="button" id="payNowButton" class="btn" onclick="confirmPayment()">Pay Now</button>
            </form>
        </div>
    </div>
    </section>

    <script>
        const liveDate = new Date();
        let selectedServices = [];
        let totalAmount = 0;

        document.getElementById('bookingDate').setAttribute('min', new Date().toISOString().split('T')[0]);

        function selectService(button) {
            const packageDiv = button.parentElement;
            const serviceName = packageDiv.querySelector('.title').textContent;
            const servicePrice = parseFloat(packageDiv.getAttribute('data-price'));

            const existingServiceIndex = selectedServices.findIndex(service => service.name === serviceName);

            if (existingServiceIndex > -1) {
                // Deselect service
                selectedServices.splice(existingServiceIndex, 1);
                totalAmount -= servicePrice;
                button.classList.remove('selected');
            } else {
                // Select service
                selectedServices.push({
                    name: serviceName,
                    price: servicePrice
                });
                totalAmount += servicePrice;
                button.classList.add('selected');
            }

            // Update bill summary
            updateBillSummary();
        }

        function updateBillSummary() {
            const servicesDisplay = selectedServices.length > 0 ?
                selectedServices.map(service => `${service.name}: LKR ${service.price.toLocaleString()}`).join('<br>') :
                'No services selected';

            // Update the selected services display
            document.getElementById('selected-services').innerHTML = servicesDisplay;

            // Update total amount
            document.getElementById('total-amount').innerText = `LKR ${totalAmount.toLocaleString()}`;

            const payButton = document.getElementById('pay-button');
            payButton.disabled = totalAmount <= 0;
        }

        // Function to show the payment confirmation modal
        function handlePayNow() {
            const bookingDate = document.getElementById('bookingDate').value;

            if (totalAmount > 0 && bookingDate) { // Check if total amount is greater than zero and date is selected
                document.getElementById('modalTotalPrice').innerText = totalAmount.toLocaleString();
                document.getElementById('modalSelectedDate').innerText = bookingDate; // Display the selected date in the modal
                document.getElementById('paymentConfirmationModal').style.display = "block"; // Show modal
            } else if (!bookingDate) {
                alert("Please select a valid booking date.");
            } else {
                alert("No Services Selected");
            }
        }

        function validateBookingDate() {
            const selectedDate = new Date(document.getElementById('bookingDate').value);
            const currentDate = new Date(); // Get current system date
            const dateError = document.getElementById('dateError');

            // Check if selected date is after both live date (today) and current date
            if (selectedDate >= liveDate && selectedDate >= currentDate) {
                payButton.disabled = false; // Enable "Pay Now" button if date is valid
                dateError.style.display = 'none'; // Hide error message
            } else {
                payButton.disabled = true; // Disable "Pay Now" button if date is invalid
                dateError.style.display = 'block'; // Show error message
            }
        }
        // Function to show the payment options modal after confirmation
        function showPaymentOptions() {
            document.getElementById('paymentConfirmationModal').style.display = "none"; // Hide confirmation modal
            document.getElementById('totalPrice').innerText = totalAmount.toLocaleString(); // Set total in payment modal
            document.getElementById('paymentModal').style.display = "block"; // Show payment options modal
        }

        // Function to update the "Pay Now" button in the payment options modal
        function updatePayNowButton() {
            const selectedOption = document.querySelector('input[name="paymentOption"]:checked').value;
            const payableAmount = selectedOption === 'full' ? totalAmount : (totalAmount * 0.40).toFixed(2);
            localStorage.setItem("paymentType", selectedOption)


            // Update the "Pay Now" button to reflect the selected payment option
            document.getElementById('payNowButton').disabled = !document.querySelector('input[name="paymentOption"]:checked');
            payNowButton.innerText = `Pay Now (LKR ${payableAmount})`;

            // Set the value for hidden input field
            document.getElementById('payableAmountInput').value = payableAmount;
            document.getElementById('totalAmountInput').value = totalAmount;
            document.getElementById('eventDateInput').value = bookingDate;
        }


        // Function to confirm payment and redirect to payment.php
        // Function to confirm payment and redirect to payment.php
        // Function to confirm payment and redirect to payment.php
        function confirmPayment() {
            const selectedOption = document.querySelector('input[name="paymentOption"]:checked').value;
            const payableAmount = selectedOption === 'full' ? totalAmount : (totalAmount * 0.40).toFixed(2);

            // Set the payable amount in the hidden input field
            document.getElementById('payableAmountInput').value = payableAmount;
            document.getElementById('totalAmountInput').value = totalAmount;
            document.getElementById('eventDateInput').value = bookingDate;
            // Submit the form to payment.php
            document.getElementById('paymentForm').submit();
        }


        // Event listener for Pay Now button
        document.getElementById('pay-button').addEventListener('click', handlePayNow);
    </script>
    <!-- Service Providers Section -->
    <section class="service-providers">
        <center>
        <h2 style="display: inline-block;
            background-color: #00274d;
            border-radius: 20px;
            padding: 10px 20px;
            margin: 20px auto;
            color:#b35900;" >Service Providers</h2>
            </center>
            <br>
            <br>
        <div class="provider-list">
            <div class="provider-item">
                <img src="Images Project/JohnsPhotography.jfif" alt="John's Photography">
                <div class="provider-info">
                    <h4>John's Photography</h4>
                </div>
            </div>
            <div class="provider-item">
                <img src="Images Project/EliteCaterers.jfif" alt="Elite Caterers">
                <div class="provider-info">
                    <h4>Elite Eat & Caterers </h4>
                </div>
            </div>
            <div class="provider-item">
                <img src="Images Project/GlamourMakeup.jfif" alt="Jebi Bridal">
                <div class="provider-info">
                    <h4>Jebi Bridal Saloon</h4>
                </div>
            </div>
            <div class="provider-item">
                <img src="Images Project/DeluxeVideography.webp" alt="Deluxe Videography">
                <div class="provider-info">
                    <h4>Deluxe Videography</h4>
                </div>
            </div>
            <div class="provider-item">
                <img src="Images Project/PartyCars.jpeg" alt="Party Cars">
                <div class="provider-info">
                    <h4>SunRise Car Rental</h4>
                </div>
            </div>
        </div>
    </section>

    <br>

    <!-- end -->
    <!-- footer section starts  -->
    <section class="footer" id="about">
        <div class="box-container">
            <div class="box">
                <h3>quick links</h3>
                <a href="index.php"> <i class="fas fa-chevron-right"></i> home </a>
                <a href="events.php"> <i class="fas fa-chevron-right"></i> events </a>
                <a href="services.php"> <i class="fas fa-chevron-right"></i> services </a>
                <a href="packages.php"> <i class="fas fa-chevron-right"></i> packages </a>
                <a href="about_us.php"> <i class="fas fa-chevron-right"></i> about </a>
                <a href="contact_us.php"> <i class="fas fa-chevron-right"></i> contact </a>
            </div>

            <div class="box">
                <h3>extra links</h3>
                <a href="#"> <i class="fas fa-chevron-right"></i> plan wedding </a>
                <a href="services.php"> <i class="fas fa-chevron-right"></i> our services </a>
                <a href="livechat.php"> <i class="fas fa-chevron-right"></i> ask questions </a>
                <a href="terms.php"> <i class="fas fa-chevron-right"></i> terms & Condition</a>
                <a href="terms.php"> <i class="fas fa-chevron-right"></i> privacy policy </a>
            </div>

            <div class="box">
                <h3>contact info</h3>
                <p> <i class="fas fa-phone"></i> +123-456-7890 </p>
                <p> <i class="fas fa-phone"></i> +111-222-3333 </p>
                <p> <i class="fas fa-envelope"></i> eventlanka15@gmail.com </p>
                <p> <i class="fas fa-map"></i> Badulla, sri lanka - 90000 </p>
            </div>

            <div class="box">
                <h3>follow us</h3>
                <a href="https://web.facebook.com/"> <i class="fab fa-facebook-f"></i> facebook </a>
                <a href="https://x.com/"> <i class="fab fa-twitter"></i> twitter </a>
                <a href="https://www.instagram.com/"> <i class="fab fa-instagram"></i> instagram </a>
                <a href="https://www.linkedin.com/"> <i class="fab fa-linkedin"></i> linkedin </a>
            </div>


        </div>

        <div class="credit"> created by <span>EventLanka team</span> | all rights reserved </div>

    </section>
    <!-- footer section ends -->

    <script>
        let navbar = document.querySelector('.header .navbar');
        let menuBtn = document.querySelector('#menu');
        let userAvatar = document.querySelector('#userAvatar');
        let overlay = document.querySelector('#overlay');
        let loginForm = document.querySelector('#loginForm');
        let registerForm = document.querySelector('#registerForm');
        let forgotPasswordForm = document.querySelector('#forgotPasswordForm');
        let showRegister = document.querySelector('#showRegister');
        let showLogin = document.querySelector('#showLogin');
        let showForgotPassword = document.querySelector('#showForgotPassword');
        let showLoginFromForgot = document.querySelector('#showLoginFromForgot');
        let showTerms = document.querySelector('#showTerms');

        menuBtn.onclick = () => {
            menuBtn.classList.toggle('fa-times');
            navbar.classList.toggle('active');
        };

        userAvatar.onclick = () => {
            overlay.classList.toggle('active');
            loginForm.classList.toggle('active');
        };

        overlay.onclick = () => {
            overlay.classList.remove('active');
            loginForm.classList.remove('active');
            registerForm.classList.remove('active');
            forgotPasswordForm.classList.remove('active');
        };

        showRegister.onclick = (e) => {
            e.preventDefault();
            loginForm.classList.remove('active');
            registerForm.classList.add('active');
            registerForm.style.maxWidth = "800px";
        };

        showLogin.onclick = (e) => {
            e.preventDefault();
            registerForm.classList.remove('active');
            forgotPasswordForm.classList.remove('active');
            loginForm.classList.add('active');
            registerForm.style.maxWidth = "500px";
        };

        showForgotPassword.onclick = (e) => {
            e.preventDefault();
            loginForm.classList.remove('active');
            forgotPasswordForm.classList.add('active');
        };

        showLoginFromForgot.onclick = (e) => {
            e.preventDefault();
            forgotPasswordForm.classList.remove('active');
            loginForm.classList.add('active');
        };

        showTerms.onclick = (e) => {
            e.preventDefault();
            new bootstrap.Modal(document.getElementById('termsModal')).show();
        };

        window.onscroll = () => {
            menuBtn.classList.remove('fa-times');
            navbar.classList.remove('active');
        };
    </script>
     
</body>

</html>