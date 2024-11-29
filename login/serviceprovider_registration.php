<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Provider Registration</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Styling similar to your existing form */
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
            max-width: 900px;
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
        .form-container textarea {
            width: calc(50% - 10px);
            padding: 10px 15px;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid var(--light-black);
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .form-container textarea {
            height: 100px;
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
            margin-top: 20px;
        }

        .form-container .form-btn:hover {
            background: var(--main-color);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-container {
                flex-direction: column;
            }

            .form-container input,
            .form-container textarea {
                width: 100%; /* Full width for smaller screens */
            }
        }

        @media (max-width: 480px) {
            .form-container h3 {
                font-size: 20px;
            }

            .form-container input,
            .form-container textarea {
                padding: 8px 10px;
                font-size: 13px;
            }

            .form-container .form-btn {
                font-size: 16px;
                padding: 8px 15px;
            }
        }

        .error {
            color: red;
            font-size: 13px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <form action="../bacend_logics_scripts/register_service_provider.php" method="post" enctype="multipart/form-data">

        <h3>Service Provider Registration</h3>

        <!-- Service Provider Details -->
        <input type="text" name="providerName" required placeholder="Enter your Business/Provider Name" value="<?php echo isset($_POST['providerName']) ? htmlspecialchars($_POST['providerName']) : ''; ?>">
        <?php if (isset($_SESSION['providerNameError'])): ?>
            <p class="error"><?php echo $_SESSION['providerNameError']; ?></p>
        <?php endif; ?>

        <input type="email" name="email" required placeholder="Enter your Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
        <?php if (isset($_SESSION['emailError'])): ?>
            <p class="error"><?php echo $_SESSION['emailError']; ?></p>
        <?php endif; ?>

        <input type="text" name="contactInfo" required placeholder="Enter your Contact Number" value="<?php echo isset($_POST['contactInfo']) ? htmlspecialchars($_POST['contactInfo']) : ''; ?>">
        <?php if (isset($_SESSION['contactInfoError'])): ?>
            <p class="error"><?php echo $_SESSION['contactInfoError']; ?></p>
        <?php endif; ?>

        <!-- User Details -->
        <input type="text" name="username" required placeholder="Create a Username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
        <?php if (isset($_SESSION['usernameError'])): ?>
            <p class="error"><?php echo $_SESSION['usernameError']; ?></p>
        <?php endif; ?>

        <input type="password" name="password" required placeholder="Create a Password">
        <?php if (isset($_SESSION['passwordError'])): ?>
            <p class="error"><?php echo $_SESSION['passwordError']; ?></p>
        <?php endif; ?>

        <input type="password" name="cpassword" required placeholder="Confirm your Password">
        <?php if (isset($_SESSION['cpasswordError'])): ?>
            <p class="error"><?php echo $_SESSION['cpasswordError']; ?></p>
        <?php endif; ?>

        <textarea name="serviceDetails" required placeholder="Describe the services you provide"><?php echo isset($_POST['serviceDetails']) ? htmlspecialchars($_POST['serviceDetails']) : ''; ?></textarea>

        <!-- Terms and Conditions -->
        <div class="terms">
            <input type="checkbox" name="terms" id="terms" required>
            <label for="terms">I agree to the <a href="../terms.php" target="_blank">Terms and Conditions</a></label>
        </div>

        <input type="submit" name="submit" value="Register Now" class="form-btn">
        <center><p>Already have an account? <a href="login_form.php">Login now</a></p></center>
    </form>
</div>
</body>
</html>
