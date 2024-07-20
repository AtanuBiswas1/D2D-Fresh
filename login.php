<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $sql = "SELECT * FROM `users` WHERE email = ? AND password = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$email, $pass]);
   $rowCount = $stmt->rowCount();  

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if($rowCount > 0){

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }elseif($row['user_type'] == 'dboy'){

         $_SESSION['dboy_id'] = $row['id'];
         header('location:deliveryBoy.php');

      }else{
         $message[] = 'no user found!';
      }

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/components.css">

</head>
<body style="background-color: #9eb3bd;">

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
   <div style="height: 100px;font-size:2rem;color :blue;text-align:center;margin-top:2rem "> " Now, order delivery and shopping options are available only for <span style="font-size:2.7rem;color:red">Medinipore town</span> with the pin code:<span style="font-size:2rem;color:red"> 721101 ,721102,721129 and 721436 </span>"</div>
<section class="form-container">


   <form action="" method="POST" style="border-radius: 2.5rem;
    background-color: #1d2428;
    box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;">
      <h3 style="color:#aab0d1;">login now</h3>
      <input
      style="background-color: #e1edec;
    border-radius: 2.5rem;
    color: #160d0d;
    box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
      type="email" name="email" class="box" placeholder="enter your email" required style="border-radius: 2.5rem;">
      <input
      style="background-color: #e1edec;
    border-radius: 2.5rem;
    color: #160d0d;
    box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
      type="password" name="pass" class="box " id="password" placeholder="enter your password" required style="border-radius: 2.5rem;">
      <div id="validationMessage" ></div>
      <input 
      style="
    border-radius: 2.5rem;
    color: #160d0d;
    box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
      type="submit" id="Login" value="login now" class="btn" name="submit" style="border-radius: 2.5rem;">
      
      <p>Don't have an account? <a href="register.php">register now</a></p>

      <!-- <p>Admin Login, Click Here <a href="admin_page.php">Admin Login</a></p> -->
      <p>Go to Home, Click Here <a href="home.php">Home</a></p>
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
        document.getElementById("Login").disabled = false;
        
    } else {
        validationMessage.textContent = validationResults.message;
        validationMessage.style.color = 'red';
        document.getElementById("Login").disabled = true;
        
        
    }
});

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