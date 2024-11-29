<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>
   <!-- custom css file link -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

      :root {
          --main-color: #b35900;
          --primary-color: #00274d;
          --white: #fff;
          --bg: #ebe1e1;
          --light-black: #333;
          --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      }

      * {
          font-family: 'Poppins', sans-serif;
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          outline: none;
          border: none;
          text-decoration: none;
          transition: .2s linear;
      }

      body, html {
          height: 100%;
          display: flex;
          align-items: center;
          justify-content: center;
          background: var(--bg);
          padding: 20px;
      }

      .form-container {
          width: 100%;
          max-width: 500px;
          padding: 20px;
          background: rgba(255, 255, 255, 0.85);
          border-radius: 15px;
          box-shadow: var(--box-shadow);
      }

      .form-container h3 {
          font-size: 24px;
          margin-bottom: 20px;
          color: var(--primary-color);
          text-align: center;
      }

      .form-container input,
      .form-container select {
          width: 100%;
          padding: 10px 15px;
          font-size: 14px;
          background: rgba(255, 255, 255, 0.9);
          border: 1px solid var(--light-black);
          border-radius: 5px;
          margin-bottom: 15px;
      }

      .form-container .form-btn {
          background: var(--primary-color);
          color: var(--white);
          text-transform: uppercase;
          font-size: 18px;
          cursor: pointer;
          padding: 10px 20px;
          border-radius: 5px;
          border: none;
          width: 100%;
      }

      .form-container .form-btn:hover {
          background: var(--main-color);
      }

      .form-container p {
          margin-top: 10px;
          font-size: 14px;
          color: var(--light-black);
          text-align: center;
      }

      .form-container p a {
          color: var(--primary-color);
          text-decoration: underline;
      }

      .form-container .error-msg {
          margin: 10px 0;
          display: block;
          background: crimson;
          color: var(--white);
          border-radius: 5px;
          font-size: 16px;
          padding: 10px;
          text-align: center;
      }
   </style>
</head>
<body>
<div class="form-container">
<h3>Login Now</h3> 
<?php if (isset($_SESSION['error'])): ?>
        <div style="color: red;">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']); // Clear the error message after displaying it
            ?>
        </div>
    <?php endif; ?>

<form action="../bacend_logics_scripts/login_user.php" method="post">

    
      <input type="text" name="name" required placeholder="Enter your name" value="">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="submit" name="submit" value="Login Now" class="form-btn">
      <p>Don't have an  account?</p>
      <p> As a User <a href="user_register.php">Register Now</a></p>
      <p>As a ServicePrivider <a href="serviceprovider_registration.php">Register Now</a></p>
      
   </form>
</div>

</body>
</html>
