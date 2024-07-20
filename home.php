<?php

@include 'config.php';

session_start();

// $user_id = $_SESSION['user_id'];
$user_id = (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '');

// if(!isset($user_id)){
//    header('location:login.php');
// };

if($user_id!==""){
   if(isset($_POST['add_to_wishlist'])){

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $p_name = $_POST['p_name'];
      $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
      $p_price = $_POST['p_price'];
      $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
      $p_image = $_POST['p_image'];
      $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   
      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);
   
      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$p_name, $user_id]);
   
      if($check_wishlist_numbers->rowCount() > 0){
         $message[] = 'already added to wishlist!';
      }elseif($check_cart_numbers->rowCount() > 0){
         $message[] = 'already added to cart!';
      }else{
         $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
         $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
         $message[] = 'added to wishlist!';
      }
   
   }




   if(isset($_POST['add_to_cart'])){

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $p_name = $_POST['p_name'];
      $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
      $p_price = $_POST['p_price'];
      $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
      $p_image = $_POST['p_image'];
      $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
      $p_qty = $_POST['p_qty'];
      $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);
   
      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$p_name, $user_id]);
   
      if($check_cart_numbers->rowCount() > 0){
         $message[] = 'already added to cart!';
      }else{
   
         $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
         $check_wishlist_numbers->execute([$p_name, $user_id]);
   
         if($check_wishlist_numbers->rowCount() > 0){
            $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
            $delete_wishlist->execute([$p_name, $user_id]);
         }
   
         $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
         $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
         $message[] = 'added to cart!';
      }
   
   }
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home Page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>


<div class="home-bg" style="    box-shadow: rgb(62 100 106 / 71%) 0px 54px 55px, rgb(215 52 52) 0px -12px 30px, rgb(177 26 193 / 93%) 0px 4px 6px, rgb(6 241 167) 0px 12px 13px, rgb(16 126 193 / 90%) 0px -3px 5px;">

   <section class="home">

      <div class="content">
         <span>Don't panic, go organice</span>
         <h3>Reach For A Healthier You With Organic Foods</h3>
         <h2>"Customer service shouldn't just be a department, it should be the entire company."</h2>
         <a href="about.php" class="btn">about us</a>
      </div>

   </section>

</div>
<marquee behavior="alternate" direction="">
<div style="font-size:2rem;color :blue;text-align:center;margin-top:2rem "> " Now, order delivery and shopping options are available only for <span style="font-size:2.7rem;color:green">Medinipore town</span> with the pin code:<span style="font-size:2rem;color:green"> 721101 ,721102,721129 and 721436 </span>"</div>
</marquee>

<section class="home-category">

   <h1 class="title">shop by category</h1>

   <div class="box-container">

      <div class="box" style="
      border-radius: 2.5rem;border:0px;
      /* box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px; */
      box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;
      ">
         <img src="images/cat-1.png" alt="">
         <h3>Fruits</h3>
         <p style="margin-bottom: 4.2rem;">A beautiful bowl/basket of happiness.A multi-flavored, colorful way to good health.</p>
         <a href="category.php?category=fruits" class="btn"
          style="border-radius: 2rem;
         box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;"
         >fruits</a>
      </div>

      <div class="box"
      style="
      border-radius: 2.5rem;border:0px;
      /* box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px; */
      box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;
      "
      >
         <img src="images/cat-2.png" alt="">
         <h3>Meat</h3>
         <p style="margin-bottom: 6.9rem;">Go for fresh and hygiene. and gain lots of Protein</p>
         <a href="category.php?category=meat" class="btn"
          style="border-radius: 2rem;
         box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;"
         >meat</a>
      </div>

      <div class="box"
      style="
      border-radius: 2.5rem;border:0px;
      box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;
      "
      >
         <img src="images/cat-3.png" alt="">
         <h3>Vegitables</h3>
         <p  style="margin-bottom: 6.9rem;">Everyday Takes Fresh To Ensure Your Health Green</p>
         <a href="category.php?category=vegitables" class="btn"
          style="border-radius: 2rem;
         box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;"
         >vegitables</a>
      </div>

      <div class="box"
      style="
      border-radius: 2.5rem;border:0px;
      box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;
      "
      >
         <img src="images/cat-4.png" alt="">
         <h3>Fish</h3>
         <p>Fresh and Sustainable: Premium Quality Fish for Your Culinary Delights. Shop Now for the Finest Catch</p>
         <a href="category.php?category=fish" class="btn"
          style="border-radius: 2rem;
         box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;"
         >fish</a>
      </div>

      <div class="box"
      style="
      border-radius: 2.5rem;border:0px;
      box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;
      "
      >
         <img src="images/cart-5.png" alt="">
         <h3>grocery</h3>
         <p>This website allows users to buy groceries online which are needed in day to day life</p>
         <a href="category.php?category=grocery" class="btn"
          style="border-radius: 2rem;
         box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;"
         >grocery</a>
      </div>

      <div class="box"
      style="
      border-radius: 2.5rem;border:0px;
      box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;
      "
      >
         <img src="images/cat-6.png" alt="">
         <h3>soft drinks</h3>
         <p>"Customer service shouldn't just be a department, it should be the entire company."</p>
         <a href="category.php?category=soft drinks" class="btn"
         style="border-radius: 2rem;
         box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;"
         >soft drinks</a>
      </div>
   </div>

</section>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST" style="height:90%;
   
      border-radius: 2.5rem;border:0px;
      /* box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px; */
      box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;
      "
   >


      <div class="price" 
      style="box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;">
         ₹<span><?= $fetch_products['price']; ?></span>/-</div>
      <a style="box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;border:0px"
       href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
      
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="" style="height:40%;">
      
      <div class="name"><?= $fetch_products['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
      <input style="border:0px;box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;border-radius:20px"
       type="number" min="1" value="1" name="p_qty" class="qty"
       style="border-radius: 2rem;
         box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;
         
         "
      >
      <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist"
       style="border-radius: 2rem;
         /* box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset; */
         box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;
         "
      >
      <input type="submit" value="add to cart" class="btn" name="add_to_cart"
       style="border-radius: 2rem;
         /* box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset; */
         box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;
         "
      >
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

   </div>

</section>







<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>