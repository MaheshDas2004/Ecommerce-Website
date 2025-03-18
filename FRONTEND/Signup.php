<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./FRONTEND/output.css">
</head>
<body class=" m-0 p-0 box-border h-screen w-screen flex justify-center items-center bg-gray-100">
    <div class="w-1/3 bg-white p-4 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-center">Signup</h1>
        <form action="../BACKEND/signup.php" method="POST" class="flex flex-col gap-4 mt-4">
            <input type="text" name="username" placeholder="Username" class="p-2 border border-gray-300 rounded-lg">
            <input type="password" name="password" placeholder="Password" class="p-2 border border-gray-300 rounded-lg">
            <input type="submit" value="Signup" class="p-2 bg-blue-500 text-white rounded-lg cursor-pointer">
        </form>
    </div>
    
</body>
</html>