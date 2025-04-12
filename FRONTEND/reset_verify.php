<?php
session_start();
include '../Backend/config.php';

if (!isset($_SESSION['reset_email']) || !isset($_SESSION['reset_otp'])) {
    header("Location: forgot_password.php");
    exit();
}

$error = null;
$success = null;

function generateOtp() {
    return rand(100000, 999999);
}

function sendOtp($email, $otp) {
    $subject = "VEYRA - Password Reset Code";
    $message = "Hello,\n\nYour password reset verification code is: $otp\n\nThis code will expire in 15 minutes.\n\nIf you did not request this code, please ignore this email.\n\nRegards,\nVEYRA Team";
    $headers = "From: noreply@veyra.com";
    return mail($email, $subject, $message, $headers);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['verify_otp'])) {
        $enteredOtp = $_POST['otp'];
        $actualOtp = $_SESSION['reset_otp'];
        $email = $_SESSION['reset_email'];
        $otpTime = $_SESSION['reset_otp_time'];
        $currentTime = time();
        
        if ($currentTime - $otpTime > 900) {
            $error = "Verification code has expired. Please request a new one.";
        } elseif ($enteredOtp == $actualOtp) {
            $_SESSION['otp_verified'] = true;
        } else {
            $error = "Invalid verification code. Please try again.";
        }
    } elseif (isset($_POST['reset_password'])) {
        if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
            $error = "Please verify your email first.";
        } else {
            $newPassword = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            
            if (strlen($newPassword) < 6) {
                $error = "Password must be at least 6 characters.";
            } elseif ($newPassword !== $confirmPassword) {
                $error = "Passwords do not match.";
            } else {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $email = $_SESSION['reset_email'];
                $sql = "UPDATE users SET password = ? WHERE Email = ?";
                $stmt = mysqli_prepare($conn, $sql);
                
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $email);
                    
                    if (mysqli_stmt_execute($stmt)) {
                        $userSql = "SELECT * FROM users WHERE Email = ?";
                        $userStmt = mysqli_prepare($conn, $userSql);
                        mysqli_stmt_bind_param($userStmt, "s", $email);
                        mysqli_stmt_execute($userStmt);
                        $result = mysqli_stmt_get_result($userStmt);
                        
                        if(mysqli_num_rows($result) == 1) {
                            $user = mysqli_fetch_assoc($result);
                            $user_id = $user['Sno'];
                            $_SESSION['loggedin'] = true;
                            $_SESSION['email'] = $email;
                            $_SESSION['user_id'] = $user_id;
                            $_SESSION['id'] = $user_id;
                            unset($_SESSION['reset_email']);
                            unset($_SESSION['reset_otp']);
                            unset($_SESSION['reset_otp_time']);
                            unset($_SESSION['otp_verified']);
                            header("Location: index.php");
                            exit();
                        } else {
                            $error = "Failed to retrieve user information.";
                        }
                    } else {
                        $error = "Failed to update password. Please try again.";
                    }
                } else {
                    $error = "Database error. Please try again later.";
                }
            }
        }
    } elseif (isset($_POST['resend_otp'])) {
        $email = $_SESSION['reset_email'];
        $otp = generateOtp();
        $_SESSION['reset_otp'] = $otp;
        $_SESSION['reset_otp_time'] = time();
        
        if (sendOtp($email, $otp)) {
            $success = "Verification code has been resent to your email.";
        } else {
            $error = "Failed to resend verification code. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEYRA - Reset Password</title>
    <link rel="stylesheet" href="./output.css">
</head>
<body class="bg-stone-50 min-h-screen">
    <div class="container mx-auto px-4 flex flex-col items-center pt-8 pb-16">
        <div class="mb-8 text-4xl font-bold text-stone-700">
            VEYRA
        </div>
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <?php if (isset($_SESSION['otp_verified']) && $_SESSION['otp_verified'] === true): ?>
                <h1 class="text-2xl font-semibold mb-6 text-stone-800">Set New Password</h1>
                <form method="post" class="space-y-6">
                    <?php if(isset($error)): ?>
                        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-md">
                            <p class="text-sm"><?php echo htmlspecialchars($error); ?></p>
                        </div>
                    <?php endif; ?>
                    <div>
                        <label for="password" class="block text-sm font-medium mb-1 text-stone-700">New Password</label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required 
                               class="w-full p-2 border border-stone-200 rounded-md focus:border-stone-400 focus:ring-stone-400 focus:outline-none bg-stone-50">
                        <p class="text-xs text-stone-500 mt-1">Password must be at least 6 characters</p>
                    </div>
                    <div>
                        <label for="confirm_password" class="block text-sm font-medium mb-1 text-stone-700">Confirm New Password</label>
                        <input type="password" 
                               id="confirm_password" 
                               name="confirm_password" 
                               required 
                               class="w-full p-2 border border-stone-200 rounded-md focus:border-stone-400 focus:ring-stone-400 focus:outline-none bg-stone-50">
                    </div>
                    <button type="submit"
                            name="reset_password"
                            class="w-full bg-stone-700 hover:bg-stone-800 text-white font-medium py-2 px-4 rounded-md transition duration-300 ease-in-out cursor-pointer">
                        Reset Password
                    </button>
                </form>
            <?php else: ?>
                <h1 class="text-2xl font-semibold mb-6 text-stone-800">Verify Your Email</h1>
                <form method="post" class="space-y-6">
                    <?php if(isset($error)): ?>
                        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-md">
                            <p class="text-sm"><?php echo htmlspecialchars($error); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if(isset($success)): ?>
                        <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-md">
                            <p class="text-sm"><?php echo htmlspecialchars($success); ?></p>
                        </div>
                    <?php endif; ?>
                    <p class="text-sm text-stone-600">
                        We sent a verification code to <strong><?php echo htmlspecialchars($_SESSION['reset_email']); ?></strong>. Please enter the code below.
                    </p>
                    <div>
                        <label for="otp" class="block text-sm font-medium mb-1 text-stone-700">Verification Code</label>
                        <input type="text" 
                               id="otp" 
                               name="otp" 
                               required 
                               maxlength="6" 
                               class="w-full p-2 border border-stone-200 rounded-md focus:border-stone-400 focus:ring-stone-400 focus:outline-none bg-stone-50">
                    </div>
                    <button type="submit"
                            name="verify_otp"
                            class="w-full bg-stone-700 hover:bg-stone-800 text-white font-medium py-2 px-4 rounded-md transition duration-300 ease-in-out cursor-pointer">
                        Verify Code
                    </button>
                    <div class="text-center mt-4">
                        <button type="submit" 
                                name="resend_otp"
                                class="text-sm text-stone-600 hover:text-stone-800 hover:underline">
                            Didn't receive the code? Resend
                        </button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
        <div class="mt-8">
            <div class="flex justify-center gap-6 text-sm mb-4">
                <a href="#" class="text-stone-600 hover:text-stone-800 hover:underline">Terms</a>
                <a href="#" class="text-stone-600 hover:text-stone-800 hover:underline">Privacy</a>
                <a href="#" class="text-stone-600 hover:text-stone-800 hover:underline">Help</a>
            </div>
            <p class="text-xs text-stone-500 text-center">
                © 2025 VEYRA. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>