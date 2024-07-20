<?php
$dboy_id = (isset($_SESSION['dboy_id']) ? $_SESSION['dboy_id'] : '');



if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>

<header class="header">

   <div class="flex">

      <a href="deliveryBoy.php" class="logo">Delivery<span>Panel</span></a>

      <nav class="navbar">
         <a href="deliveryBoy.php">Home</a>
         <a href="deliveryBoyOrder.php">My Order</a>
         
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
      <?php
         if($dboy_id!=""){
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$dboy_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
         <p><?= $fetch_profile['name']; ?></p>
         <a href="delivery_update_profile.php" class="btn">update profile</a>
         <a href="admin_logout.php" class="delete-btn">logout</a>
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