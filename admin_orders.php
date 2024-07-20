<?php

@include 'config.php';

session_start();

$admin_id = (isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : '');

if($admin_id==""){
   header('location:login.php');
}

//if(isset($_POST['update_order'])){
  // $order_id = $_POST['order_id'];
 //  $update_payment = $_POST['update_payment'];
 //  $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);
 //  $update_orders = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
 //  $update_orders->execute([$update_payment, $order_id]);
//$message[] = 'payment has been updated!';

//};

if(isset($_POST['update_order_status'])){

   $order_id = $_POST['order_id'];
   $update_order = $_POST['order_status'];
   $update_order = filter_var($update_order, FILTER_SANITIZE_STRING);
   $update_orders = $conn->prepare("UPDATE `orders` SET orderstatus = ? WHERE id = ?");
   $update_orders->execute([$update_order, $order_id]);
   $message[] = 'Order status has been updated!';

};

if(isset($_POST['update_dboy'])){
	$order_id = $_POST['order_id'];
   $dboy_id = $_POST['dboy_id'];
   $update_users = $conn->prepare("UPDATE `orders` SET assign_dboy = ? WHERE id = ?");
   $update_users->execute([$dboy_id, $order_id]);
   $message[] = 'Delivery Boy has been Assigned!';

};


if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_orders->execute([$delete_id]);
   header('location:admin_orders.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin orders page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>
   <div style="display:flex;width:70%;">
   <div class="box-container" style="width:100%;justify-content:start">

<?php
   $select_orders = $conn->prepare("SELECT * FROM orders"); //SELECT * FROM `users` left join orders on users.id=orders.user_id;
   $select_orders->execute();
   if($select_orders->rowCount() > 0){
      while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
?>
 <div class="box" style="height:100%">
    
   <div >
      <!-- style="height:70%" -->
       <p> user id : <span><?= $fetch_orders['user_id']; ?></span> </p>
       <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
       <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
       <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
       <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
       <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
       <p> total products : <span><?= $fetch_orders['total_products']; ?></span> </p>
       <p> total price : <span>Rs.<?= $fetch_orders['total_price']; ?>/-</span> </p>
       <p> payment method : <span><?= $fetch_orders['method']; ?></span> </p>
	   <p> Order Status : <span><?= $fetch_orders['orderstatus']; ?></span> </p>
	   <!--<p> Assigned Dboy : <span><?= $fetch_orders['orderstatus']; ?></span> </p> !-->
   
   </div>
   
    <form action="" method="POST" >
      <!-- style="height:20%" -->
      <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
      <select name="order_status" class="drop-down">
         <option value="" selected disabled><?=  $fetch_orders['orderstatus']; ?></option>
         <option value="pending">pending</option>
         <option value="completed">completed</option>
      </select>
      <div class="flex-btn">
         <input type="submit" name="update_order_status" class="option-btn" value="update">
         <a href="admin_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
      </div>
      
   </form>
   
 <!--  <form action="" method="POST" style="height:20%">
      <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
      <select name="update_payment" class="drop-down">
         <option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>
         <option value="pending">pending</option>
         <option value="completed">completed</option>
      </select>
      <div class="flex-btn">
         <input type="submit" name="update_order" class="option-btn" value="Update">
         <a href="admin_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
      </div>
      
   </form>
   !-->
   
 <section style="padding: 0rem;">
 <form action="" method="POST" style="height:20%">
 <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
 <div class="flex-btn">
         <?php if($fetch_orders['assign_dboy']=="")
	  { ?>
    <select name="dboy_id" class="drop-down" style="margin-top: 10px;
    height: 48px;">
	<option value="">Select Dboy</option>
<?php 
$select_users = $conn->prepare("SELECT * FROM users where user_type='dboy'"); //SELECT * FROM `users` left join orders on users.id=orders.user_id;
   $select_users->execute();
      if($select_users->rowCount() > 0){
      while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
		  
		  ?>
		      <option value="<?php echo $fetch_users['id'];?>"><?php echo $fetch_users['name'];?></option>
			  
			 <?php }} ?>
      </select>
	  
	  
	  <input type="submit" name="update_dboy" class="option-btn" value="Assign">
	  <?php }else{
		  ?>
		  <input class="delete-btn" value="Delivery Boy Assigned">
		  <?php
	  }?>
      </div>
	  </form>
     </section>
   
      
 </div>
<?php
   }
}else{
   echo '<p class="empty">no orders placed yet!</p>';
}
?>

   </div>
   
   <div class="right-side" style="width:30%;position:fixed;right:2.5rem;top:18%;overflow-y: scroll;height:100vh">
      <div style="width:100%;height:70%;padding:3px;overflow-y: auto;">
      <?php 
$select_users = $conn->prepare("SELECT *, users.name as name FROM users left JOIN orders on orders.assign_dboy=users.id where user_type='dboy' order by users.id ; ");
   $select_users->execute();
      if($select_users->rowCount() > 0){
      while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
		  ?>
        <div  class="deliveryBoy"> 
            <span class="optionfree"><?php echo $fetch_users['name'];?></span>
            <div class="deliveryCount "><?php echo ($fetch_users['orderstatus']=="completed" || $fetch_users['orderstatus'] ==null) ?  "Available": "<span style='background: red;'>Not Available</span>"   ?></div>
      </div>
			 <?php }} ?>
     </div>
      
   </div>
  
   <style>
         .right-side .deliveryBoy{
           background:black;
           margin-top:6px;
           padding:20px;
           font-size:2rem;
           border-radius:12px;
           color:#fff
         } 
         .optionfree{
            color:white;
            padding:12px;
            background:green;
            border-radius:10px;
            
            cursor:pointer;
         }
         .deliveryCount{
            color: white;
            padding: 10px;
            background: green;
            border-radius: 10px;
            margin-top: 1.8rem;
            width: 50%;
         }

   </style>

</section>












<script src="js/script.js"></script>

</body>
</html>