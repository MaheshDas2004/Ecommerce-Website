<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEYRA</title>
    <link rel="stylesheet" href="./output.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div id="content" class="mt-5"> <!-- Add margin-top to account for fixed navbar -->
        <?php 
        $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
        
        switch($page) {
            case 'cart':
                include 'cart.php';
                break;
            case 'men':
                include 'MEN.php';
                break;
            case 'women':
                include 'womensshopping.php';
                break;
            case 'accessories':
                include 'accessories.php';
                break;
            case 'shop':
                include 'shop.php';
                break;
            case 'contact':
                include 'contact.php';
                break;
            case 'profile':
                include 'profile.php';
                break;
            default:
                include 'dashboard.php';
                break;
        }
        ?>
    </div>
    <?php include 'footer.php'; ?>

</body>
</html>