<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = md5($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message[] = 'user email already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert = $conn->prepare("INSERT INTO `users`(name, email, password, image) VALUES(?,?,?,?)");
         $insert->execute([$name, $email, $pass, $image]);

         if($insert){
            if($image_size > 2000000){
               $message[] = 'image size is too large!';
            }else{
               move_uploaded_file($image_tmp_name, $image_folder);
               $message[] = 'registered successfully!';
               header('location:login.php');
            }
         }

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
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/components.css">

</head>
<body style="background-color: #9eb3bd;">
<div style="height: 100px;font-size:2rem;color :blue;text-align:center;margin-top:2rem "> " Now, order delivery and shopping options are available only for <span style="font-size:2.7rem;color:red">Medinipore town</span> with the pin code:<span style="font-size:2rem;color:red"> 721101 ,721102,721129 and 721436 </span>"</div>
<?php

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
   
<section class="form-container">

   <form action="" enctype="multipart/form-data" method="POST"
   style="border-radius: 2.5rem;
    background-color: #1d2428;
    box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
   >
      <h3 style="color:#aab0d1;">register now</h3>
      <input
      style="background-color: #e1edec;
    border-radius: 2.5rem;
    color: #160d0d;
    box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
      type="text" name="name" class="box" placeholder="enter your name" required>
      <input 
      style="background-color: #e1edec;
    border-radius: 2.5rem;
    color: #160d0d;
    box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
      type="email" name="email" class="box" placeholder="enter your email" required>
      <input
      style="background-color: #e1edec;
    border-radius: 2.5rem;
    color: #160d0d;
    box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
      type="password" id="password" name="pass" class="box" placeholder="enter your password" required>
      <div id="validationMessage" ></div>
      <input
      style="background-color: #e1edec;
    border-radius: 2.5rem;
    color: #160d0d;
    box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
      type="password" id="confirmPassword" name="cpass" class="box" placeholder="confirm your password" required>
      <div id="confirmationPasswordMsg"></div>
      <input
      style="background-color: #e1edec;
    border-radius: 2.5rem;
    color: #160d0d;
    box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
      type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png">
      <input
      style="
    border-radius: 2.5rem;
    color: #160d0d;
    box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
      type="submit" id="registration" value="register now" class="btn" name="submit">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</section>

<script>
  document.getElementById('password').addEventListener('input', function(event) {
    const password = event.target.value;
    const validationMessage = document.getElementById('validationMessage');
    validationMessage.style.fontSize="1.5rem"
    const validationResults = validatePassword(password);

    if (validationResults.isValid) {
        validationMessage.textContent = 'Password is valid!';
        validationMessage.style.color = 'green';
        document.getElementById("registration").disabled = false;
        
    } else {
        validationMessage.textContent = validationResults.message;
        validationMessage.style.color = 'red';
        document.getElementById("registration").disabled = true;
        
        
    }
});

document.getElementById('confirmPassword').addEventListener('input', function(event) {
   const confirmPassword = event.target.value;
   const confirmationPasswordMsg = document.getElementById('confirmationPasswordMsg');
   confirmationPasswordMsg.style.fontSize="1.5rem"
   const password=document.getElementById('password').value

   if(password === confirmPassword ){
      confirmationPasswordMsg.textContent = 'Password is valid!';
      confirmationPasswordMsg.style.color = 'green';
        document.getElementById("registration").disabled = false;
   }else{
      confirmationPasswordMsg.textContent = 'Password not matched';
      confirmationPasswordMsg.style.color = 'red';
      document.getElementById("registration").disabled = true;
   }

})


function validatePassword(password) {
    const minLength = 8;
    const hasUpperCase = /[A-Z]/.test(password);
    const hasLowerCase = /[a-z]/.test(password);
    const hasNumber = /[0-9]/.test(password);
    const hasSpecialChar = /[!@#$%^&*]/.test(password);

    if (password.length < minLength) {
        return { isValid: false, message: 'Password must be at least 8 characters long.' };
    }
    if (!hasUpperCase) {
        return { isValid: false, message: 'Password must contain at least one uppercase letter.' };
    }
    if (!hasLowerCase) {
        return { isValid: false, message: 'Password must contain at least one lowercase letter.' };
    }
    if (!hasNumber) {
        return { isValid: false, message: 'Password must contain at least one numeric digit.' };
    }
    if (!hasSpecialChar) {
        return { isValid: false, message: 'Password must contain at least one special character (!@#$%^&*).' };
    }

    return { isValid: true, message: '' };
}

</script>
</body>
</html>