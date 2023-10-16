<?php
require "../modules/config.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Email = $_POST["email"];
    $Password = md5($_POST["password"]);

    $sql = "SELECT * From users WHERE 
            email ='$Email' AND password ='$Password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user_info = mysqli_fetch_array($result);
        if ($user_info['accStatus'] == 'banned') {
            trigger_error('<strong style="text-align: center; color: red;">Your account is banned by admin! </strong>', E_USER_WARNING);
            die;
        }
        $_SESSION['email'] = $Email;
        $_SESSION['username'] = $user_info['userName'];
        $_SESSION['user_id'] = $user_info['userID'];
        $role = $user_info['role'];
        $_SESSION['role'] = $user_info['role'];

        if (!empty($_POST["remember"])) {
            setcookie("email", $Email, time() + (365 * 24 * 60 * 60));
            setcookie("password", $_POST["password"], time() + (365 * 24 * 60 * 60));
        } else {
            setcookie("email", "", time() - 3600);
            setcookie("password", "", time() - 3600);
        }

        header("Location: ../index.php");
    } else {
        include '../includes/login_err.php';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="B2B Vegetable Agricultural marketplace">
    <meta name="keywords" content="B2B, vegetable, agriculture">
    <meta name="author" content="WDT Group 19 (2023)">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2px;
            padding-bottom: 60px;
        }


        .container .content .btn {
            display: inline-block;
            padding: 10px 30px;
            font-size: 20px;
            background: darkgreen;
            color: black;
            margin: 0 5px;
            text-transform: capitalize;
        }

        .container .content .btn:hover {
            background: darkgreen;
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
            font-size: 30px;
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

        .form-container .radio-button {
            display: flex;
            width: 100%;
            justify-content: space-around;
            margin: 8px 0;
            padding: 10px;
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
        .form-container form p a {
            color: darkgreen;
        }

        .form-container form h2 a {
            margin-top: 10px;
            font-size: 15px;
            color: darkgreen;
            float: right;
        }
    </style>
    <link rel="stylesheet" href="../styles/showPassword.css">
</head>

<body>
    <div class="form-container">

        <form id="loginForm" method="post">
            <section>
                <h3>Login</h3>
            </section>

            <section>
                <label for="email">
                    <p>Email</p>
                </label>
                <input type="email" name="email" placeholder="Enter your Email" value="<?php if (isset($_COOKIE['email'])) {
                                                                                            echo $_COOKIE['email'];
                                                                                        } ?>" required>
            </section>

            <section>
                <label for="password">
                    <p>Password <img src="../images/showPassword.png" class="eye-button" id="show-password-btn" alt="show password" title="Click to show password" width="5%" onclick="showPassword('show-password-btn')"></p>
                </label>
                <input type="password" name="password" id="passwordInput" placeholder="Enter your Password" value="<?php if (isset($_COOKIE['password'])) {
                                                                                                    echo $_COOKIE['password'];
                                                                                                } ?>" required>
                <h2><a href="reset_password.php">Forgot Password?</a></h2>
            </section>
            <br></br>
            <label for="remember" class="remember">Remember me?</label><input type="checkbox" name="remember">
            <input type="submit" value="Login" class="form-btn">
            <p>Don't have an account? <a href="Register.php">Register Now!</a></p>
        </form>
    </div>
    <script src="../src/showPassword.js"></script>
</body>
<?php include '../includes/footer.php'; ?>

</html>