<?php

@include 'config.php';

session_start();

$user_id = (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '');

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="about">

   <div class="row">

      <div class="box">
         <img src="images/about-img-1.png" alt="">
         <h3>why choose us?</h3>
         <p style="text-align: justify;">At D2D Fresh, we are committed to bringing you the freshest vegetables and a complete grocery selection tailored to your needs. Our produce is sourced daily from trusted local farmers, ensuring that only the best, most flavorful items reach your table. We offer a seamless online shopping experience with user-friendly navigation and prompt, reliable delivery services. Our dedicated customer support team is always here to assist you, making your shopping experience hassle-free. Choose us for exceptional quality, freshness, and the convenience of getting all your essentials delivered right to your doorstep.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

      <div class="box">
         <img src="images/about-img-2.png" alt="">
         <h3>what we provide?</h3>
         <p style="text-align: justify;">At D2D Fresh, we are committed to delivering freshness right to your doorstep. Our website offers an extensive range of high-quality groceries and farm-fresh vegetables, carefully selected to ensure you enjoy vibrant, nutritious meals every day. From organic produce to essential pantry staples, everything you need is just a click away. We pride ourselves on our swift and reliable delivery service, ensuring that all items reach you in perfect condition. Experience convenience, quality, and freshness with us, 
         making your everyday cooking and shopping an absolute breeze.</p>
         <a href="shop.php" class="btn">our shop</a>
      </div>

   </div>

</section>

<!-- <section class="reviews">

   <h1 class="title">clients reivews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/picture.png" alt="">
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/picture.png" alt="">
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/picture.png" alt="">
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/picture.png" alt="">
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/picture.png" alt="">
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/picture.png" alt="">
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

   </div>

</section> -->

<section class="reviews">

   <h1 class="title">Our Teams</h1>

   <div class="box-container">

      <div class="box" 
      style="border:0px;
      box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;
      background:
      "
      >
         <div>
         <img src="TeamImage/Abhratanu.jpeg" alt="" style="box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;">
         </div>
         <div>
         <h3 style="color:#0b5246;">Abhratanu Mandal</h3>
         <p style="color:#052424;padding:0px">
            M.Sc. in Computer Science
         </p>
         <p style="color:#052424;padding:0px">Midnapore City College</p>
         </div>
      </div>
       

      <div class="box"  style="border:0px;
      box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;
      background:
      ">
         <div>
         <img src="TeamImage/Atanu.png" alt=""
         style="box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;"
         >
         </div>
         <div>
         <h3
         style="color:#0b5246;"
         >Atanu Biswas</h3>
         <p  style="color:#052424;padding:0px">
            M.Sc. in Computer Science
         </p>
         <p style="color:#052424;padding:0px">Midnapore City College</p>
         </div>
      </div>

      <div class="box" 
      style="border:0px;
      box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;
      background:
      "
      >
         <div>
         <img src="TeamImage/ishita.jpeg" alt="" style="box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;">
         </div>
         <div>
         <h3 style="color:#0b5246;">Ishita Ghosh</h3>
         <p style="color:#052424;padding:0px">
            M.Sc. in Computer Science
         </p>
         <p style="color:#052424;padding:0px">Midnapore City College</p>
         </div>
      </div>

      <div class="box" 
      style="border:0px;
      box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;
      background:
      "
      >
         <div>
         <img src="TeamImage/moumita.jpg" alt="" style="box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;">
         </div>
         <div>
         <h3 style="color:#0b5246;">Moumita Santra</h3>
         <p style="color:#052424;padding:0px">
            M.Sc. in Computer Science
         </p>
         <p style="color:#052424;padding:0px">Midnapore City College</p>
         </div>
      </div>

      <div class="box" 
      style="border:0px;
      box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;
      background:
      "
      >
         <div>
         <img src="TeamImage/soumen.jpeg" alt="" style="box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;">
         </div>
         <div>
         <h3 style="color:#0b5246;">Soumen De</h3>
         <p style="color:#052424;padding:0px">
            M.Sc. in Computer Science
         </p>
         <p style="color:#052424;padding:0px">Midnapore City College</p>
         </div>
      </div>

      <div class="box" 
      style="border:0px;
      box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;
      background:
      "
      >
         <div>
         <img src="TeamImage/Devid.jpg" alt="" style="box-shadow: rgb(16 243 213) 0px 2px 4px 0px, rgba(1, 30, 37, 3.32) 10px 12px 16px 2px;">
         </div>
         <div>
         <h3 style="color:#0b5246;">Soumen Debsharma</h3>
         <p style="color:#052424;padding:0px">
            M.Sc. in Computer Science
         </p>
         <p style="color:#052424;padding:0px">Midnapore City College</p>
         </div>
      </div>



      <!-- <div class="box">
         <img src="images/picture.png" alt="">
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/picture.png" alt="">
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/picture.png" alt="">
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/picture.png" alt="">
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/picture.png" alt="">
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div> -->

   </div>

</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>