
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

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
    max-width: 900px; /* Adjusted form width */
    padding: 20px;
    background: rgba(255, 255, 255, 0.85);
    border-radius: 15px;
    box-shadow: var(--box-shadow);
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 20px;
}

.form-container h3 {
    font-size: 24px;
    margin-bottom: 20px;
    color: var(--primary-color);
    text-align: center;
    width: 100%;
}

.form-container input,
.form-container select {
    width: calc(50% - 10px);
    padding: 10px 15px;
    font-size: 14px;
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid var(--light-black);
    border-radius: 5px;
    margin-bottom: 15px; /* Added margin for spacing */
}

.form-container input[type="checkbox"] {
    width: auto;
    margin-right: 10px;
}

.form-container .terms {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
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
    margin-top: 20px; /* Added margin for spacing */
}

.form-container .form-btn:hover {
    background: var(--main-color);
}

.form-container p {
    margin-top: 10px;
    font-size: 14px;
    color: var(--light-black);
    text-align: center;
    width: 100%;
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
    width: 100%;
}

@media (max-width: 768px) {
    .form-container {
        flex-direction: column;
    }
    .form-container input,
    .form-container select {
        width: 100%;
    }
}
   </style>

</head>
<body>
   
<div class="form-container">
<form action="../bacend_logics_scripts/register_user.php" method="post" enctype="multipart/form-data">

   <h3>Register Now</h3>



   <input type="text" name="name" required placeholder="Enter your name">
   <input type="email" name="email" required placeholder="Enter your email">
   <input type="text" name="phone" required placeholder="Enter your phone number" pattern="[0-9]{10}" title="Enter a valid 10-digit phone number">

   <!-- <input type="text" name="phone" required placeholder="Enter your phone number"> -->
   <input type="text" name="username" required placeholder="Enter your username">
   <input type="text" name="nic_number" required placeholder="Enter your NIC number">
   <input type="text" name="address" required placeholder="Enter your address">
   <h4 style="width: 100%; text-align: center;">NIC Photos</h4>
   <input type="file" name="nic_front" accept="image/*" required>
<input type="file" name="nic_back" accept="image/*" required>

   
   <input type="password" name="password" required placeholder="Enter your password" pattern=".{6,}" title="Six or more characters">
   <input type="password" name="cpassword" required placeholder="Confirm your password" pattern=".{6,}" title="Six or more characters">

  
   
   <!-- Terms and Conditions -->
   <div class="terms">
      <input type="checkbox" name="terms" id="terms" required>
      <label for="terms">I agree to the <a href="../terms.php" target="">Terms and Conditions</a></label>
   </div>

   <input type="submit" name="submit" value="Register Now" class="form-btn">
   <p>Already have an account? <a href="login_form.php">Login now</a></p>
</form>


</div>

</body>
</html>
