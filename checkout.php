<?php

@include 'config.php';

session_start();

$user_id = (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '');

if($user_id==""){
   header('location:login.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = 'flat no. '. $_POST['flat'] .' '. $_POST['street'] .' '. $_POST['city'] .' '. $_POST['state'] .' '. $_POST['country'] .' - '. $_POST['pin_code'];
   //$address = 'flat no. '. $_POST['flat'] .' '. $_POST['street'] .' '. "Medinipore" .' '. "West Bengal".' '. "India" .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $placed_on = date('d-M-Y');
   

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $cart_query->execute([$user_id]);
   if($cart_query->rowCount() > 0){
      while($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)){
         $cart_products[] = $cart_item['name'].' ( '.$cart_item['quantity'].' )';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      };
   };

   $total_products = implode(', ', $cart_products);

   $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
   $order_query->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }elseif($order_query->rowCount() > 0){
      $message[] = 'order placed already!';
   }else{
      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES(?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on]);
      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);
      $message[] = 'order placed successfully!!!  Order will be delivered within 50 min';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <script src="js/checkout.js" defer></script>
   <link rel="stylesheet" href="css/index.css">

</head>
<body style="background-color: #9eb3bd;">
   
<?php include 'header.php'; ?>
<marquee behavior="alternate" direction="">
<div style="font-size:2rem;color :blue;text-align:center;margin-top:2rem "> " Now, order delivery and shopping options are available only for <span style="font-size:2.7rem;color:green">Medinipore town</span> with the pin code:<span style="font-size:2rem;color:green"> 721101 ,721102,721129 and 721436 </span>"</div>
</marquee>


<div class="abc">

<section class="display-orders">

   <?php
      $cart_grand_total = 0;
      $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart_items->execute([$user_id]);
      if($select_cart_items->rowCount() > 0){
         while($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)){
            $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
            $cart_grand_total += $cart_total_price;
   ?>
   <p style="border-radius: 2.5rem;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;background:#ced58a;"> <?= $fetch_cart_items['name']; ?> <span>(<?= '₹'.$fetch_cart_items['price'].'/- x '. $fetch_cart_items['quantity']; ?>)</span> </p>
   <?php
    }
   }else{
      echo '<p class="empty">your cart is empty!</p>';
   }
   ?>
   <div class="grand-total">grand total : <span>₹<?= $cart_grand_total; ?>/-</span></div>
</section>

<section class="checkout-orders">

   <form action="" method="POST" id="orderPlaceAdressform" 
   style="background-color: #1f394a;
    border-radius: 3.5rem;"

   >

      <h3 style="color:#aab0d1;">place your order</h3>

      <div class="flex">
         <div class="inputBox">
            <span style="color:#d5e1df">your name :</span>
            <input type="text" name="name" placeholder="enter your name" class="box" id="Name" required 
            style="background-color: #e1edec;    border-radius: 2.5rem;    color: #160d0d;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
            >
         </div>
         <div class="inputBox">
            <span style="color:#d5e1df">your number :</span>
            <input type="number" name="number" placeholder="enter your number" class="box" id="Phone" required
            style="background-color: #e1edec;    border-radius: 2.5rem;    color: #160d0d;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
            >
            <div id="validationMessage" ></div>
         </div>
         <div class="inputBox">
            <span style="color:#d5e1df">your email :</span>
            <input type="email" name="email" placeholder="enter your email" class="box" id="Email" required
            style="background-color: #e1edec;    border-radius: 2.5rem;    color: #160d0d;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
            >
         </div>
         
         <div class="inputBox">
            <span style="color:#d5e1df">address line 01 :</span>
            <input type="text" name="flat" placeholder="e.g. flat number" class="box" id="Addressline01" required
            style="background-color: #e1edec;    border-radius: 2.5rem;    color: #160d0d;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
            >
         </div>
         <div class="inputBox">
            <span style="color:#d5e1df">address line 02 :</span>
            <input type="text" name="street" placeholder="e.g. street name" class="box" id="Addressline02" required
            style="background-color: #e1edec;    border-radius: 2.5rem;    color: #160d0d;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
            >
         </div>
         <div class="inputBox">
            <span style="color:#d5e1df">city :</span>
            <!-- <input type="text" name="city" placeholder="e.g. mumbai" class="box" id="City" required> -->
            <!-- <div class="box" name="city" >Medinipore</div> -->
            <select name="city" value="" class="box" id="City" required 
            style="background-color: #e1edec;    border-radius: 2.5rem;    color: #160d0d;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
            >
               <option value="Medinipore">Medinipore</option>
            </select>
         </div>
         <div class="inputBox">
            <span style="color:#d5e1df">state :</span>
            <!-- <input type="text" name="state" placeholder="e.g. maharashtra" class="box" id="State"  required> -->
            <!-- <div class="box" name="state" >West Bengal</div> -->
            <select name="state" value="" class="box" id="State" required
            style="background-color: #e1edec;    border-radius: 2.5rem;    color: #160d0d;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
            >
               <option value="West Bengal">West Bengal</option>
            </select>
         </div>
         <div class="inputBox">
            <span style="color:#d5e1df">country :</span>
            <!-- <input type="text" name="country" placeholder="e.g. India" class="box" id="Country" required> -->
            <!-- <div class="box" name="country" >India</div> -->
            <select name="country" value="" class="box" id="Country" required
            style="background-color: #e1edec;    border-radius: 2.5rem;    color: #160d0d;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
            >
               <option value="India">India</option>
            </select>
         </div>
         <div class="inputBox">
            <span style="color:#d5e1df">pin code :</span>
            <!-- <input type="number" min="0" name="pin_code" placeholder="e.g. 123456" class="box" id="PIN" required> -->
            <select name="pin_code" value="" class="box" id="PIN" required
            style="background-color: #e1edec;    border-radius: 2.5rem;    color: #160d0d;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
            >
               <option value="721101">721101</option>
               <option value="721102">721102</option>
               <option value="721129">721129</option>
               <option value="721436">721436</option>
               
            </select>
         </div>
         
         <div class="btn" id="saveaddressBtn" onclick="saveContact()"
         style="border-radius: 2.5rem;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
         >Save Address for next time</div>
         

         <div class="inputBox">
            <span style="color:#d5e1df">payment method :</span>
            <select name="method" class="box paymentoption" required 
            style="background-color: #e1edec;    border-radius: 2.5rem;    color: #160d0d;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
            >
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">card payment</option>
               <option value="UPI payment">UPI payment</option>
               
            </select>
         </div>
      </div>
      
       
      <input
      style="border-radius: 2.5rem;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
      type="submit" name="order" class="btn <?= ($cart_grand_total > 1)?'':'disabled'; ?>" value="place order" id="paymentUniversalBtn">

   </form>

</section>
</div>
<section >
      <div class="container" style="visibility:hidden;height: 400vh;" id="CardPaymentContainer" >
      
      <form action="" id="CardPaymentForm" 
      style="background: #7694ab;"
      >

        <div class="col"> 
         <div style="text-align:right; cursor:pointer;" class="closeBtn">
         <h2 style="color:red;font-size: 2rem;">close</h2>
         </div>
        
         <h3 class="title" style="color:rgb(15 29 54)">Payment</h3> 
        
         

         <div class="inputBox card"> 
          <label for="name" style="
    font-size: 1.4rem;
    color: #041c22;
"> 
            Card Accepted: 
          </label > 
               <img src="images/1333.png"
                alt="credit/debit card image"> 
         </div> 

          <div class="inputBox"> 
           <label for="cardName" style="
    font-size: 1.4rem;
    color: #041c22;
" > 
            Name On Card: 
           </label> 
             <input type="text" id="cardName"
             placeholder="Enter card name"
             required
             style="background-color: #e1edec;
    border-radius: 2.5rem;
    color: #160d0d;
    box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
             > 
          </div> 

       <div class="inputBox"> 
         <label for="cardNum" style="
    font-size: 1.4rem;
    color: #041c22;
"> 
         Credit Card Number: 
        </label> 
         <input type="number" id="cardNum"
         placeholder="1111-2222-3333-4444"
         maxlength="19" required
        style=" background-color: #e1edec;
    border-radius: 2.5rem;
    color: #160d0d;
    box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
         > 
         <div id="Cardvalidationsms" ></div>
         </div> 


       <div class="inputBox"> 
        <label for="" style="
    font-size: 1.4rem;
    color: #041c22;
">Exp Month:</label> 
         <select name="" id=""
        style=" background-color: #e1edec;
    border-radius: 2.5rem;
    color: #160d0d;
    box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
         > 
         <option value="">Choose month</option> 
         <option value="January">January</option> 
         <option value="February">February</option> 
         <option value="March">March</option> 
         <option value="April">April</option> 
         <option value="May">May</option> 
         <option value="June">June</option> 
         <option value="July">July</option> 
         <option value="August">August</option> 
         <option value="September">September</option> 
         <option value="October">October</option> 
         <option value="November">November</option> 
         <option value="December">December</option> 
        </select> 
         </div> 


               <div class="flex"> 
               <div class="inputBox"> 
                 <label for="" style="
    font-size: 1.4rem;
    color: #041c22;
">Exp Year:</label> 
                <select name="" id=""
               style=" background-color: #e1edec;
    border-radius: 2.5rem;
    color: #160d0d;
    box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
                > 
            <option value="">Choose Year</option> 
             
            <option value="2024">2024</option> 
            <option value="2025">2025</option> 
            <option value="2026">2026</option> 
            <option value="2027">2027</option> 
            <option value="2028">2028</option>
         </select> 
         </div> 

         <div class="inputBox"> 
         <label for="cvv" style="
    font-size: 1.4rem;
    color: #041c22;
">CVV</label> 
         <input type="number" id="cvv"
            placeholder="1234" required
            style="background-color: #e1edec;
    border-radius: 2.5rem;
    color: #160d0d;
    box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
            > 
          </div> 
        </div> 

         </div> 
       <input type="submit" class="btn" id="CardPaymentBtn"
      style=" 
    border-radius: 2.5rem;
    
    box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
       >

      </form>
      
      </div>
      
   </section>
<section>
   <div class="container" id="UPIpaymentSection" style="visibility:hidden">
   <form action="" id="CardPaymentForm">

        <div class="col"> 
         <div style="text-align:right; cursor:pointer;" class="closeBtnUPI" >
         <h2 style="color:red ">close</h2>
         </div>
        
         <h1 class="title">UPI Payment</h1> 
         <div style="width:100%;height:40px ;display: flex;
           align-items: center;
           justify-content: center">
         <img src="images/upiimg.jpg" alt=""  style="width:20%; height:100%;object-fit: cover; ">
         </div>
         
          <div class="inputBox"> 
           <label for="cardName"> 
            <h2>Enter Your UPI : </h2>
           </label> 
             <input type="text" id="cardName"
             placeholder="Enter UPI Id"
             required> 
          </div> 

       <input type="submit" class="btn" id="UPIPaymentBtn">

      </form>
</section>




<section >
<div id="contactsList"></div>
</section>


<?php include 'footer.php'; ?>

<script src="js/script.js" defer></script>

<script>


document.getElementById('Phone').addEventListener('input', function(event) {
  const phoneNo = event.target.value;
  const validationMessage = document.getElementById('validationMessage');
  validationMessage.style.fontSize="1.5rem"
  const validationResults = validatePassword(phoneNo);

  if(validationResults.isValid){
    validationMessage.textContent = 'Mobile no is valid!';
    validationMessage.style.color = 'green';
    document.getElementById("paymentUniversalBtn").disabled = false;
    document.getElementById("CardPaymentBtn").disabled = false;
    document.getElementById("UPIPaymentBtn").disabled = false;
  }else {
    validationMessage.textContent = validationResults.message;
    validationMessage.style.color = 'red';
    document.getElementById("paymentUniversalBtn").disabled = true;
    document.getElementById("CardPaymentBtn").disabled = true; 
    document.getElementById("UPIPaymentBtn").disabled = true; 
  }
})

function validatePassword(phoneNo) {
  const minLength = 10;
  if (phoneNo.length < minLength) {
    return { isValid: false, message: 'Mobile no  not valid.' };
  }
  if (phoneNo.length > minLength || `${phoneNo}`[0]==0) {
    return { isValid: false, message: 'Mobile no  not valid.' };
  }
  return { isValid: true, message: '' };
}

document.getElementById('cardNum').addEventListener('input', function(event) {
  const Cardno = event.target.value;
  const validationMessage = document.getElementById('Cardvalidationsms');
  validationMessage.style.fontSize="1.5rem"
  const validationResults = validateCard(Cardno);

  if(validationResults.isValid){
    validationMessage.textContent = 'Card no is valid!';
    validationMessage.style.color = 'green';
    document.getElementById("paymentUniversalBtn").disabled = false;
    document.getElementById("CardPaymentBtn").disabled = false;
    document.getElementById("UPIPaymentBtn").disabled = false;
  }else {
    validationMessage.textContent = validationResults.message;
    validationMessage.style.color = 'red';
    document.getElementById("paymentUniversalBtn").disabled = true;
    document.getElementById("CardPaymentBtn").disabled = true; 
    document.getElementById("UPIPaymentBtn").disabled = true; 
  }
})

function validateCard(Cardno) {
  const minLength = 12;
  if (Cardno.length < minLength) {
    return { isValid: false, message: 'Card no not valid.' };
  }
  if (Cardno.length > minLength || `${Cardno}`[0]==0) {
    return { isValid: false, message: 'Card no not valid.' };
  }
  return { isValid: true, message: '' };
}



</script>
</body>
</html>