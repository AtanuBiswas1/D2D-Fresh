<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if($user_id==""){
   header('location:login.php');
};

if(isset($_POST['update_profile'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
   $update_profile->execute([$name, $email, $user_id]);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   $old_image = $_POST['old_image'];

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $user_id]);
         if($update_image){
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('uploaded_img/'.$old_image);
            $message[] = 'image updated successfully!';
         };
      };
   };

   $old_pass = $_POST['old_pass'];
   $update_pass = md5($_POST['update_pass']);
   $update_pass = filter_var($update_pass, FILTER_SANITIZE_STRING);
   $new_pass = md5($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = md5($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if(!empty($update_pass) AND !empty($new_pass) AND !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         $update_pass_query = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_pass_query->execute([$confirm_pass, $user_id]);
         $message[] = 'password updated successfully!';
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
   <title>Update user profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/components.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="update-profile">

   <h1 class="title">update profile</h1>

   <form action="" method="POST" enctype="multipart/form-data"
   style="border-radius: 2.5rem; background-color: #1d2428;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
   >
      <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
      <div class="flex">
         <div class="inputBox" >
            <span style="color:#d5e1df">username :</span>
            <input
            style="background-color: #e1edec;    border-radius: 2.5rem;    color: #160d0d;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
             type="text" name="name" value="<?= $fetch_profile['name']; ?>" placeholder="update username" required class="box">
            <span style="color:#d5e1df">email :</span>
            <input
            style="background-color: #e1edec;    border-radius: 2.5rem;    color: #160d0d;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
             type="email" name="email" value="<?= $fetch_profile['email']; ?>" placeholder="update email" required class="box">
            <span style="color:#d5e1df">update pic :</span>
            <input
            style="background-color: #e1edec;    border-radius: 2.5rem;    color: #160d0d;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
             type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box">
            <input type="hidden" name="old_image" value="<?= $fetch_profile['image']; ?>">
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?= $fetch_profile['password']; ?>">
            <span style="color:#d5e1df">old password :</span>
            
            <input id="oldPassword"
            style="background-color: #e1edec;    border-radius: 2.5rem;    color: #160d0d;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
             type="password" name="update_pass" placeholder="enter previous password" class="box">
             <div id="OldvalidationMessage" ></div>

            <span style="color:#d5e1df">new password :</span>
            <input id="newPassword"
            style="background-color: #e1edec;    border-radius: 2.5rem;    color: #160d0d;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
             type="password" name="new_pass" placeholder="enter new password" class="box">
             <div id="NewvalidationMessage" ></div>

            <span style="color:#d5e1df">confirm password :</span>
            <input id="newConfirmPassword"
            style="background-color: #e1edec;    border-radius: 2.5rem;    color: #160d0d;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
             type="password" name="confirm_pass" placeholder="confirm new password" class="box">
             <div id="NewConfirmvalidationMessage" ></div>
         </div>
      </div>
      <div class="flex-btn">
         <input
         style="border-radius: 2.5rem;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
         type="submit" class="btn" value="update profile" name="update_profile">
         <a 
         style="border-radius: 2.5rem;box-shadow: rgb(16 229 181 / 77%) 0px 5px 15px;"
         href="home.php" class="option-btn">go back</a>
      </div>
   </form>

</section>










<?php include 'footer.php'; ?>


<script src="js/script.js"></script>

<script>
  document.getElementById('oldPassword').addEventListener('input', function(event) {
    const password = event.target.value;
    const validationMessage = document.getElementById('OldvalidationMessage');
    validationMessage.style.fontSize="1.5rem"
    const validationResults = validatePassword(password);

    if (validationResults.isValid) {
        validationMessage.textContent = ' Password is valid!';
        validationMessage.style.color = 'green';
        document.getElementById("Login").disabled = false;
        
    } else {
        validationMessage.textContent = validationResults.message;
        validationMessage.style.color = 'red';
        document.getElementById("Login").disabled = true;
        
        
    }
});

document.getElementById('newPassword').addEventListener('input', function(event) {
    const password = event.target.value;
    const validationMessage = document.getElementById('NewvalidationMessage');
    validationMessage.style.fontSize="1.5rem"
    const validationResults = validatePassword(password);

    if (validationResults.isValid) {
        validationMessage.textContent = ' Password is valid!';
        validationMessage.style.color = 'green';
        document.getElementById("Login").disabled = false;
        
    } else {
        validationMessage.textContent = validationResults.message;
        validationMessage.style.color = 'red';
        document.getElementById("Login").disabled = true;
        
        
    }
});

document.getElementById('newConfirmPassword').addEventListener('input', function(event) {
   const confirmPassword = event.target.value;
   const confirmationPasswordMsg = document.getElementById('NewConfirmvalidationMessage');
   confirmationPasswordMsg.style.fontSize="1.5rem"
   const password=document.getElementById('newPassword').value

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