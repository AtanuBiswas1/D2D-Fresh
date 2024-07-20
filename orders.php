<?php

@include 'config.php';

session_start();

$user_id = (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '');

if($user_id==""){
   header('location:login.php');
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box" style="height:100% ;
   box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;
   background-color: #132a1d;
   ">
      <!-- <p id="deliveryTime" display="none">Order will be placed with in 50 min</p> -->
      <p> Order Id : <span>00<?= $fetch_orders['id'];echo(date("d")); ?></span> </p>
      <p> Vrification Id: <span><?= $fetch_orders['id'];echo(date("d")); ?><?= $fetch_orders['id']; ?></span> </p>
      <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
      <p> address : <br><span><?= $fetch_orders['address']; ?></span> </p>
      <p> payment method : <span><?= $fetch_orders['method']; ?></span> </p>
      <p> your orders : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> total price : <span>₹<?= $fetch_orders['total_price']; ?>/-</span> </p>
      <p> payment method : <span style="color:green"><?= $fetch_orders['method']; ?></span> </p>
      <p> Order Delivery : <span id="orderStatus" style="color:<?php if($fetch_orders['orderstatus'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['orderstatus']; ?></span> </p>
      
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no orders placed yet!</p>';
   }
   ?>

   </div>

</section>









<?php include 'footer.php'; ?>

<!-- <script src="js/script.js"></script>
<script>
   const Allorder=document.querySelectorAll("box-container")
   console.log(Allorder);
   //Allorder.foreach((e)=>{
      const deliveryTime=document.getElementById("deliveryTime")
  const orderStatus=document.getElementById("orderStatus")
//   console.log(deliveryTime.textContent,orderStatus.textContent)
  if(orderStatus.textContent=="pending"){
   deliveryTime.style.display="block"
  }else if(orderStatus.textContent=="completed"){
    deliveryTime.style.display="none"
  }
   //})
  
</script> -->

</body>
</html>