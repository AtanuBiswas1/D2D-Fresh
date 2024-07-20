<?php
$user_id = (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '');

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message" style="background-color: #b5d9e1;ss">
         <span style="color:blue">'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>

<header class="header" style=" background: #dff7f5;
box-shadow: rgb(17 17 243 / 91%) 0px 50px 100px -20px, rgb(14 101 235) 0px 30px 60px -30px, rgb(46 114 12 / 98%) 0px -2px 6px 0px inset;
">

   <div class="flex">

      <a href="home.php" class="logo">D2D Fresh
         <!-- <div style="width:300px;height:50px">
            <img src="images/logo.jpeg" alt="" style="width:100%;height:100%">
         </div> -->
      </a>

      <nav class="navbar">
         <a href="home.php">Home</a>
         <a href="shop.php">Shop</a>
         <a href="orders.php">Orders</a>
         <a href="about.php">About</a>
         <a href="contact.php">Contact</a>
      </nav>
      
      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user">
            
         </div>
         <a href="search_page.php" class="fas fa-search"></a>
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            
         ?>
         <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $count_wishlist_items->rowCount(); ?>)</span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $count_cart_items->rowCount(); ?>)</span></a>
      </div>

      <div class="profile" style="
      box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;
      border:0px;
      ">
         <?php
         if($user_id!=""){
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt=""
         style="box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;"
         >
         <p><?= $fetch_profile['name']; ?></p>
         <a href="user_profile_update.php" class="btn">update profile</a>
         <a href="logout.php" class="delete-btn">logout</a>
         <?php
         }else{
         ?>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
      </div>
         <?php
         };
         ?>
   </div>
   <script src="js/header.js"></script>
</header>