<?php
require "../modules/config.php";
if ($_SERVER['REQUEST_METHOD']=='POST'){

    $Email= $_POST["email"];
    $Password = md5($_POST["password"]);

    $sql="Select * From users where 
        email ='$Email' and password ='$Password'";

    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0) {
       $user_info = mysqli_fetch_array($result);
        $_SESSION['email'] = $Email;
       $_SESSION['username'] = $user_info['userName'];
       $role = $user_info['role'];
       $_SESSION['role'] = $user_info['role'];
        header("Location:../index.php");
    }
    else {
        echo'<script>alert("Wrong username or password. Please try again.")</script>';
    }
}


?>
<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="form-container">

        <form method="post">
            <section>
            <h3>Login</h3>
            </section>
        
            <section>
                <p>Email</p>
                <input type="email" name="email" required placeholder="Enter your Email">
            </section>

            <section>
                <p>Password</p>
                <input type="Password" name="password" required placeholder="Enter your Password">
            </section>

            <input type="submit" value="Login" class="form-btn">
            <p>Don't have an account?</p><a>
            </form>
        </div>
</body>
</html>