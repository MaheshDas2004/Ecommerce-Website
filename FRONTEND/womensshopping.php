<?php
  include '../BACKEND/config.php';
  $sql = "SELECT id, title, price, description, category, image, rating_rate, rating_count FROM products WHERE category = 'women\'s clothing'";
$result = mysqli_query($conn, $sql);

// Store results in an array
$womenproducts = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $womenproducts[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEYRA - Shop</title>
    <link rel="stylesheet" href="./output.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50">
    
<section class="container mx-auto px-2 sm:px-4 py-6 sm:py-12">
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
    <!-- Product Card -->
    <?php foreach ($womenproducts as $womenproduct) { ?>
    <div class="group  border-2 border-rose-50 shadow-lg rounded-lg overflow-hidden">
      <div class="relative">
        <!-- Product Image Container with Fixed Height -->
        <div class="relative aspect-[4/3] sm:aspect-[6/5]">
          <img alt="<?php echo $womenproduct['title']; ?>" 
               class="object-contain object-center w-full h-full absolute inset-0 border-b-2 border-rose-700" 
               src="<?php echo $womenproduct['image']; ?>">
          
          <!-- Hover Elements -->
          <div class="absolute inset-0 bg-black/5 flex flex-col justify-between opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <!-- Cart Icon Top Right -->
            <div class="flex justify-end p-2 sm:p-4">
              <button class="bg-white rounded-full p-2 sm:p-3 cursor-pointer hover:bg-stone-50 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
              </button>
            </div>
            
            <!-- Quick Shop Button Bottom -->
            <div class="absolute bottom-0 left-0 right-0 bg-white bg-opacity-95 py-2 sm:py-4 px-3 sm:px-6 transform translate-y group-hover:translate-y-0 transition-transform duration-300">
              <button class="w-full bg-black text-white py-2 sm:py-3 px-4 text-sm sm:text-base font-medium hover:bg-gray-800 transition-colors tracking-wider uppercase rounded">
                Quick Shop
              </button>
            </div>
          </div>
        </div>
        
        <!-- Product Info -->
        <div class="p-4 text-center">
          <h2 class="text-gray-900 text-lg sm:text-xl font-medium mb-1 sm:mb-2 line-clamp-2">
            <?php echo $womenproduct['title']; ?>
          </h2>
          <p class="text-gray-700 font-semibold">
            $<?php echo number_format($womenproduct['price'], 2); ?>
          </p>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</section>

</body>
</html>