
<?php
session_start(); // Start the session to track user login

// Check if the user is logged in
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
  <link rel="stylesheet" href="styles/services.css">
  
    
    </head>
    <body style="background-color: var(--bg);">
        <!-- header section starts -->
        <header class="header">
            <div class="logo">
                <img src="Images Project/logo.png" alt="EventLanka Logo">
                <a href="index.php">EventLanka</a>
            </div>
            <nav class="navbar">
    <a  href="index.php">home</a>
    <a href="events.php">events</a>
    <a class='active' href="services.php">services</a>
    <?php if ($isLoggedIn): ?>
        <!-- Show additional links for logged-in users -->
        <a href="packages.php">packages</a>
        <a href="review.php">reviews</a>
        <a href="about_us.php">about us</a>
        <a href="contact_us.php">contact us</a>
        <span style="margin-left: 15px; color: #00274d;">
            Welcome, <?php echo $userName; ?> (<?php echo $userType; ?>)
        </span>
       
    <?php else: ?>
        <!-- Show only login and register options for guests -->
        <a href="login/login_form.php">login</a>
        <!-- User type selection for registration -->
        <div class="dropdown">
            <button class="dropbtn">Register</button>
            <div class="dropdown-content">
                <a href="../login/user_register.php">Registered User</a>
                <a href="../login/serviceprovider_registration.php">Service Provider</a>
            </div>
        </div>
    <?php endif; ?>
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
        <section id="services">

<br>
<br>
<br>

          <h1 class="heading">"We take the stress out of event planning, so you can enjoy the celebration"</h1>
          <br>
          <br>
          
         <div class="filters">
               
    <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">Category</button>
        <div id="myDropdown" class="dropdown-content">
          <a href="#Catering">Catering</a>
          <a href="#Photography">Photography & Videographt</a>
          <a href="#Decorations">Decoration</a>
          <a href="#Costume">Costume & Makeup</a>
          <a href="#vehicle">Vehicle Hire</a>
          <a href="#hall">Hall Booking</a>
        </div>
      </div>
</div>

<script>


function myFunction() {
document.getElementById("myDropdown").classList.toggle("show");
}


window.onclick = function(event) {
if (!event.target.matches('.dropbtn')) {
var dropdowns = document.getElementsByClassName("dropdown-content");
var i;
for (i = 0; i < dropdowns.length; i++) {
var openDropdown = dropdowns[i];
if (openDropdown.classList.contains('show')) {
openDropdown.classList.remove('show');
}
}
}
}
</script>
<br><br><br>

         <div></div>
           <p style="font-size: 1.5rem;">At EventLanka , we specialize in curating unforgettable events that exceed your expectations.
        From our initial consultation to the final farewell, our dedicated team is committed to ensuring every detail 
        reflects your unique vision and personal style. With meticulous attention to detail, we listen closely to your
         desires, provide expert guidance, and flawlessly bring your event 
       to life. We consider it a privilege to be part of your special occasion and look forward to creating cherished memories that will last a lifetime.</p>

</div>
          
      
        <div class="container" >
         <div class="card__container">
            <article class="card__article" id="Catering">
               <img src="Images Project/c2.jpg" alt="image" class="card__img">

               <div class="card__data">
                  <span class="card__description">Welcome to our premier catering services! We offer exquisite
                     menus tailored to your event. Trust us to make your special 
                      occasion truly unforgettable with exceptional food and professional service.</span>
                  <h1 class="card__title">Catering</h1>
                  <a href="<?php echo $isLoggedIn ? 'packages.php' : 'login/login_form.php'; ?>" class="btn">Book now</a>
               </div>
            </article>

            <article class="card__article" id="Photography">
               <img src="Images Project/p1.jpg" alt="image" class="card__img">

               <div class="card__data">
                  <span class="card__description">Capture your special moments with our professional Photography & Videography services.</span>
                  <h2 class="card__title">Photography & Videography</h2>
                  <a href="<?php echo $isLoggedIn ? 'packages.php' : 'login/login_form.php'; ?>" class="btn">Book now</a>
               </div>
            </article>

            <article class="card__article" id="Decorations">
               <img src="Images Project/D1.jpg" alt="image" class="card__img">

               <div class="card__data">
                  <span class="card__description">Create magical moments with our exceptional decoration services. 
                    From weddings to corporate events, we design breathtaking settings that reflect your style. </span>
                  <h2 class="card__title">Decorations</h2>
                  <a href="<?php echo $isLoggedIn ? 'packages.php' : 'login/login_form.php'; ?>" class="btn">Book now</a>
               </div>
            </article>
         </div>
      </div>

     

      <div class="container">
         <div class="card__container">
            <article class="card__article" id="Costume">
               <img src="Images Project/151.jpg" alt="image" class="card__img">

               <div class="card__data">
                  <span class="card__description">From elegant weddings to vibrant parties,
                     we ensure you look perfect for every occasion. Trust our skilled team to create stunning looks tailored to your style</span>
                  <h2 class="card__title">Costume & Makeup</h2>
                  <a href="<?php echo $isLoggedIn ? 'packages.php' : 'login/login_form.php'; ?>" class="btn">Book now</a>
               </div>
            </article>

            <article class="card__article" id="vehicle">
               <img src="Images Project/v2.jpg" alt="image" class="card__img">

               <div class="card__data">
                  <span class="card__description">Need reliable vehicle hire for your events? Our service offers 
                    a wide range of vehicles to suit your needs. From luxury cars to spacious vans, </span>
                  <h2 class="card__title">Vehicle Hire</h2>
                  <a href="<?php echo $isLoggedIn ? 'packages.php' : 'login/login_form.php'; ?>" class="btn">Book now</a>
               </div>
            </article>

            <article class="card__article" id="hall">
               <img src="Images Project/h2.jpg" alt="image" class="card__img">

               <div class="card__data">
                  <span class="card__description">Book your next event with ease! Our hall booking services provide a perfect venue for
                     weddings, parties, and corporate events</span>
                  <h2 class="card__title">Hall booking</h2>
                  <a href="<?php echo $isLoggedIn ? 'packages.php' : 'login/login_form.php'; ?>" class="btn">Book now</a>
               </div>
            </article>
         </div>
      </div>
    </div>


        </section>
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
    </body>
</html>
