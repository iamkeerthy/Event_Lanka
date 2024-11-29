
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        
    </script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventLanka</title>
    
    <link rel="stylesheet" href="styles/review.css">
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

.swiper {
  width: 100%;
  height: 100%;
}

.swiper-slide {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.swiper-pagination-bullet {
  background-color: gold;
}

.swiper-button-prev,
.swiper-button-next {
  color: gold;
}

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
                <a href="packages.php">packages</a>
                <a  class='active' href="review.php">reviews</a>
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
       
    


       <section class="section__container review" id="review">
  <h1 class="section__heading">Client's Review</h1>
  <div class="swiper review-slider">
    <div class="swiper-wrapper">
      <div class="swiper-slide slide">
        <img src="Images Project/tea0.jpg" alt="Client 1" />
        <h3>F.G.Maleeshan</h3>
        <div class="stars" data-rating="5">
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
          <span class="star">&#9733;</span>
        </div>
        <p>
          The eventlanka catering and refreshments were of high quality...
        </p>
      </div>

      <div class="swiper-slide slide">
        <img src="Images Project/tea2.jpg" alt="Client 2" />
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
        <img src="Images Project/tea3.jpg" alt="Client 3" />
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
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>
</section>
<?php


require_once '../pages/Classes/Database.php'; // Ensure this file handles DB connection
require_once '../pages/Classes/User.php'; // Include the User class

// Process the feedback form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $conn = $db->getConnection();
    
    // Instantiate User class
    $user = new User($conn);

   

    // Get the logged-in user's ID
    $userId = $_SESSION['userId']; 

    // Prepare feedback data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Prepare the SQL query to insert feedback
    $query = "INSERT INTO feedback (user_id, name, email, phone, subject, message) VALUES (:user_id, :name, :email, :phone, :subject, :message)";
    $stmt = $conn->prepare($query);

    // Bind the form values to the query
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':message', $message);

    // Execute the query and check for success
    if ($stmt->execute()) {
        echo "<p>Thank you for your feedback. We will contact you very soon.</p>";
    } else {
        echo "<p>There was an error submitting your feedback. Please try again.</p>";
    }
}
?>


        <!-- contact section starts  -->
        <section class="contact" id="contact">
            <h1 class="heading"><span>Tell Us About Your Experience </span> </h1>

            <form action="" method="post">
    <div class="inputBox">
        <input type="text" name="name" placeholder="name" required>
        <input type="email" name="email" placeholder="email" required>
    </div>

    <div class="inputBox">
        <input type="number" name="phone" placeholder="phone number" required>
        <input type="text" name="subject" placeholder="subject" required>
    </div>

    <textarea placeholder="message" name="message" id="message" cols="30" rows="10" required></textarea>

    <button type="submit" class="btn">Send Review</button>
</form>

        </section>
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
        

        menuBtn.onclick = () => {
            menuBtn.classList.toggle('fa-times');
            navbar.classList.toggle('active');
        };
       


        </script>
        <script>
  const swiper = new Swiper(".review-slider", {
    loop: true,
    grabCursor: true,
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
</script>



    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="index.js"></script>
    </body>
</html>
