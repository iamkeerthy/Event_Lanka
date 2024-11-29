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
    <link rel="stylesheet" href="styles/about us.css">
   
    
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
                <a href="packages.php">packages</a>
                <a href="review.php">reviews</a>
                <a  class='active' href="about_us.php">about us</a>
                <a href="contact_us.php">contact us</a>
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

        
        <section class="about">
        <div class="content">
            <h2>ABOUT US</h2>

            <h3>WHO WE ARE</h3>
            <img src="Images Project/01.webp" alt="">
           
            <p>EventLanka is an easy-to-use website that helps people in Badulla, Sri Lanka, plan their events. 
                We offer a variety of services, such as booking halls, catering, and creating custom event packages. </p>

            <p>This makes it simple for both individuals and businesses to organize their events. Our user-friendly platform 
                ensures a smooth experience, helping you create unforgettable weddings, corporate events, personal celebrations,
                 or sports events</p>

           <h3>WHAT DO WE DO</h3>
           <img src="Images Project/02.png" alt="">
            <p>We offer comprehensive services that cater to all your event needs, ensuring a seamless and memorable experience. Our hall bookings provide elegant and versatile venues perfect for weddings, corporate events, and other special occasions.</p> 
                
            <p>Additionally, we offer top-notch catering services, featuring a diverse menu tailored to suit your specific preferences and dietary requirements. To make your event truly unique, we also provide custom packages designed to meet your individual needs and budget. Our dedicated team works closely with you to plan and execute every detail, ensuring a flawless and unforgettable event from start to finish.</p>
     
            


              <h3>HOW DO WE HELP</h3>
              <img src="Images Project/03.jpg" alt="">
              <p>With our All-In-One tools, trusted local partners, and secure payment systems, we ensure a seamless and enjoyable planning experience tailored to your unique needs. Our comprehensive suite of tools covers every aspect of the planning process, from initial brainstorming to the final execution, providing you with the resources and support necessary to bring your vision to life.</p>
              
              <p> By partnering with local experts who possess deep regional knowledge, we guarantee the best advice and services that are specifically suited to your requirements. Our secure payment methods offer peace of mind, allowing you to concentrate on the excitement of your plans without any concerns about financial safety. By combining advanced technology with local expertise and robust security measures, we aim to make your planning process not only smooth and efficient but also thoroughly enjoyable.</p>
          
                          
             

            <h3>CREATE SUCCESS STORY</h3>
            <img src="Images Project/04.png" alt="">
            <p> Planning stress-free, unforgettable events is effortless with EventLanka. We specialize in turning your vision into reality, no matter the occasion. Our dedicated team of professionals handles every detail, ensuring a seamless and memorable experience.</p> 
            
            <p>From intimate gatherings to grand celebrations, EventLanka offers customized solutions tailored to your unique needs and preferences. We provide comprehensive event planning services, including venue selection, décor, catering, entertainment, and more. Trust EventLanka to bring your dream event to life, leaving you free to enjoy the moment without any worries. Let us take care of the details so you can focus on creating lasting memories.</p>
               
           

        </div>
       
    </section>

     

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