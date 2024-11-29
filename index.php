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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" >
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 <!--swiperjs cdn link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventLanka</title>
    <link rel="stylesheet" href="styles/index.css">
    <style>
        .stars {
    color: gold; /* Color of stars */
}

.star {
    font-size: 20px; /* Size of stars */
}

.star:hover,
.star:hover ~ .star {
    color: lightgray; /* Change color on hover */
}

    </style>
    

<body>
    <!-- header section starts -->
    <header class="header">
        <div class="logo">
            <img src="Images Project/logo.png" alt="EventLanka Logo">
            <a href="index.php">EventLanka</a>
        </div>

        <nav class="navbar">
    <a class='active' href="index.php">home</a>
    <a href="events.php">events</a>
    <a href="services.php">services</a>
    
    <?php if ($isLoggedIn): ?>
        <!-- Show additional links for logged-in users -->
        <a href="packages.php">packages</a>
        <a href="review.php">reviews</a>
        <a href="about_us.php">about us</a>
        <a href="contact_us.php">contact us</a>
        
       
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
        <input type="text" id="searchInput" placeholder="Search Here!">
        <button onclick="search()">Search</button>
        <div id="alertMessage" style="color: red; margin-top: 10px;"></div>
        </div>

<script>
const searchMapping = {
    'catering': 'services.php',
    'photography': 'services.php',
    'sports': 'events.php',
    'wedding': 'events.php'
};

function search() {
    let query = document.getElementById('searchInput').value.toLowerCase().trim();
    let alertDiv = document.getElementById('alertMessage');
    
    
    alertDiv.innerHTML = '';

    if (searchMapping[query]) {
        
        window.location.href = searchMapping[query];
    } else {
        
        alertDiv.innerHTML = 'No matching pages found. Please try again.';
    }
}
    </script>
   
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
       
    

      <!-- header section end -->
    <!-- home -->
    <section class="section__container home" id="home">
        <div class="home__image">
            <img src="Images Project/1.jpg" alt="home" />
        </div>
        <div class="content">
            <div>
                <h1>We Help You Make Modern Interior</h1>
                <p>
                    We will help you to make an elegant and luxurious interior designed
                    by professional interior designer.

                </p>
            </div>
        </div>
    </section>
    <!-- end -->

    <!-- about -->
    <section class="section__container about__container" id="about">
        <div class="about__header">
            <div>
                <h2 class="section__header">About us</h2>
                <p class="section__description">
                    Our passion for exceptional craftsmanship drives us to curate the
                    best pieces for every room in your house.
                </p>
            </div>
         
        </div>
        <div class="about__content">
            <div class="about__image">
                <img src="Images Project/about.jpg" alt="about" />
            </div>
            <div class="about__grid">
                <div class="about__card">
                    <h3>1.</h3>
                    <h4>Who we are</h4>
                    <p>
                        You get a 2-week free trail to kick the Smaert tries. We want you
                        to.
                    </p>
                </div>
                <div class="about__card">
                    <h3>2.</h3>
                    <h4>What do we do</h4>
                    <p>
                        We give you a free course that guides you through the process.
                    </p>
                </div>
                <div class="about__card">
                    <h3>3.</h3>
                    <h4>How do we help</h4>
                    <p>Use our multimedis lectures, videos, and coaching sessions.</p>
                </div>
                <div class="about__card">
                    <h3>4.</h3>
                    <h4>Create success story</h4>
                    <p>
                        With access to online learning resources anyone can transform.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- end -->

    <!-- services -->
    <section class="section__container services" id="services">
        <h1 class="section__heading">our services</h1>
        <div class="box-container">
            <div class="box">
                <img src="Images Project/Catering.jpeg" alt="Catering Service">
                <h3>Catering</h3>
                <p>Delicious food for all types of events.</p>
            </div>
            <div class="box">
                <img src="Images Project/Decoration.jpg" alt="Decoration Service">
                <h3>Decoration</h3>
                <p>Beautiful decorations to enhance your events.</p>
            </div>
            <div class="box">
                <img src="Images Project/151.jpg" alt="Costume Service">
                <h3>Costume</h3>
                <p>Perfect costumes for weddings and parties.</p>
            </div>
            <div class="box">
                <img src="Images Project/Makeup.jpg" alt="Makeup Service">
                <h3>Makeup</h3>
                <p>Professional makeup services for all occasions.</p>
            </div>
            <div class="box">
                <img src="Images Project/Vehicle.jpg" alt="Vehicle Hire Service">
                <h3>Vehicle Hire</h3>
                <p>Luxury vehicles for your special events.</p>
            </div>
            <div class="box">
                <img src="Images Project/video1.jpg" alt="Vehicle Hire Service">
                <h3>Photography & Videography</h3>
                <p>Luxury vehicles for your special events.</p>
            </div>
        </div>
    </section>
    <!-- services end -->
    <!-- Event-->
    <section class="section__container event" id="event">


        <h1 class="section__heading">our Events</h1>


        <div class="row">
            <div class="box-container">
                <div class="box">
                    <img src="Images Project/HinduWeds.jpeg" alt="">
                    <div class="info">
                        <h3>01. Wedding</h3>
                        <p><i class="fas fa-quote-left"></i> EventLanka offers comprehensive services for Christian, Hindu, Buddhist, and Muslim weddings. 
                        We ensure sacred and joyous ceremonies for Christians, culturally rich Hindu traditions, 
                        meticulous Poruwa rituals for Buddhists, and respectful Nikah and Walima receptions for Muslims.! <i
                                class="fas fa-quote-right"></i></p>
                    </div>
                </div>
                <div class="box">
                    <div class="info">
                        <h3>02. Sports Decoration</h3>
                        <p><i class="fas fa-quote-left"></i> Providing decoration services for various sports events, ensuring a vibrant and energetic atmosphere.! <i
                                class="fas fa-quote-right"></i></p>
                    </div>
                    <img src="Images Project/sp3.jpg" alt="">
                </div>
            </div>
            <div class="box-container">
                <div class="box">
                    <img src="Images Project/ppk1.jpg" alt="">

                </div>
                <div class="box">
                    <div class="info">
                        <h3>03. Personal Parties</h3>
                        <p><i class="fas fa-quote-left"></i> Offering decoration, catering, and other event management services for personal parties such as birthdays,
 anniversaries, and other celebrations.! <i
                                class="fas fa-quote-right"></i></p>
                    </div>

                </div>
            </div>

    </section>
    <!--Event end-->
    <!-- service providers -->
    <section class="section__container service_providers" id="service_providers">

        <h1 class="section__heading">our service providers</h1>

        <div class="box-container" data-aos="fade-up">

            <div class="box">
                <img src="Images Project/ser3.jpg" alt="">
                <h3>R.K.Ravindu</h3>
                <h4>Catering</h4>
               
            </div>

            <div class="box">
                <img src="Images Project/tea.jpg" alt="">
                <h3>R.R.Dishal</h3>
                <h4>Decoration</h4>
                
            </div>

            <div class="box">
                <img src="Images Project/pic-3.jpeg" alt="">
                <h3>K.Dilux</h3>
                <h4>wedding planner</h4>
            </div>

            <div class="box">
                <img src="Images Project/pic-2.webp" alt="">
                <h3>K.Yuvani</h3>
                <h4>Costume and Makeup</h4>
            </div>

        </div>
                <div class="banner">
            <h1>Let's Join Together!</h1>
            <h2>Make Dreams True</h2>
            <p>Join our network and offer your services through EventLanka. Download the guidelines PDF to get started.</p>
            
            <!-- Conditional download link -->
            <?php if ($isLoggedIn): ?>
                <a id="download-link" href="guid_serviceprovider.pdf" download style="display:none;"></a>
        <button class="btn" id="download-btn">Download Guidelines</button>
                </a>
            <?php else: ?>
                <a href="login/login_form.php">
                
                <button class="btn" id="download-btn">Download Guidelines</button>
                </a>
            <?php endif; ?>
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
    <!-- service providers end -->
    <!-- galary start-->
    <section class="section__container gallery" id="gallery">

        <h1 class="section__heading"> <span>our</span> gallery</h1>

        <div class="swiper gallery-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="Images Project/ev2.jpg" alt=""></div>
                <div class="swiper-slide"><img src="Images Project/chef.jpg" alt=""></div>
                <div class="swiper-slide"><img src="Images Project/Catering.jpeg" alt=""></div>
                <div class="swiper-slide"><img src="Images Project/pp3.jpg" alt=""></div>
                <div class="swiper-slide"><img src="Images Project/Makeup.jpg" alt=""></div>
                <div class="swiper-slide"><img src="Images Project/ch5.jpg" alt=""></div>
                <div class="swiper-slide"><img src="Images Project/gallery-3.jpg" alt=""></div>
                <div class="swiper-slide"><img src="Images Project/Ev3.jpg" alt=""></div>
                <div class="swiper-slide"><img src="Images Project/ev5.jpg" alt=""></div>
                <div class="swiper-slide"><img src="Images Project/gallery-6.jpg" alt=""></div>
            </div>
        </div>
        
    </section>
    <!--galary end-->

    <!-- team -->

    <section class="section__container team" id="team">

        <h1 class="section__heading">our team</h1>

        <div class="box-container" data-aos="fade-up">

            <div class="box">
                <img src="Images Project/mod1.jpg" alt="">
                <h3>K.J.Pragash</h3>
                <p>wedding planner</p>
                <div class="share">
                    <a href="https://web.facebook.com/" class="fab fa-facebook-f"></a>
                    <a href="https://x.com/" class="fab fa-twitter"></a>
                    <a href="https://www.linkedin.com/" class="fab fa-linkedin"></a>
                    <a href="https://www.instagram.com/" class="fab fa-instagram"></a>
                </div>
            </div>

            <div class="box">
                <img src="Images Project/pic-1.avif" alt="">
                <h3>R.Sundhar</h3>
                <p>wedding planner</p>
                <div class="share">
                    <a href="https://web.facebook.com/" class="fab fa-facebook-f"></a>
                    <a href="https://x.com/" class="fab fa-twitter"></a>
                    <a href="https://www.linkedin.com/" class="fab fa-linkedin"></a>
                    <a href="https://www.instagram.com/" class="fab fa-instagram"></a>
                </div>
            </div>

            <div class="box">
                <img src="Images Project/mod2.jpg" alt="">
                <h3>D.Vijay</h3>
                <p>wedding planner</p>
                <div class="share">
                    <a href="https://web.facebook.com/" class="fab fa-facebook-f"></a>
                    <a href="https://x.com/" class="fab fa-twitter"></a>
                    <a href="https://www.linkedin.com/" class="fab fa-linkedin"></a>
                    <a href="https://www.instagram.com/" class="fab fa-instagram"></a>
                </div>
            </div>

            <div class="box">
                <img src="Images Project/pic-4.jpg" alt="">
                <h3>K.D.Redmi</h3>
                <p>wedding planner</p>
                <div class="share">
                    <a href="https://web.facebook.com/" class="fab fa-facebook-f"></a>
                    <a href="https://x.com/" class="fab fa-twitter"></a>
                    <a href="https://www.linkedin.com/" class="fab fa-linkedin"></a>
                    <a href="https://www.instagram.com/" class="fab fa-instagram"></a>
                </div>
            </div>

        </div>

    </section>

        <!-- end -->

<!-- packages -->
<section class="section__container plan" id="plan">
    <h1 class="section__heading">packages</h1>
    <div class="box-container">
        <div class="box">
            <h3 class="title">Basic Package</h3>
            <h3 class="price">700,000<span>Rs</span></h3>
            <ul>
                <li><i class="fas fa-check"></i>photography 5 Hours</li>
                <li><i class="fas fa-check"></i>Catering for 650 Persons</li>
                <li><i class="fas fa-check"></i>costumes</li>
                <li><i class="fas fa-check"></i>Basic Vehicle</li>
                <li><i class="fas fa-check"></i>full assistance</li>
            </ul>
            <a href="<?php echo $isLoggedIn ? 'packages.php?package=basic' : 'login/login_form.php'; ?>">
                <button class="btn">Buy Now</button>
            </a>
        </div>

        <div class="box">
            <h3 class="title">Standard Package</h3>
            <h3 class="price">850,000<span>Rs</span></h3>
            <ul>
                <li><i class="fas fa-check"></i>photography 8 Hours</li>
                <li><i class="fas fa-check"></i>Catering for 900 Persons</li>
                <li><i class="fas fa-check"></i>costumes</li>
                <li><i class="fas fa-check"></i>Standard Vehicle</li>
                <li><i class="fas fa-check"></i>full assistance</li>
            </ul>
            <a href="<?php echo $isLoggedIn ? 'packages.php?package=standard' : 'login/login_form.php'; ?>">
                <button class="btn">Buy Now</button>
            </a>
        </div>

        <div class="box">
            <h3 class="title">Premium Package</h3>
            <h3 class="price">1,000,000<span>Rs</span></h3>
            <ul>
                <li><i class="fas fa-check"></i>Photography 12 Hours</li>
                <li><i class="fas fa-check"></i>Catering for 1500 Persons</li>
                <li><i class="fas fa-check"></i>costumes and Makeup</li>
                <li><i class="fas fa-check"></i>Premium Vehicle</li>
                <li><i class="fas fa-check"></i>Premium Decoration</li>
                <li><i class="fas fa-check"></i>full assistance</li>
            </ul>
            <a href="<?php echo $isLoggedIn ? 'packages.php?package=premium' : 'login/login_form.php'; ?>">
                <button class="btn">Buy Now</button>
            </a>
        </div>
    </div>
</section>
<!-- packages section ends -->


    <section class="section__container review" id="review">
    <h1 class="section__heading">Client's Review</h1>
    <div class="swiper review-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide slide">
                <img src="Images Project/tea0.jpg" alt="Client 1">
                <h3>F.G.Maleeshan</h3>
                <div class="stars" data-rating="5">
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                </div>
                <p>The eventlanka catering and refreshments were of high quality...</p>
            </div>
            <div class="swiper-slide slide">
                <img src="Images Project/tea2.jpg" alt="Client 2">
                <h3>G.Ganeash</h3>
                <div class="stars" data-rating="4">
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9734;</span>
                </div>
                <p>The event registration process was straightforward and user-friendly...</p>
            </div>
            <div class="swiper-slide slide">
                <img src="Images Project/tea3.jpg" alt="Client 3">
                <h3>K.Pragashini</h3>
                <div class="stars" data-rating="3">
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9734;</span>
                    <span class="star">&#9734;</span>
                </div>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit...</p>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>


<!-- contact section starts  -->
<section class="section__container contact" id="contact">
    <h1 class="section__heading"><span>contact</span> us</h1>

    <form id="contactForm" onsubmit="return handleFormSubmit(event);"> <!-- Use JavaScript to handle form submission -->

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

    <div id="responseMessage" style="display: none; margin-top: 20px;" class="alert alert-success"></div> <!-- Hidden message div -->
</section>
<!-- contact section ends -->

<script>
    function handleFormSubmit(event) {
        event.preventDefault(); // Prevent the default form submission

        // You can access form values here if needed
        const name = event.target.name.value;
        const email = event.target.email.value;
        const phone = event.target.phone.value;
        const subject = event.target.subject.value;
        const message = event.target.message.value;

        // Display the response message
        const responseMessage = document.getElementById('responseMessage');
        responseMessage.innerText = "Thank you, " + name + "! We will contact you very soon!";
        responseMessage.style.display = "block"; // Show the message

        // Optionally, clear the form fields
        event.target.reset();
    }
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

        <div class="credit"> created by <span><a href="index.php" style="color:green">EventLanka</a></span> | all rights reserved </div>

    </section>
    <!-- footer section ends -->

    <script>
        let navbar = document.querySelector('.header .navbar');
        let menuBtn = document.querySelector('#menu');
        

        menuBtn.onclick = () => {
            menuBtn.classList.toggle('fa-times');
            navbar.classList.toggle('active');
        };


        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/YOUR_PROPERTY_ID/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
        

    const stars = document.querySelectorAll('.star');

stars.forEach((star, index) => {
    star.addEventListener('click', () => {
        const rating = index + 1; // Calculate the rating based on the star index
        const starsContainer = star.parentElement;
        
        // Update the rating in the stars display
        starsContainer.setAttribute('data-rating', rating);
        stars.forEach((s, i) => {
            s.innerHTML = (i < rating) ? '&#9733;' : '&#9734;'; // Filled star vs empty star
        });

        // You can send this rating to your backend here
        console.log("Selected rating: " + rating);
    });
});
  


    </script>
    
    <!--swiperjs cdn link-->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="index.js"></script>
</body>

</html>