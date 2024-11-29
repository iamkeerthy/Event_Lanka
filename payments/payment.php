<?php
// Start the session
session_start();
include '../Classes/Database.php'; 

//get payable balance


error_log('Session payableAmount: ' . (isset($_SESSION['payableAmount']) ? $_SESSION['payableAmount'] : 'Not Set'));
$payableAmount = isset($_SESSION['payableAmount']) ? $_SESSION['payableAmount'] : 100;
$paymentOption = isset($_SESSION['payableOption']) ? $_SESSION['payableOption'] : 200;
$totalAmount = isset($_SESSION['totalAmount']) ? $_SESSION['totalAmount'] : 300;

echo "Payable Amount: LKR " . $payableAmount;
echo "Payable AmoASDASDunt: LKR " . $paymentOption;
echo "Total Amount: LKR " . $totalAmount;


// Set session timeout duration (e.g., 15 minutes)
$timeoutDuration = 900;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeoutDuration) {
    session_unset();
    session_destroy();
    header('Location: ../login/login_form.php');
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity time

// Initialize the database connection
$database = new Database();
$conn = $database->getConnection(); // Get the PDO connection object

// Check if userId is set in the session
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}
$userId = $_SESSION['user_id']; // Get the logged-in user's ID

// Function to generate OTP
function generateOTP() {
    return rand(100000, 999999);
}

// Function to encrypt OTP
function encryptOTP($otp) {
    return password_hash($otp, PASSWORD_DEFAULT);
}

// Function to send OTP email
function sendOTPEmail($email, $otp) {
    $subject = "Your OTP Code for Payment Verification";
    $message = "
        <html>
        <head>
            <title>Your OTP Code</title>
        </head>
        <body>
            <h2>Dear Customer,</h2>
            <p>Thank you for your payment. To complete your transaction, please use the following OTP code:</p>
            <h3 style='color: blue;'>$otp</h3>
            <p>If you did not request this code, please ignore this email.</p>
            <p>Best regards,<br>Event Lanka</p>
        </body>
        </html>
    ";
    $headers = "From: cbrrobeshan04@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    if (mail($email, $subject, $message, $headers)) {
        echo "OTP sent successfully.";
    } else {
        error_log("Failed to send OTP to $email");
        echo "Failed to send OTP. Please try again.";
    }
}

// Handle form submission for payment
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_payment'])) {
    // Sanitize inputs
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitize email
    $city = htmlspecialchars($_POST['city']);
    $zipCode = htmlspecialchars($_POST['zip_code']);
    $cardName = htmlspecialchars($_POST['card_name']);
    $cardNumber = htmlspecialchars($_POST['card_number']);
    $expMonth = intval($_POST['exp_month']);
    $expYear = intval($_POST['exp_year']);
    $cvv = intval($_POST['cvv']);
    $paymentDate = date('Y-m-d H:i:s'); // Store the current date and time

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email address.");
    }

    // Validate card number length (13-19 digits)
    if (strlen($cardNumber) < 13 || strlen($cardNumber) > 19) {
        die("Invalid card number.");
    }

    // Validate expiration date
    $currentYear = date('Y');
    $currentMonth = date('m');
    if ($expYear < $currentYear || ($expYear == $currentYear && $expMonth < $currentMonth)) {
        die("Card expiration date is invalid.");
    }

    // Generate and store OTP
    $otp = generateOTP();
    $encryptedOTP = encryptOTP($otp);

    // Store only the last 4 digits of the card number for security
    $last4CardDigits = substr($cardNumber, -4);

    // Prepare the SQL statement using PDO
    $stmt = $conn->prepare("INSERT INTO payment (first_name, last_name, email, city, zip_code, card_name, card_number, exp_month, exp_year, cvv, userId, amount,advanceAmount, status, otp, paymentDate,paymentMethod) 
                            VALUES (:first_name, :last_name, :email, :city, :zip_code, :card_name, :card_number, :exp_month, :exp_year, :cvv, :userId, :amount,:advanceAmount, 'Pending', :otp, :paymentDate,'card')");

?>
<script>
console.log(localStorage.getItem("paymentType"))
<?php

?>
</script>

    <?php
    // Bind the parameters using PDO
    $stmt->bindValue(':first_name', $firstName);
    $stmt->bindValue(':last_name', $lastName);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':city', $city);
    $stmt->bindValue(':zip_code', $zipCode);
    $stmt->bindValue(':card_name', $cardName);
    $stmt->bindValue(':card_number', $last4CardDigits); // Store only last 4 digits
    $stmt->bindValue(':exp_month', $expMonth);
    $stmt->bindValue(':exp_year', $expYear);
    $stmt->bindValue(':cvv', $cvv);
    $stmt->bindValue(':userId', $userId);

    if($paymentOption == "advance"){
        $stmt->bindValue(':advanceAmount', $payableAmount);
        $stmt->bindValue(':amount', $totalAmount);

    }if($paymentOption == "full"){
        $stmt->bindValue(':amount', $totalAmount);
        $stmt->bindValue(':advanceAmount', 0);

    }
    $stmt->bindValue(':otp', $encryptedOTP);
    $stmt->bindValue(':paymentDate', $paymentDate);

    // Execute the prepared statement
    try {
        $stmt->execute();
        // Send OTP email
        sendOTPEmail($email, $otp);

        // Store the email in session for OTP verification
        $_SESSION['email'] = $email;

        // Redirect to the same page with 'verify=true' parameter after submitting the payment
        header('Location: payment.php?verify=true');
        exit();
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage()); // Log the error
        echo "There was an error processing your payment. Please try again."  .$e->getMessage();
    }
}

// Handle OTP verification
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify_otp'])) {
    $otp = $_POST['otp'];
    $email = $_SESSION['email'];

    // Retrieve the OTP and amount from the database
    $stmt = $conn->prepare("SELECT otp, amount FROM payment WHERE email = :email AND status = 'Pending'");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $storedOtp = $result['otp'];
    $paidAmount = $result['amount']; // Get the paid amount

    // Verify OTP
    if (password_verify($otp, $storedOtp)) {
        // Update payment status to 'Completed'
        $stmt = $conn->prepare("UPDATE payment SET status = 'Completed' WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        // Display greeting message with the paid amount
        echo "
        <div style='text-align: center; margin-top: 50px;'>
            <h2>Thank You For Booking! Enjoy Your Event</h2>
            <p>Amount Paid: LKR " . number_format($paidAmount, 2) . "</p>
            <button onclick=\"window.location.href='../dash_boards/user_page.php'\">Go to Dashboard</button>
        </div>";

        // Stop further script execution (no redirect yet)
        exit();
    } else {
        echo "Invalid OTP.";
    }
}
?>

<!-- HTML and CSS from your original code -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <?php if (!isset($_GET['verify'])): ?>
        <h2>Payment Form</h2>
        <div class="container">
            <div class="navbar">
                <img src="../Images Project/Logo.png" class="logo" alt="Logo">
                <h1>Event Lanka</h1>
            </div>

            <!-- Payment form -->
            <form id="payment-form" action="payment.php" method="POST" onsubmit="return validatePaymentForm();">
                <div class="row">
                    <div class="col">
                        <h3 class="title">Summary and Invoices</h3>
                        <br>
                        <div class="inputBox">
                            <span>First Name :</span>
                            <input type="text" name="first_name" required>
                        </div>
                        <div class="inputBox">
                            <span>Last Name :</span>
                            <input type="text" name="last_name" required>
                        </div>
                        <div class="inputBox">
                            <span>E-mail :</span>
                            <input type="email" name="email" required>
                        </div>
                        <div class="inputBox">
                            <span>City :</span>
                            <input type="text" name="city" required>
                        </div>
                        <div class="inputBox">
                            <span>Zip Code :</span>
                            <input type="text" name="zip_code" required>
                        </div>
                    </div>

                    <div class="col">
                        <h3 class="title">Payment</h3>
                        <br>
                        <div class="inputBox">
                            <span>Name on Card :</span>
                            <input type="text" name="card_name" required>
                        </div>
                        <div class="inputBox">
                            <span>Credit Card Number :</span>
                            <input type="text" name="card_number" required>
                        </div>
                        <div class="inputBox">
                            <span>Expiration Month :</span>
                            <input type="text" name="exp_month" required>
                        </div>
                        <div class="inputBox">
                            <span>Expiration Year :</span>
                            <input type="text" name="exp_year" required>
                        </div>
                        <div class="inputBox">
                            <span>CVV :</span>
                            <input type="text" name="cvv" required>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Submit Payment" name="submit_payment" class="submit-btn">
            </form>
        </div>
        <?php else: ?>
        <!-- OTP verification form -->
        <div class="otp-form">
            <h2>OTP Verification</h2>
            <form action="payment.php" method="POST">
                <label for="otp">Enter OTP:</label>
                <input type="text" name="otp" required>
                <input type="submit" value="Verify OTP" name="verify_otp" class="submit-btn">
            </form>
        </div>
        <?php endif; ?>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
