<?php
    require "../modules/config.php";
    if ($_SERVER['REQUEST_METHOD']=='POST'){

        $Email= $_POST["email"];
        $Password = md5($_POST["password"]);

        $sql="SELECT * From users WHERE 
            email ='$Email' AND password ='$Password'";

        $result=mysqli_query($conn,$sql);
        
        if(mysqli_num_rows($result) > 0) {
            $user_info = mysqli_fetch_array($result);
            $_SESSION['email'] = $Email;
            $_SESSION['username'] = $user_info['userName'];
            $_SESSION['user_id'] = $user_info['userID'];
            $role = $user_info['role'];
            $_SESSION['role'] = $user_info['role'];

            if(!empty($_POST["remember"])) {
                setcookie ("email", $Email, time()+(365*24*60*60));
                setcookie ("password", $_POST["password"], time()+(365*24*60*60));
            }else {
                setcookie("email", "", time() - 3600);
                setcookie("password", "", time() - 3600);
            }
                
            header("Location: ../index.php");
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

        <form id="loginForm" method="post">
            <section>
            <h3>Login</h3>
            </section>
        
            <section>
                <p>Email</p>
                <input type="email" name="email" placeholder="Enter your Email" value="<?php if(isset($_COOKIE['email'])){ echo $_COOKIE['email']; } ?>" required>
            </section>

            <section>
                <p>Password</p>
                <input type="password" name="password" placeholder="Enter your Password" value="<?php if(isset($_COOKIE['email'])){ echo $_COOKIE['password']; } ?>" required>
            </section>  
            <p><input type="checkbox" name="remember" />remember me?</p>
            <input type="submit" value="Login" class="form-btn">
            <p>Don't have an account?</p><a>
        </form>
    </div>
    <?php
        // Submit the form if the cookies are set
        if (isset($_COOKIE['email']) && isset($_COOKIE['password'])){
            echo '<script>document.getElementById("loginForm").submit();</script>';
        }
    ?>
</body>
<?php include '../includes/footer.php'; ?>
</html>