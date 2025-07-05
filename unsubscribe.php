<?php
session_start();
require_once 'functions.php';
// TODO: Implement the form and logic for email unsubscription.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //  the email submission form
    if (isset($_POST["email"])) {
        $code = generateVerificationCode();
        $_SESSION['verification_code'] = $code;
        $_SESSION['email'] = $_POST["email"];
        if (sendVerificationEmail($_POST["email"], $code)) {
            echo "<script>alert('Verification code sent to your email');</script>";
        } else {
            echo "<script>alert('Failed to send email. Try again later.');</script>";
        }
    }

    // the verification code form
    if (isset($_POST["verification_code"])) {
        $submittedCode = $_POST["verification_code"];
        $sessionCode = $_SESSION['verification_code'] ?? '';
        $email = $_SESSION['email'] ?? '';
        if ($submittedCode === $sessionCode) {
            if (unsubscribeEmail($email)) {
                echo "<script>alert('you have unsubscribed');</script>";
            } else {
                echo "<script>alert('You are not a subscriber');</script>";
            }
        } else {
            echo "<script>alert('Incorrect verification code');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <h2>Step 1: Enter Your Email</h2>
    <form method="POST">
        <div class="form-group">
            <label for="email">Enter your email address:</label>
            <input type="email" name="email" required placeholder="your-email@example.com">
        </div>
        <button type="submit">Submit</button>
    </form>

    <h2 style="margin-top: 40px;"> Enter Verification Code</h2>
    <form method="POST">
        <div class="form-group">
            <label for="verification_code">Enter verification code:</label>
            <input type="text" name="verification_code" maxlength="6" required placeholder="123456">
        </div>
        <button type="submit">Verify</button>
    </form>
</body>
</html>
