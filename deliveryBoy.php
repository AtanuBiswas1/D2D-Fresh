<?php

@include 'config.php';

session_start();

$dboy_id = (isset($_SESSION['dboy_id']) ? $_SESSION['dboy_id'] : '');


if($dboy_id==""){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Delivery Boy Order</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'deliveryBoy_header.php'; ?>

<section class="dashboard">

   <h1 class="title">dashboard</h1>

   <div class="box-container">

      <div class="box">
      <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT count(id) as pending FROM `orders` WHERE orderstatus = ? and assign_dboy = ? ");
         $select_pendings->execute(['pending', $dboy_id]);
         while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
			 //print($total_pendings);
            $total_pendings = $fetch_pendings['pending'];
         };
      ?>
      <h3><?= $total_pendings; ?></h3>
      <p>Pending Orders</p>
      
      </div>

      <div class="box">
      <?php
         $total_completed = 0;
         $select_completed = $conn->prepare("SELECT count(id) as completed FROM `orders` WHERE orderstatus = ? and assign_dboy = ? ");
         $select_completed->execute(['completed', $dboy_id]);
         while($fetch_completed = $select_completed->fetch(PDO::FETCH_ASSOC)){
			  //print($fetch_completed['completed']);
            $total_completed = $fetch_completed['completed'];
         };
      ?>
      <h3><?= $total_completed; ?></h3>
      <p>Completed Orders</p>
      </div>

      <div class="box">
      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE assign_dboy = ?");
         $select_orders->execute([$dboy_id]);
         $number_of_orders = $select_orders->rowCount();
      ?>
      <h3><?= $number_of_orders; ?></h3>
      <p>Total Orders</p>
      </div>

      

      

   </div>

</section>













<script src="js/script.js"></script>

</body>
</html>