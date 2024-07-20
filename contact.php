<?php

@include 'config.php';

session_start();

// $user_id = $_SESSION['user_id'];
$user_id = (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '');

// if($user_id==""){
//    header('location:login.php');
// };

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `message` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'already sent message!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `message`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'sent message successfully!';

   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="contact">

   <h1 class="title">get in touch</h1>

   <form action="" method="POST" 
   style="background-color: #1f394a;border-radius: 3.5rem;"
   >
      <input type="text" name="name" class="box" required placeholder="enter your name"  style="border-radius: 2rem;background-color: #c0d2d7;">
      <input type="email" name="email" class="box" required placeholder="enter your email" style="border-radius: 2rem;background-color: #c0d2d7;">
      <input id="Phone" type="number" name="number" min="0" class="box" required placeholder="enter your number" style="border-radius: 2rem;background-color: #c0d2d7;">
      <div id="validationMessage" ></div>
      <textarea name="msg" class="box" required placeholder="enter your message" cols="30" rows="10" style="border-radius: 2rem;background-color: #c0d2d7;"></textarea>
      <input id="MsgSubmit" type="submit" value="send message" class="btn" name="send" style="border-radius: 2.5rem;">
   </form>

</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
<script>
 document.getElementById('Phone').addEventListener('input', function(event) {
  const phoneNo = event.target.value;
  const validationMessage = document.getElementById('validationMessage');
  validationMessage.style.fontSize="1.5rem"
  const validationResults = validatePassword(phoneNo);

  if(validationResults.isValid){
    validationMessage.textContent = 'Mobile no is valid!';
    validationMessage.style.color = 'green';
    document.getElementById("MsgSubmit").disabled = false;
    
  }else {
    validationMessage.textContent = validationResults.message;
    validationMessage.style.color = 'red';
    document.getElementById("MsgSubmit").disabled = true;
    
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
</script>
</body>
</html>