<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $Password = $_POST['Password'];
    
        include '../Backend/config.php';
    
        $sql = "Select * from users where Email = '$email' AND password = '$Password'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num == 1) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header("location: index.php");

        } else {    
            echo "Login Failed";
        }
    }
    ?>
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magic Moments - Sign In</title>
    <link rel="stylesheet" href="./output.css">
</head>
<body class="bg-stone-50 min-h-screen">
    <div class="container mx-auto px-4 flex flex-col items-center pt-8 pb-16">
        <!-- Logo -->
        <div class="mb-8 text-4xl font-bold text-stone-700">
            MAGIC MOMENTS
        </div>
        
        <!-- Login Form Card -->
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h1 class="text-2xl font-semibold mb-6 text-stone-800">Sign In</h1>
            
            <form method="post" class="space-y-6">
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium mb-1 text-stone-700">Email address</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           required 
                           class="w-full p-2 border border-stone-200 rounded-md focus:border-stone-400 focus:ring-stone-400 focus:outline-none bg-stone-50">
                </div>

                <!-- Password Field -->
                <div>
                    <label for="Password" class="block text-sm font-medium mb-1 text-stone-700">Password</label>
                    <input type="password" 
                           id="Password" 
                           name="Password" 
                           required 
                           class="w-full p-2 border border-stone-200 rounded-md focus:border-stone-400 focus:ring-stone-400 focus:outline-none bg-stone-50">
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full bg-stone-700 hover:bg-stone-800 text-white font-medium py-2 px-4 rounded-md transition duration-300 ease-in-out cursor-pointer">
                    Sign In
                </button>
            </form>

            <!-- Forgot Password -->
            <div class="mt-4">
                <a href="#" class="text-sm text-stone-600 hover:text-stone-800 hover:underline">
                    Forgot your password?
                </a>
            </div>

            <hr class="my-6 border-stone-200">

            <!-- Create Account Section -->
            <div class="text-center">
                <p class="text-sm text-stone-600 mb-4">New to Magic Moments?</p>
                <a href="Signup.php" 
                   class="block w-full py-2 px-4 border border-stone-300 text-stone-700 rounded-md hover:bg-stone-50 transition duration-300 ease-in-out text-sm text-center">
                    Create your account
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
                © 2025 Magic Moments. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>