<!DOCTYPE html>
<html lang="en">
<head>
  
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" >

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
    <body>
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
                <a class='active'  href="packages.php">packages</a>
                <a  href="review.php">reviews</a>
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
                    if (isset($_SESSION['user_name'])) {
                        switch ($_SESSION['user_type']) {
                            case 'admin':
                                echo 'login/admin_page.php';
                                break;
                            case 'serviceProvider':
                                echo 'login/serviceprovider.php';
                                break;
                            case 'user':
                                echo 'login/user_page.php';
                                break;
                            default:
                                echo 'login/login_form.php';
                                break;
                        }
                    } else {
                        echo 'login/login_form.php';
                    }
                ?>">
                    <img src="<?php echo isset($_SESSION['user_avatar']) ? $_SESSION['user_avatar'] : 'Images Project/user_Icon.png'; ?>" alt="User Avatar">
                </a>
            </div>
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
        <h1 class="heading">Our Packages</h1>
        <!-- <div class="packages-container"> -->
            <div class="predefined-packages">
             <div class="events">
             <h2>Events</h2>
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <div class="col">
                        <div class="package">
                            <img src="Images Project/Christian Wedding.webp" alt="Christian Wedding">
                            <h3 class="title">Christian Wedding</h3>
                            <h4 class="price">LKR 300,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Catering</li>
                                <li><i class="fas fa-check"></i> Photography</li>
                                <li><i class="fas fa-check"></i> Full Assistance</li>
                                <li>
                                    <label for="hall-select">Select Hall:</label>
                                    <select id="hall-select">
                                        <option value="hall1">Lee Meridiean</option>
                                        <option value="hall2">Vanthu Banquets</option>
                                    </select>
                                </li>
                            </ul>
                            <a href="#" class="btn">Select</a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package">
                            <img src="Images Project/HinduWeds.jpeg" alt="Hindu Wedding">
                            <h3 class="title">Hindu Wedding</h3>
                            <h4 class="price">LKR 350,000</h4>
                            <ul>
                            <li><i class="fas fa-check"></i> Catering</li>
                                <li><i class="fas fa-check"></i> Photography</li>
                                <li><i class="fas fa-check"></i> Photography</li>
                                <li><i class="fas fa-check"></i> Full Assistance</li>
                                <li>
                                    <label for="hall-select">Select Hall:</label>
                                    <select id="hall-select">
                                    <option value="hall1">Lee Meridiean</option>
                                    <option value="hall2">Vanthu Banquets</option>
                                    </select>
                                </li>
                            </ul>
                            <a href="#" class="btn">Select</a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package">
                            <img src="Images Project/Muslim Wedding.jpeg" alt="Muslim Wedding">
                            <h3 class="title">Muslim Wedding</h3>
                            <h4 class="price">LKR 320,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Photography</li>
                                <li><i class="fas fa-check"></i> Consultation</li>
                                <li><i class="fas fa-check"></i> Full Assistance</li>
                                <li>
                                    <label for="hall-select">Select Hall:</label>
                                    <select id="hall-select">
                                    <option value="hall1">Lee Meridiean</option>
                                    <option value="hall2">Vanthu Banquets</option>
                                    </select>
                                </li>
                            </ul>
                            <a href="#" class="btn">Select</a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package">
                            <img src="Images Project/sinhala Weds.jpeg" alt="Buddhist Wedding">
                            <h3 class="title">Buddhist Wedding</h3>
                            <h4 class="price">LKR 325,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Photography</li>
                                <li><i class="fas fa-check"></i> Consultation</li>
                                <li><i class="fas fa-check"></i> Full Assistance</li>
                                <li>
                                    <label for="hall-select">Select Hall:</label>
                                    <select id="hall-select">    
                                    <option value="hall1">Lee Meridiean</option>
                                    <option value="hall2">Vanthu Banquets</option>
                                    </select>
                                </li>
                            </ul>
                            <a href="#" class="btn">Select</a>
                        </div>
                    </div>
             </div>
              
                    </div>

                    <div class="events">
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                    <div class="col">
                        <div class="package">
                            <img src="Images Project/dj-party.jpg" alt="DJ Party">
                            <h3 class="title">DJ Party</h3>
                            <h4 class="price">LKR 165,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> DJ Services</li>
                                <li><i class="fas fa-check"></i> Lighting</li>
                                <li><i class="fas fa-check"></i> Sound System</li>
                            </ul>
                            <a href="#" class="btn">Select</a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package">
                            <img src="Images Project/Birthday.jpg" alt="Birthday Party">
                            <h3 class="title">Birthday Party</h3>
                            <h4 class="price">LKR 100,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Decorations</li>
                                <li><i class="fas fa-check"></i> Cake</li>
                                <li><i class="fas fa-check"></i> Games and Activities</li>
                            </ul>
                            <a href="#" class="btn">Select</a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="package">
                            <img src="Images Project/Sports.webp" alt="Sports Event">
                            <h3 class="title">Sports Event</h3>
                            <h4 class="price">LKR 75,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Decorations</li>
                                <li><i class="fas fa-check"></i> Equipment</li>
                                <li><i class="fas fa-check"></i> Awards</li>
                            </ul>
                            <a href="#" class="btn">Select</a>
                        </div>
                    </div>
                     <div class="col">
                        <div class="package">
                            <img src="Images Project/socialevent.webp" alt="Personal Party">
                            <h3 class="title">Social Event</h3>
                            <h4 class="price">LKR 50,000</h4>
                            <ul>
                                <li><i class="fas fa-check"></i> Hall Arrangement</li>
                            </ul>
                            <a href="#" class="btn">Select</a>
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
            <h2 class="mt-5 text-center">Services</h2>
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
                                <li><i class="fas fa-check"></i>  Standard Decoration</li>
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
                      <div class="col" >
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
                     <div class="col" >
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
                </div>
            </div>
                
    </div>
</div>
    </div>
</div>
<div class="bill-summary">
    <h3>Bill Summary</h3>
    <div class="bill-details" id="bill-details">
        <p id="selected-services">No services selected</p>
        <p>Total: <span id="total-amount">LKR 0</span></p>
    </div>
    <button class="btn" id="pay-button" type="button">Pay Now</button>
</div>

<script>
    let selectedServices = [];
    let totalAmount = 0;

    function selectService(button) {
        const packageDiv = button.parentElement; // Get the parent package div
        const serviceName = packageDiv.querySelector('.title').textContent; // Get service name
        const servicePrice = parseFloat(packageDiv.getAttribute('data-price')); // Get service price

        // Toggle selection
        if (selectedServices.includes(serviceName)) {
            // Deselect service
            selectedServices = selectedServices.filter(service => service !== serviceName);
            totalAmount -= servicePrice; // Subtract price
            button.classList.remove('selected'); // Remove selected styling
        } else {
            // Select service
            selectedServices.push(serviceName);
            totalAmount += servicePrice; // Add price
            button.classList.add('selected'); // Add selected styling
        }

        // Update bill summary
        updateBillSummary();
    }

    function updateBillSummary() {
        // Update the selected services display
        const servicesDisplay = selectedServices.length > 0 ? selectedServices.join('<br>') : 'No services selected';
        document.getElementById('selected-services').innerHTML = servicesDisplay;

        // Update total amount
        document.getElementById('total-amount').innerText = `LKR ${totalAmount.toLocaleString()}`;

        // Enable or disable the Pay Now button
        const payButton = document.getElementById('pay-button');
        payButton.disabled = totalAmount <= 0; // Disable if total amount is zero or less
    }

    // Event listener for Pay Now button
    document.getElementById('pay-button').addEventListener('click', function() {
        if (totalAmount > 0) { // Check if total amount is greater than zero
            // Redirect to the payment page
            window.location.href = "../pages/payments/payment.php"; // Update with your payment page URL
        } else {
            alert("No Services Selected");
        }
    });
</script>


            <!----customization-section---->

           <div class="customization-section" style="height: 400px; overflow-y: auto;">
  <h2>Customize Your Event</h2>
  <form action="#" id="customization-form">
    <div class="form-group">
      <label for="event-type">Event Type:</label>
      <select id="event-type" name="event-type" onchange="toggleWeddingType()">
        <option value="">Select an Event Type</option>
        <option value="wedding">Wedding</option>
        <option value="party">Personal Party</option>
        <option value="sports">Sports Event</option>
        <option value="service-only">Service Only</option>
      </select>
    </div>
    <div class="form-group" id="wedding-event-type-group" style="display: none;">
      <label for="wedding-event-type">Wedding Event Type:</label>
      <select id="wedding-event-type" name="wedding-event-type">
        <option value="">Select Wedding Type</option>
        <option value="christian-wedding">Christian Wedding</option>
        <option value="hindu-wedding">Hindu Wedding</option>
        <option value="muslim-wedding">Muslim Wedding</option>
        <option value="buddhist-wedding">Buddhist Wedding</option>
      </select>
    </div>
    <!-- Other form groups -->
    <div class="form-group">
      <label for="services">Select Services:</label>
      <div>
      
        <input type="checkbox" id="photography" name="services"  onclick="updateTotal()">
        <label for="photography">Photography</label>
      </div>
      <div>
        <input type="checkbox" id="videography" name="services" onclick="updateTotal()">
        <label for="videography">Videography</label>
      </div>
      <div>
        <input type="checkbox" id="catering" name="services" onclick="updateTotal()">
        <label for="catering">Catering</label>
      </div>
      <div>
        <input type="checkbox" id="Decoration" name="services" onclick="updateTotal()">
        <label for="Decoration">Decoration</label>
      </div>
      <div>
        <input type="checkbox" id="makeup" name="services"  onclick="updateTotal()">
        <label for="makeup">Makeup</label>
      </div>
      <div>
        <input type="checkbox" id="Costume" name="services" onclick="updateTotal()">
        <label for="makeup">Costume</label>
      </div>
      <div>
        <input type="checkbox" id="vehicle" name="services" onclick="updateTotal()">
        <label for="vehicle">Vehicle Hire</label>
      </div>
    </div>
    <div class="form-group">
      <label for="custom-feature">Additional Features:</label>
      <input type="text" id="custom-feature" name="custom-feature" placeholder="Enter Your Additional Features*">
    </div>
    <div class="form-group">
      <label for="budget">Budget (LKR):</label>
      <input type="number" id="budget" name="budget" placeholder="Enter Your Budget">
    </div>
    <div class="form-group">
      <label for="custom-notes">Additional Notes:</label>
      <textarea id="custom-notes" name="custom-notes"></textarea>
    </div>
    
    </div>
  </form>
  <div class="service-providers" id="provider-section" style="display:none;">
    <h3>Service Providers</h3>
    <ul id="provider-list">
      <!-- Service providers will be listed here based on the budget -->
    </ul>
  </div>
</div>



    <!-- Service Providers Section -->
 <section class="service-providers">
  <h3>Service Providers</h3>
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


<!----customization-section---->

  function toggleWeddingType() {
    var eventType = document.getElementById('event-type').value;
    var weddingEventTypeGroup = document.getElementById('wedding-event-type-group');
    
    if (eventType === 'wedding') {
      weddingEventTypeGroup.style.display = 'block';
    } else {
      weddingEventTypeGroup.style.display = 'none';
    }
  }

  function updateTotal() {
    // Example function to update the total based on selected services.
    var checkboxes = document.querySelectorAll('input[name="services"]:checked');
    var total = 0;
    
    checkboxes.forEach(function(checkbox) {
      total += parseFloat(checkbox.value);
    });
    
    document.getElementById('bill-details').innerHTML = '<p>Total: LKR ' + total.toLocaleString() + '</p>';
  }



        </script>
    </body>
</html>