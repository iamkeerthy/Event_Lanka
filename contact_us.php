<?php
session_start(); 


$isLoggedIn = isset($_SESSION['user_name']);
$userType = $isLoggedIn ? $_SESSION['user_type'] : null;
$userName = $isLoggedIn ? $_SESSION['user_name'] : null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventLanka</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="styles/contact us.css">
    
    </head>
    <sc>
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
                <a href="packages.php">packages</a>
                <a href="review.php">reviews</a>
                <a href="about_us.php">about us</a>
                <a  class='active' href="contact_us.php">contact us</a>
            </nav>
            <div class="search-container">
            <input type="text" placeholder="Search...">
            <button><i class="bi bi-search"></i></button>
        </div>
            
        <div class="icons">
    <div class="user-avatar" id="userAvatar">
        <a href="<?php 
            // Check if the user is logged in
            if ($isLoggedIn) {
                // Redirect directly to the corresponding dashboard based on user type
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
                        // Fallback if user type is unknown
                        echo 'index.php'; // Redirect to home or another default page
                }
            } else {
                // Optionally, you can handle the case when the user is not logged in
                echo 'login/login_form.php'; // This can be removed if not needed
            }
        ?>">
            <img src="<?php echo isset($_SESSION['user_avatar']) ? $_SESSION['user_avatar'] : 'Images Project/user_Icon.png'; ?>" alt="User Avatar">
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

       

        <br><br><br>
        <section class="banner">
    <div class="banner">
        <h1>Let's Join Together!</h1>
        <h2>Make Dreams True</h2>
        <p>Join our network and offer your services through EventLanka. Download the guidelines PDF to get started.</p>

        <a id="download-link" href="guid_serviceprovider.pdf" download style="display:none;"></a>
        <button class="btn" id="download-btn">Download Guidelines</button>
    </div>
</section>


<script>
document.getElementById('download-btn').addEventListener('click', function() {
    let downloadBtn = document.getElementById('download-btn');
    let downloadLink = document.getElementById('download-link');
    let progress = 0;

    // Set the button state to downloading
    downloadBtn.classList.add('downloading');
    downloadBtn.innerHTML = ''; // Remove the "Download Guidelines" text
    downloadBtn.setAttribute('data-progress', '0%');

    // Simulate download progress
    let interval = setInterval(function() {
        progress += 10;
        downloadBtn.setAttribute('data-progress', progress + '%');

        if (progress >= 100) {
            clearInterval(interval);
            downloadBtn.setAttribute('data-progress', 'Download Complete');
            
            // Trigger the file download after completion
            setTimeout(function() {
                downloadLink.click();
                // Reset the button after the download
                setTimeout(function() {
                    downloadBtn.classList.remove('downloading');
                    downloadBtn.innerHTML = 'Download Guidelines'; // Restore the text after download
                }, 2000);
            }, 500);
        }
    }, 500); // Adjust the time interval to control the progress speed
});

</script>
    
    <section class="section__container contact" id="contact">
    <h1 class="section__heading"><span>contact</span> us</h1>

    <!-- Success message container -->
    <p id="success-message" class="success-message" style="display: none;">Thank you for reaching out! We will contact you very soon.</p>

    <form id="contactForm">
        <div class="inputBox">
            <input type="text" name="name" placeholder="name" required>
            <input type="email" name="email" placeholder="email" required>
        </div>

        <div class="inputBox">
            <input type="number" name="phone" placeholder="phone number" required>
            <input type="text" name="subject" placeholder="subject" required>
        </div>

        <textarea name="message" placeholder="message" cols="30" rows="10" required></textarea>

        <button class="btn" type="submit">Send Message</button>
    </form>
</section>

<!-- Custom CSS for Success Message -->
<style>
    .success-message {
        font-size: 1.5rem; /* Adjusted font size */
        color: #28a745; /* Green color for success */
        font-weight: bold; /* Make the text bold */
        margin-top: 20px; /* Space between the form and message */
    }
</style>

<script>
    // Grab the form and success message elements
    const contactForm = document.getElementById('contactForm');
    const successMessage = document.getElementById('success-message');

    // Add event listener to handle form submission
    contactForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Show the success message
        successMessage.style.display = 'block';

        // Optionally, you can clear the form fields after submission
        contactForm.reset();
    });
</script>


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
                <a href="terms.php"> <i class="fas fa-chevron-right"></i> terms & Condition </a>
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
    </>
</html>
