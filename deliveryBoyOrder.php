<?php

@include 'config.php';

session_start();

$dboy_id = (isset($_SESSION['dboy_id']) ? $_SESSION['dboy_id'] : '');

if($dboy_id==""){
   header('location:login.php');
}

if(isset($_POST['update_order_status'])){

   $order_id = $_POST['order_id'];
   $update_order = $_POST['order_status'];
   $update_order = filter_var($update_order, FILTER_SANITIZE_STRING);
   $update_orders = $conn->prepare("UPDATE `orders` SET orderstatus = ? WHERE id = ?");
   $update_orders->execute([$update_order, $order_id]);
   $message[] = 'Order status has been updated!';

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
   <title>Delivery Boy Order</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'deliveryBoy_header.php'; ?>

<section class="placed-orders">

   <h1 class="title">My Orders</h1>
   <div style="display:flex;width:100%;">
   <div class="box-container" style="width:100%;justify-content:start">

<?php
   $select_orders = $conn->prepare("SELECT * FROM `orders` where assign_dboy = ".$dboy_id);
   $select_orders->execute();
   if($select_orders->rowCount() > 0){
      while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
?>
 <div class="box" >
   <!-- style="height:100%" -->
    
   <div>
      <!--  style="height:80%" -->
       <p> order id : <span>00<?= $fetch_orders['id']; echo(date("d"));?></span> </p>
       <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
       <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
       <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
       <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
       <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
       <p> total products : <span><?= $fetch_orders['total_products']; ?></span> </p>
       <p> total price : <span>Rs.<?= $fetch_orders['total_price']; ?>/-</span> </p>
       <p> payment method : <span><?= $fetch_orders['method']; ?></span> </p>
	   <p> Order Delivery : <span id="orderStatus" style="color:<?php if($fetch_orders['orderstatus'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['orderstatus']; ?></span> </p>
      
   </div>
   <form action="" method="POST" >
      <!-- style="height:20%" -->
      <!-- <input type="number" value="" placeholder="enter order user id" require  
      style="
    width: 100%;
    height: 30px;
    margin: 1rem 0rem;
    padding: 4px;
    border-radius: 10px;
    border: 1px solid black;
"
    id="confirmVerificationinput"
      > -->
      <p style="display:none"> Vrification Id: <span id="verificationno"><?= $fetch_orders['id'];echo(date("d")); ?><?= $fetch_orders['id']; ?></span> </p>
      <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
      <select name="order_status" class="drop-down" id="order_status" >
         <!-- style="display:none" -->
         <option value="" selected disabled><?=  $fetch_orders['orderstatus']; ?></option>
         <option value="pending">pending</option>
         <option value="completed">completed</option>
      </select>
      <div class="flex-btn">
         <input type="submit" name="update_order_status" class="option-btn" value="update" id="update" >
         
      </div>
      
   </form>
   <!-- <section style="padding: 0rem;">
     <select name="" class="drop-down" >
         <option value="">Select Deliery Boy</option>
         <option value="deliveryBoy1">deliveryBoy1</option>
         <option value="deliveryBoy2">deliveryBoy2</option>
         <option value="deliveryBoy3">deliveryBoy3</option>
         <option value="deliveryBoy4">deliveryBoy4</option>
         
      </select>
     </section> -->
   
      
 </div>
<?php
   }
}else{
   echo '<p class="empty">no orders received yet!</p>';
}
?>

   </div>
   <!-- <div class="right-side" style="width:30%;position:fixed;right:2.5rem;top:15%;overflow-y: scroll;height:100vh">
      <div style="width:100%;height:100%;padding:3px;overflow-y: auto;">
      <div  class="deliveryBoy">Delivery Boy 1 
            <span class="optionfree">Avalable</span>
            <div class="deliveryCount ">Delivery: 2</div>
      </div>
      <div class="deliveryBoy">Delivery Boy 1
         <span class="optionfree">Avalable</span>
         <div class="deliveryCount ">Delivery: 2</div>
      </div>
      <div class="deliveryBoy">Delivery Boy 1
         <span class="optionfree">Avalable</span>
         <div class="deliveryCount ">Delivery: 2</div>
      </div>
      <div class="deliveryBoy">Delivery Boy 1
         <span class="optionfree">Avalable</span>
         <div class="deliveryCount ">Delivery: 2</div>
      </div>
      

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
            margin-left:1.7rem;
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

   </sstyle> -->

</section>












<script src="js/script.js"></script>

<!-- <script>


   document.getElementById('confirmVerificationinput').addEventListener('input', function(event) {
      const confirmation = event.target.value;
      const verificationno=document.getElementById("verificationno")
      const OrderStatus=document.getElementById("order_status")
      const update= document.getElementById("update")
       console.log(update)
       console.log("huu");
      if(confirmation===verificationno.textContent){
         OrderStatus.style.display="block"
         update.disabled = false;
      }
      
      
      update.addEventListener("click",(e)=>{
         e.style.display="block"
      })
   })
</script> -->

</body>
</html>