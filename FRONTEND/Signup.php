<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Amazon Registration</title>
  <link rel="stylesheet" href="./output.css">
</head>
<body class=" bg-gray-100 min-h-screen">
  <div class="flex flex-col items-center pt-8 pb-16">
    <!-- Amazon Logo -->
    <div class="mb-4">
        LOGO
    </div>
    
    <!-- Registration Form Card -->
    <div class=" bg-white p-6 rounded shadow-md w-full max-w-md border border-gray-300">
      <h1 class="text-2xl font-normal mb-1">Create Account</h1>
      <p class="text-sm mb-4">All fields are required</p>
      
      <form>
        <!-- Name Field -->
        <div class=" mb-4">
          <label for="name" class=" block text-sm font-medium mb-1">Your name</label>
          <input type="text" id="name" placeholder="First and last name" class="w-full p-2 border border-gray-300 rounded focus:border-yellow-500 focus:ring-yellow-500 focus:outline-none">
        </div>
        
        <!-- Mobile Number Field -->
        <div class="mb-4">
          <label for="mobile" class="block text-sm font-medium mb-1">Mobile number</label>
          <div class="flex">
            <div class="relative inline-block mr-2 w-1/4">
              <select class="appearance-none bg-gray-100 border border-gray-300 text-gray-700 py-4 px-3 pr-8 rounded-l leading-tight focus:outline-none focus:border-yellow-500 w-full">
                <option>IN +91</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                </svg>
              </div>
            </div>
            <input type="tel" id="mobile" placeholder="Mobile number" class=" w-3/4 p-2 border border-gray-300 rounded-r focus:border-yellow-500 focus:ring-yellow-500 focus:outline-none">
          </div>
        </div>
        
        <!-- Password Field -->
        <div class="mb-2">
          <label for="password" class="block text-sm font-medium mb-1">Password</label>
          <input type="password" id="password" placeholder="At least 6 characters" class="w-full p-2 border border-gray-300 rounded focus:border-yellow-500 focus:ring-yellow-500 focus:outline-none">
        </div>
        
        <!-- Password Hint -->
        <div class="flex items-start mb-4">
          <div class="flex-shrink-0 mt-0.5">
            <svg class="h-5 w-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd"></path>
            </svg>
          </div>
          <p class="ml-2 text-xs text-gray-600">Passwords must be at least 6 characters.</p>
        </div>
        
        <!-- Verification Message -->
        <div class="text-sm mb-4">
          <p>To verify your number, we will send you a text message with a temporary code. Message and data rates may apply.</p>
        </div>
        
        <!-- Verify Button -->
        <button type="button" class="w-full bg-yellow-400 hover:bg-yellow-500 text-sm py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 mb-6">
          Verify mobile number
        </button>
        
        <hr class="mb-6">
        

        <!-- Sign In Link -->
        <div class="mb-4">
          <p class="text-sm">Already have an account? <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Sign in ›</a></p>
        </div>
        
        <!-- Terms and Conditions -->
        <div class="text-xs">
          <p>By creating an account or logging in, you agree to Amazon's <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Conditions of Use</a> and <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Privacy Policy</a>.</p>
        </div>
      </form>
    </div>
    
    <!-- Footer -->
    <div class="mt-6 text-xs text-center">
      <div class="flex justify-center space-x-4 mb-2">
        <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Conditions of Use</a>
        <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Privacy Notice</a>
        <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Help</a>
      </div>
      <p class="text-gray-600">© 1996-2025, Amazon.com, Inc. or its affiliates</p>
    </div>
  </div>

  <script>
    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const name = document.getElementById('name').value;
      const mobile = document.getElementById('mobile').value;
      const password = document.getElementById('password').value;
      
      let isValid = true;
      let errorMessage = '';
      
      if (!name) {
        isValid = false;
        errorMessage += 'Name is required.\n';
      }
      
      if (!mobile) {
        isValid = false;
        errorMessage += 'Mobile number is required.\n';
      }
      
      if (!password || password.length < 6) {
        isValid = false;
        errorMessage += 'Password must be at least 6 characters.\n';
      }
      
      if (isValid) {
        alert('Form submitted successfully! Verification code would be sent to your mobile.');
      } else {
        alert(errorMessage);
      }
    });
    
    // Verify mobile number button action
    document.querySelector('button').addEventListener('click', function() {
      const mobile = document.getElementById('mobile').value;
      
      if (!mobile) {
        alert('Please enter a mobile number.');
      } else {
        alert('Verification code sent to ' + mobile);
      }
    });
  </script>
</body>
</html>