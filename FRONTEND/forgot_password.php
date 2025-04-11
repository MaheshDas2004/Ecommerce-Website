<?php
session_start();
include '../Backend/config.php';

// Function to generate a 6-digit OTP
function generateOtp() {
    return rand(100000, 999999);
}

// Function to send OTP via email
function sendOtp($email, $otp) {
    $subject = "VEYRA - Password Reset Code";
    $message = "Hello,\n\nYour password reset verification code is: $otp\n\nThis code will expire in 15 minutes.\n\nIf you did not request this code, please ignore this email.\n\nRegards,\nVEYRA Team";
    $headers = "From: noreply@veyra.com";
    
    // Attempt to send the email and return the result
    return mail($email, $subject, $message, $headers);
}

$error = null;
$success = null;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } else {
        // Check if email exists in the database
        $sql = "SELECT * FROM users WHERE Email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if (mysqli_num_rows($result) == 1) {
                // Email exists, generate and send OTP
                $otp = generateOtp();
                
                // Store in session for verification
                $_SESSION['reset_email'] = $email;
                $_SESSION['reset_otp'] = $otp;
                $_SESSION['reset_otp_time'] = time(); // To check expiration
                
                if (sendOtp($email, $otp)) {
                    // Redirect to OTP verification page
                    header("Location: reset_verify.php");
                    exit();
                } else {
                    $error = "Failed to send verification email. Please try again.";
                }
            } else {
                // Don't reveal that email doesn't exist (security best practice)
                $success = "If your email exists in our system, you will receive a reset code shortly.";
            }
        } else {
            $error = "Database error. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEYRA - Forgot Password</title>
    <link rel="stylesheet" href="./output.css">
</head>
<body class="bg-stone-50 min-h-screen">
    <div class="container mx-auto px-4 flex flex-col items-center pt-8 pb-16">
        <!-- Logo -->
        <div class="mb-8 text-4xl font-bold text-stone-700">
            VEYRA
        </div>
        
        <!-- Forgot Password Form Card -->
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h1 class="text-2xl font-semibold mb-6 text-stone-800">Reset Your Password</h1>
            
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

                <p class="text-sm text-stone-600 mb-4">
                    Enter your email address below and we'll send you a verification code to reset your password.
                </p>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium mb-1 text-stone-700">Email address</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           required 
                           class="w-full p-2 border border-stone-200 rounded-md focus:border-stone-400 focus:ring-stone-400 focus:outline-none bg-stone-50">
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full bg-stone-700 hover:bg-stone-800 text-white font-medium py-2 px-4 rounded-md transition duration-300 ease-in-out cursor-pointer">
                    Send Reset Code
                </button>
            </form>

            <hr class="my-6 border-stone-200">

            <!-- Back to Login -->
            <div class="text-center">
                <a href="login.php" 
                   class="text-sm text-stone-600 hover:text-stone-800 hover:underline">
                    Back to Sign In
                </a>
            </div>
        </div>

        <!-- Footer Links -->
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