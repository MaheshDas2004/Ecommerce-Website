<?php
session_start();
include '../Backend/config.php';

// Function to generate a 6-digit OTP
function generateOtp() {
    return rand(100000, 999999);
}

// Function to send OTP via email
function sendOtp($email, $otp) {
    $subject = "VEYRA - Your OTP Verification Code";
    $message = "Hello,\n\nYour OTP verification code is: $otp\n\nThis code will expire in 15 minutes.\n\nIf you did not request this code, please ignore this email.\n\nRegards,\nVEYRA Team";
    $headers = "From: noreply@veyra.com";
    
    // Attempt to send the email and return the result
    return mail($email, $subject, $message, $headers);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Handle OTP verification
    if (isset($_POST['verify_otp'])) {
        $enteredOtp = $_POST['otp'];
        $actualOtp = $_SESSION['otp'];
        
        // Check if OTP is correct
        if ($enteredOtp == $actualOtp) {
            // Get user details from session
            $name = $_SESSION['name'];
            $email = $_SESSION['email'];
            $password = $_SESSION['password']; // Already hashed password
            
            // Clear sensitive session data but keep email for navbar
            unset($_SESSION['otp']);
            unset($_SESSION['show_otp_form']);
            unset($_SESSION['password']); // Remove password from session
            
            // Make sure to keep the email in session for navbar
            $_SESSION['email'] = $email; // Ensure this is set
            
            // Insert user into database
            $sql = "INSERT INTO `users` (`Name`, `Email`, `password`, `dt`) VALUES (?, ?, ?, current_timestamp())";
            $stmt = mysqli_prepare($conn, $sql);
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password);
                
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['success'] = "Account created successfully!";
                    $_SESSION['loggedin'] = true;
                    
                    // Redirect to index page
                    header("Location: index.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Database error: " . mysqli_error($conn);
                    header("Location: Signup.php");
                    }
                }
            } else {
                $_SESSION['error'] = "Database error: " . mysqli_error($conn);
                header("Location: Signup.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid OTP. Please try again.";
            $_SESSION['show_otp_form'] = false;
            header("Location: Signup.php");
            exit();
        }
    }
    
    // Handle OTP resend
    elseif (isset($_POST['resend_otp'])) {
        $email = $_SESSION['email'];
        $otp = generateOtp();
        $_SESSION['otp'] = $otp;
        
        if (sendOtp($email, $otp)) {
            $_SESSION['success'] = "OTP has been resent to your email.";
        } else {
            $_SESSION['error'] = "Failed to resend OTP. Please try again.";
        }
        
        $_SESSION['show_otp_form'] = true;
        header("Location: Signup.php");
        exit();
    }
    
    // Handle new registration form submission
    elseif (isset($_POST['register'])) {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $rawPassword = $_POST['Password'];
        
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Invalid email format";
            header("Location: Signup.php");
            exit();
        }
        
        // Validate password length
        if (strlen($rawPassword) < 6) {
            $_SESSION['error'] = "Password must be at least 6 characters";
            header("Location: Signup.php");
            exit();
        }
        
        // Check if email already exists
        $checkSql = "SELECT * FROM users WHERE Email = ?";
        $checkStmt = mysqli_prepare($conn, $checkSql);
        
        if ($checkStmt) {
            mysqli_stmt_bind_param($checkStmt, "s", $email);
            mysqli_stmt_execute($checkStmt);
            mysqli_stmt_store_result($checkStmt);
            
            if (mysqli_stmt_num_rows($checkStmt) > 0) {
                $_SESSION['error'] = "Email already exists. Please use a different email or login.";
                header("Location: Signup.php");
                exit();
            }
            
            mysqli_stmt_close($checkStmt);
        }
        
        // Hash the password
        $hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);
        
        // Store user details in session
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $hashedPassword;
        
        // Generate and send OTP
        $otp = generateOtp();
        $_SESSION['otp'] = $otp;
        
        if (sendOtp($email, $otp)) {
            $_SESSION['success'] = "Verification code sent to your email.";
            $_SESSION['show_otp_form'] = true;
            header("Location: Signup.php");
            exit();
        } else {
            $_SESSION['error'] = "Failed to send verification email. Please try again.";
            header("Location: Signup.php");
            exit();
        }
    }
} else {
    // If not POST request, redirect to signup page
    header("Location: Signup.php");
    exit();
}