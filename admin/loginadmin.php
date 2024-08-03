<?php

include '../config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `admins` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['logged_in'] = true;
      header('Location: indexadmin.php');
   }else{
      $mes = 'incorrect password or email!';
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login admin</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style_login_register.css">

</head>
<body>

<?php
if(isset($mes)){
   // foreach($mes as $mes){
   //    echo '<div class="message" onclick="this.remove();">'.$mes.'</div>';
   // }

   echo '<div class="message" onclick="this.remove();">'.$mes.'</div>';
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login</h3>
      <input type="email" name="email" required placeholder="enter email" class="box">
      <input type="password" name="password" required placeholder="enter password" class="box">
      <input type="submit" name="submit" class="btn" value="login"><a href="index.php"></a>
        <a href="indexadmin.php"></a>
   </form>

</div>

</body>
</html>