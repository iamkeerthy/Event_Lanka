<?php
@include 'config.php';

session_start();

if(isset($_POST['submit'])){
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $pass = md5($_POST['password']);

   // Try Admin Table
   $select_admin = "SELECT * FROM admin1 WHERE username = '$name' AND password = '$pass'";
   $result_admin = mysqli_query($conn, $select_admin);

   if(mysqli_num_rows($result_admin) > 0){
      $row = mysqli_fetch_array($result_admin);
      $_SESSION['user_name'] = $row['username'];  // Ensure 'username' column exists
      $_SESSION['user_type'] = 'admin';
      header('location:PAGES/index.php');
      exit(); // Stop further execution

   // Try Service Providers Table
   } else {
      $select_serviceprovider = "SELECT * FROM serviceProviders WHERE username = '$name' AND password = '$pass'";
      $result_serviceprovider = mysqli_query($conn, $select_serviceprovider);

      if(mysqli_num_rows($result_serviceprovider) > 0){
         $row = mysqli_fetch_array($result_serviceprovider);
         $_SESSION['user_name'] = $row['username'];  // Ensure 'username' column exists
         $_SESSION['user_type'] = 'serviceProvider';
         header('location:PAGES/index.php');
         exit(); // Stop further execution

      // Try Regular Users Table
      } else {
         $select_user = "SELECT * FROM user_form WHERE username = '$name' AND password = '$pass'";
         $result_user = mysqli_query($conn, $select_user);

         if(mysqli_num_rows($result_user) > 0){
            $row = mysqli_fetch_array($result_user);
            $_SESSION['user_name'] = $row['username'];  // Ensure 'username' column exists
            $_SESSION['user_type'] = 'user';
            header('location:\\login\PAGES\index.php');
        
            exit(); // Stop further execution
         } else {
            $error[] = 'Incorrect username or password!';
         }
      }
   }
}
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
</head>
<body>
   
<div class="form-container">
   <form action="" method="post">
      <h3>Login Now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error_msg){
            echo '<span class="error-msg">'.$error_msg.'</span>';
         }
      }
      ?>
      <input type="text" name="name" required placeholder="Enter your name">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="submit" name="submit" value="Login Now" class="form-btn">
      <p>Don't have an account? <a href="register_form.php">Register now</a></p>
   </form>
</div>
</body>
</html>
