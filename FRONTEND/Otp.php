<?php
session_start();
include '../Backend/config.php';

function generateOtp() {
    return rand(100000, 999999);
}

function sendOtp($email, $otp) {
    $subject = "VEYRA - Your OTP Verification Code";
    $message = "Hello,\n\nYour OTP verification code is: $otp\n\nThis code will expire in 15 minutes.\n\nIf you did not request this code, please ignore this email.\n\nRegards,\nVEYRA Team";
    $headers = "From: noreply@veyra.com";
    return mail($email, $subject, $message, $headers);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['verify_otp'])) {
        $enteredOtp = $_POST['otp'];
        $actualOtp = $_SESSION['otp'];
        
        if ($enteredOtp == $actualOtp) {
            $name = $_SESSION['name'];
            $email = $_SESSION['email'];
            $password = $_SESSION['password'];
            
            unset($_SESSION['otp']);
            unset($_SESSION['show_otp_form']);
            unset($_SESSION['password']);
            
            $_SESSION['email'] = $email;
            
            $sql = "INSERT INTO `users` (`Name`, `Email`, `password`, `dt`) VALUES (?, ?, ?, current_timestamp())";
            $stmt = mysqli_prepare($conn, $sql);
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password);
                
                if (mysqli_stmt_execute($stmt)) {
                    $user_id = mysqli_insert_id($conn);
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['id'] = $user_id;
                    $_SESSION['loggedin'] = true;
                    $_SESSION['success'] = "Account created successfully!";
                    header("Location: index.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Database error: " . mysqli_error($conn);
                    header("Location: Signup.php");
                    exit();
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
    } elseif (isset($_POST['resend_otp'])) {
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
    } elseif (isset($_POST['register'])) {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $rawPassword = $_POST['Password'];
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Invalid email format";
            header("Location: Signup.php");
            exit();
        }
        
        if (strlen($rawPassword) < 6) {
            $_SESSION['error'] = "Password must be at least 6 characters";
            header("Location: Signup.php");
            exit();
        }
        
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
        
        $hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);
        
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $hashedPassword;
        
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
    header("Location: Signup.php");
    exit();
}