<?php
require "../modules/config.php";

if ($role != ''){
   header("Location: ../index.php");
   die;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   $Email = $_POST["email"];
   $Telephone = $_POST["Tel"];
   $Username = $_POST["name"];
   $password = md5($_POST["password"]);
   $cpassword = md5($_POST["cpassword"]);


   $sql = "SELECT * From users WHERE email='$Email' and phone ='$Telephone' and userName = '$Username'";
   $result = mysqli_query($conn, $sql);

   if (mysqli_num_rows($result) != 1) {
      $error[] = "Wrong details! ";
   } elseif ($password != $cpassword) {
      $error[] = "Password and Confirmed Password are not matched!";
   } else {

      $update_sql = "UPDATE users SET password='$password' WHERE email='$Email' and phone ='$Telephone' and userName = '$Username'";
      if (!mysqli_query($conn, $update_sql)) {
         trigger_error("failed to update password", E_USER_NOTICE);
         die;
      }

      echo "success";
      echo "<script> alert('Password has been updated successfully!'); window.location.href='../index.php';</script>";
   }
}

?>


<style>
   @import url('../styles/fonts.googleapis.com_css2_family=Poppins_wght@100;200;300;400;500;600&display=swap.css'); div.form-container * {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      outline: none;
      border: none;
      text-decoration: none;
   }

   .form-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      padding-bottom: 60px;
      background: #FFFDD0;
   }

   .form-container form {
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
      background: white;
      text-align: center;
      width: 500px;
   }

   .form-container form h3 {
      font-size: 17px;
      text-transform: uppercase;
      margin-bottom: 10px;
      color: #333333;
   }

   .form-container form input,
   .form-container form select {
      width: 100%;
      padding: 10px 15px;
      font-size: 17px;
      margin: 8px 0;
      background: #eeeeee;
      border-radius: 5px;
   }


   .form-container form select option {
      background: #ffffff;
   }

   .form-container form .form-btn {
      background: #eeeeee;
      color: darkgreen;
      text-transform: capitalize;
      font-size: 20px;
      cursor: pointer;
   }

   .form-container form .form-btn:hover {
      background: lightgreen;
      color: #ffffff;
   }

   .form-container form p {
      margin-top: 10px;
      font-size: 20px;
      color: #333333;
   }


   .form-container form h2 {
      font-size: 30px;
      text-transform: uppercase;
      margin-bottom: 10px;
      color: #333333;
   }


   .form-container form input[type="submit"] {

      width: 20%;
      padding: 10px 0;
      margin: 8px 1;
      margin-top: 10px;
      background: #eeeeee;
      border-radius: 5px;
      color: darkgreen;
      text-transform: capitalize;
      font-size: 20px;
      cursor: pointer;
      float: right;
   }

   .form-container form [class="form-btn"] {
      width: 20%;
      padding: 10px;
      margin: 9px 1;
      margin-top: 9px;
      background: #eeeeee;
      border-radius: 5px;
      color: darkgreen;
      text-transform: capitalize;
      font-size: 20px;
      cursor: pointer;
      float: left;
   }

   .error-msg {
      display: block;
      background: red;
      color: #ffffff;
      font-size: 20px;
      padding: 10px;
   }

   .form-container form p {
      margin-top: 10px;
      font-size: 20px;
      color: #333333;
   }

   .form-container a:hover {
      text-decoration: underline;
   }

   div.form-container h3{
      font-size: 1.3vw;
   }
</style>
<link rel="stylesheet" href="../styles/showPassword.css">
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Reset Password</title>
   <?php

   if (isset($error)) {
      foreach ($error as $error) {
         echo '<span class="error-msg">' . $error . '</span>';
      };
   }
   ?>
   <style>

   </style>
</head>

<body>
   <div class="form-container">

      <form action="" method="post">
         <a href="../index.php"><img src="../images/logo.png"></a>
         <section>
            <br><h1><img src="../images/reset-password.png" alt="reset" width="5%"> Reset your password </h1><br>
            <h3>Please enter your Details to Verify</h3>
         </section>

         <section>
            <label for="email"><P>Email</p></label>
         </section>
         <section>
            <input type="email" id="email" name="email" required placeholder="Enter your Email">
         </section>

         <section>
            <label for="username"><p>Username</p></label>
         </section>

         <section>
            <input type="text" id="username" name="name" required placeholder="Enter your Name">
         </section>

         <section>
            <label for="phone"><p>Phone Number</p></label>
         </section>

         <section>
            <input id="phone" name="Tel" type="Tel" pattern="[0-9]{11,12}" required placeholder="0000000000">
         </section>

         <br></br>

         <section>
            <h3>Enter new password<h3>
         </section>

         <section>
            <p><label for="passwordInput">New Password </label><img src="../images/showPassword.png" class="eye-button" id="show-password-btn" alt="show password" title="Click to show password" width="5%" onclick="showPassword('show-password-btn')"></p>
         </section>

         <section>
            <input type="password" name="password" id="passwordInput" required placeholder="Enter your New Password">
         </section>

         <section>
            <P><label for="confirmInput">Confirm Password </label><img src="../images/showPassword.png" class="eye-button" id="show-confirm-btn" alt="show password" title="Click to show password" width="5%" onclick="showPassword('show-confirm-btn')"></p>
         </section>

         <section>
            <input type="password" name="cpassword" id="confirmInput" required placeholder="Confirm your Password">
         </section>

         <p><input type="submit" value="Next" class="form-btn"></p>

         <a class="form-btn" href="Index.php">< back</a>
         <p style="clear:both;">Encounter an issue? <a style="color: darkgreen;" href="../public/contact.php">Contact us!</a></p>
      </form>
   </div>
</body>
<script src="../src/showPassword.js"></script>
</html>
<?php include '../includes/footer.php'; ?>
