<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $Password = $_POST['Password'];

    include '../Backend/config.php';

    $sql = "INSERT INTO `users` (`Name`, `Email`, `password`, `dt`) VALUES ('$name', '$email', '$Password', current_timestamp())";
    if(!mysqli_query($conn, $sql)) {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magic Moments - Sign Up</title>
    <link rel="stylesheet" href="./output.css">
</head>
<body class="bg-stone-50 min-h-screen">
    <div class="flex flex-col items-center pt-8 pb-16">
        <!-- Logo -->
        <div class="mb-4 text-4xl font-bold text-stone-700">
            MAGIC MOMENTS
        </div>
        
        <!-- Registration Form Card -->
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h1 class="text-2xl font-semibold mb-1 text-stone-800">Create Account</h1>
            <p class="text-sm mb-6 text-stone-600">All fields are required</p>
            
            <form method="post">
                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium mb-1 text-stone-700">Your name</label>
                    <input type="text" id="name" name="name" placeholder="First and last name" required
                        class="w-full p-2 border border-stone-200 rounded-md focus:border-stone-400 focus:ring-stone-400 focus:outline-none bg-stone-50">
                </div>
                
                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-1 text-stone-700">Email address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required 
                        class="w-full p-2 border border-stone-200 rounded-md focus:border-stone-400 focus:ring-stone-400 focus:outline-none bg-stone-50">
                </div>
                
                <!-- Password Field -->
                <div class="mb-2">
                    <label for="Password" class="block text-sm font-medium mb-1 text-stone-700">Password</label>
                    <input type="password" id="Password" placeholder="At least 6 characters" class="w-full p-2 border border-stone-200 rounded-md focus:border-stone-400 focus:ring-stone-400 focus:outline-none bg-stone-50" name="Password" required>
                </div>
                
                <!-- Password Hint -->
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="ml-2 text-xs text-stone-600">Passwords must be at least 6 characters.</p>
                </div>
                
                <!-- Sign Up Button -->
                <button type="submit" 
                    class="w-full bg-stone-700 hover:bg-stone-800 text-white font-medium py-2 px-4 rounded-md transition duration-300 ease-in-out mb-6">
                    Create your account
                </button>
                
                <hr class="mb-6 border-stone-200">
                
                <!-- Sign In Link -->
                <div class="text-center mb-4">
                    <p class="text-sm text-stone-600">
                        Already have an account? 
                        <a href="login.php" class="text-stone-700 hover:text-stone-900 hover:underline">Sign in</a>
                    </p>
                </div>
                <!-- Terms and Conditions -->
                <div class="text-xs text-stone-500 text-center">
                    <p>By creating an account, you agree to Magic Moments' 
                        <a href="#" class="text-stone-700 hover:text-stone-900 hover:underline">Conditions of Use</a> and 
                        <a href="#" class="text-stone-700 hover:text-stone-900 hover:underline">Privacy Policy</a>.
                    </p>
                </div>
            </form>
        </div>
    </div>


</body>
</html>