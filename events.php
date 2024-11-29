
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
    <style>
        
.dropdown {
    position: relative;
    display: inline-block;
}

.dropbtn {
    background-color: #00274d; /* Primary color */
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown:hover .dropdown-content {
    display: block; /* Show the dropdown content on hover */
}
    </style>

    <link rel="stylesheet" href="styles/events.css">
    <!-- <link rel="stylesheet" href="styles/navfoot.css"> -->
    </head>
    <body>
        <!-- header section starts -->
        <header class="header">
            <div class="logo">
                <img src="Images Project/logo.png" alt="EventLanka Logo">
                <a href="index.php">EventLanka</a>
            </div>
            <nav class="navbar">
    <a  href="index.php">home</a>
    <a class='active' href="events.php">events</a>
    <a href="services.php">services</a>
    
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

    </div> 


    <div class="service-card">
        <img src="Images Project/l4.png" alt="Sports Decorations">  
    </div>         
            
<br>
<br>
<br>
            <div class="text1">
                <h1 class="t2" > We've crafted over,</h1>
            </div>
            
                   <div class="counter-wrapper">
                    <div class="counter">
                        <h1 class="count" data-target="554"></h1>
                        <p>Weddings</p>
                    </div>
                    <div class="counter">
                        <h1 class="count" data-target="468"></h1>
                        <p>Sports Events</p>
                    </div>
                    <div class="counter">
                        <h1 class="count" data-target="472"></h1>
                        <p>Personal Parties</p>
                    </div>
                    <div class="counter">
                        <h1 class="count" data-target="732"></h1>
                        <p>Happy customers every year</p>
                    </div>
                </div>
                
                
                <script>
                const counts = document.querySelectorAll('.count')
                const speed = 90
                
                counts.forEach((counter) => {
                    function upDate(){
                        const target = Number(counter.getAttribute('data-target'))
                        const count = Number(counter.innerText)
                        const inc = target / speed        
                        if(count < target){
                            counter.innerText = Math.floor(inc + count) 
                            setTimeout(upDate, 15)
                        }else{
                            counter.innerText = target
                        }
                    }
                    upDate()
                })
                
                </script>


<section id="services">

<div class="filters">
               
    <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">Category</button>
        <div id="myDropdown" class="dropdown-content">
          <a href="#wedding">wedding</a>
          <a href="#Sports">Sports Events</a>
          <a href="#Parties">Personal Parties</a>
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




</section>




<!-- events start -->
            <section id="services"  id="Weddings">
        <div class="service-container"  id="Weddings">
               
               <div class="service-info">
                   <h1>Weddings</h1>
<br>
<br>

                   <div class="display-container">
  <img class="mySlides" src="Images Project/o1.jpg" style="width:100%">
  <img class="mySlides" src="Images Project/o2.jpg" style="width:100%">
  <img class="mySlides" src="Images Project/o3.jpg" style="width:100%">
  <img class="mySlides" src="Images Project/o4.jpeg" style="width:100%">
  <img class="mySlides" src="Images Project/o5.jpg" style="width:100%">
  <img class="mySlides" src="Images Project/o5.jpg" style="width:100%">
  <img class="mySlides" src="Images Project/o6.jpg" style="width:100%">

  
</div>

<script>
    var slideIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > x.length) {slideIndex = 1}
  x[slideIndex-1].style.display = "block";
  setTimeout(carousel, 3000); 
}
</script>
                   
                   <p>At EventLanka, we're dedicated to crafting wedding celebrations that surpass your expectations. 
                       From the initial consultation to the final farewell,
                        our experienced team is committed to ensuring every detail reflects your unique love story and personal style.
                         With meticulous care and precision, we'll listen attentively to your vision, offer expert guidance, 
                         and bring it to life flawlessly.  
                       It's an honor to be entrusted with your special day, and we can't 
                       wait to create cherished memories that will last a lifetime.</p>


                       <div class="container">
    <div class="div1">
        <h2>Marriage</h2>
        <p2>
            <br>
            <br>
            "....and above all these things put on love, which is the bond of perfectness".
            <br>
            <br>
            <br>
            Colossians 3:14 (ASV)
        </p2>
        <br>
        <br>
        <br>
        <br>
        <a href="<?php echo $isLoggedIn ? 'packages.php' : 'login/login_form.php'; ?>" class="btn">Packages</a>
    </div>


                           <div class="div2">
                           <h2>Mangalyam</h2>
                           <br>
                               <br>
                           <p2>"Marriage is like an unconditional duties that one decided to perform"
                               <br>
                               <br>
                               <br>
                               Bhagavad Gita

                           </p2>
                           <br>
                           <br>
                           <br>
                           <br>
                           <br>
                           <a href="<?php echo $isLoggedIn ? 'packages.php' : 'login/login_form.php'; ?>" class="btn">Packages</a>
                       </div>
                           <div class="div3">
                           <h2>Poruwa</h2>
                           <br>
                           <br>
                           <p2>"Not to be contented with one's own wife, and to be seen with harlots and the wives of others—this
                                is a cause of one's downfall."
                                <br>
                                <br>
                                Gautama Buddha 
                               </p2>
                               <br>
                               <br>
                               <br>
                               <br>
                               <a href="<?php echo $isLoggedIn ? 'packages.php' : 'login/login_form.php'; ?>" class="btn">Packages</a>
                       </div>
                     
                           <div class="div4">
                           <h2>Nikah</h2>
                        <p2>
                        <br>
                        <br>"And how could you take it while you have gone in unto each other and they have taken from you a solemn covenant?"
                       <br>
                       <br>
   
   
                        (Quran 4:21)</p2>

   <br>
   <br>
   <br>
  
   <a href="<?php echo $isLoggedIn ? 'packages.php' : 'login/login_form.php'; ?>" class="btn">Packages</a>
                       </div>
                       </div>
                 
               </div>
           </div>

           <br>
           <br>
           <br>
        
    <div class="service-container" id="Sports">
           <div class="service-info" >
               <h1>Sports Decorations</h1>
               <p>Immerse yourself in the electrifying energy of a thrilling sports event! Feel the roar of the crowd, 
                   the adrenaline pumping with every play, and the sheer joy of competition.
                    Witness athletic prowess on display as competitors push their limits to achieve victory..</p>
             
              <a href="<?php echo $isLoggedIn ? 'packages.php' : 'login/login_form.php'; ?>" class="btn">Book now</a>
           </div>
           <div class="service-card">
               <img src="Images Project/sp3.jpg" alt="Sports Decorations">  
           </div>

       </div>
        <br>
       <br>
       <br>



        <div class="service-container" id="Parties">
           <div class="service-card">
               <img src="Images Project/ppk1.jpg" alt="Personal Parties">
             
            
              
           </div>
           <div class="service-info" >
               <h1>Personal Parties</h1>
               <p>Get ready to celebrate, mingle, and make memories that will last a lifetime! 
                    Whether you're planning a birthday bash, a housewarming soiree, a fun get-together with friends, 
                    or simply an excuse to have a good time, we've got you covered. 
                    Let's create an unforgettable event filled with laughter, good company, and the perfect atmosphere for fun!</p>
                    <a href="<?php echo $isLoggedIn ? 'packages.php' : 'login/login_form.php'; ?>" class="btn">Book now</a>
           </div>
            </div>

        </section>




  

       <!-- events end -->

   
       <!-- contact section starts  -->

       <!--No Contact section need-->

       <!-- contact section ends -->


     

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
