<?php

// connect to database
require "../modules/config.php";

if ($role != ''){
    header("Location: ../index.php");
    die;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userName = ($_POST['name']);
    $birthday = $_POST["date"];
    $email = ($_POST['email']);
    $password = md5($_POST["Password"]);
    $cpassword = md5($_POST["ConfirmPassword"]);
    $phone = $_POST["Tel"];
    $gender = $_POST["gender"];
    $role = $_POST["user_type"];

    $sql = "SELECT * from users where email = '$email'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $error[] = "User already exist!";
    } elseif ($password != $cpassword) {
        $error[] = "Password and Confirmed Password are not matched!";
    } else {
        $prefix = date('Ymd');
        $new_user_id = uniqid("U" . $prefix);
        # Insert into users table
        $sql = "INSERT INTO users(userID, userName, gender, email, phone, birthday, password, role, accStatus) 
                VALUES('$new_user_id', '$userName', '$gender', '$email', '$phone','$birthday', '$password', '$role', 'active')";

        if (!mysqli_query($conn, $sql)) {
            trigger_error("Insertion to users table fail", E_USER_NOTICE);
            die;
        } else {
            if ($role == 'consumer') {
                $new_cart_id = uniqid("C" . $prefix);
                # Insert into cart table
                $cart_sql = "INSERT INTO cart(cartID, userID)
                            VALUES('$new_cart_id', '$new_user_id')";
                if (!mysqli_query($conn, $cart_sql)) {
                    trigger_error("Insertion to cart table fail", E_USER_NOTICE);
                    die;
                }
            }

            echo "success";
            echo "<script> alert('Registration success!'); window.location.href='../index.php';</script>";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php
    if (isset($error)) {
        foreach ($error as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
        };
    }
    ?>
    <link rel="stylesheet" href="../styles/cdnjs.cloudflare.com_ajax_libs_intl-tel-input_17.0.3_css_intlTelInput.min.css" />
    <script src="../src/cdnjs.cloudflare.com_ajax_libs_intl-tel-input_17.0.3_js_intlTelInput.min.js"></script>
    <script src="../src/cdnjs.cloudflare.com_ajax_libs_intl-tel-input_11.0.9_js_intlTelInput.js"></script>
    <style>
        @import url('../styles/fonts.googleapis.com_css2_family=Poppins_wght@100;200;300;400;500;600&display=swap.css'); form * {
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
            padding: 20px;
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

        .error-msg {
            display: block;
            background: red;
            color: #ffffff;
            font-size: 20px;
            padding: 10px;
        }

        .form-container a:hover {
            text-decoration: underline;
        }
    </style>
    <link rel="stylesheet" href="../styles/showPassword.css">
</head>
<body>
    <div class="form-container">

        <form action="" method="post">
            <a href="../index.php"><img src="../images/logo.png"></a>
            <section><br>
                <h1><img src="../images/register.png" alt="Register" width="5%"> Register Now!</h1><br>
            </section>

            <section>
                <label for="name">Name</label>
            </section>
            <section>
                <input type="text" id="name" name="name" required placeholder="Enter your Name" maxlength="15">
            </section>
            <br>
            <section>
                <label for="date">Date of birth</label>
            </section>
            <section>
                <input type="Date" name="date" id="date" min="1923-01-01" max="2013-12-31" required placeholder="enter your Date of Birth">
            </section>

            <section>
                <br>Choose your gender<br>
                <div class="radio-button">
                    <label for="male">
                        <input id="male" type="radio" name="gender" value="Male" required="required">Male
                    </label>
                    <label for="female">
                        <input id="female" type="radio" name="gender" value="Female">Female
                    </label>
                </div>
            </section>
            <br>
            <section>
                <label for="email">Email</label>
            </section>
            <section>
                <input type="Email" id="email" name="email" required placeholder="Enter your Email" maxlength="30">
            </section>
            <br>
            <section>
                <label for="passwordInput">Password <img src="../images/showPassword.png" class="eye-button" id="show-password-btn" alt="show password" title="Click to show password" width="5%" onclick="showPassword('show-password-btn')"></label>
            </section>
            <section>
                <input type="Password" name="Password" id="passwordInput" required placeholder="Enter your Password">
            </section>
            <br>
            <section>
                <label for="confirmInput">Confirm Password <img src="../images/showPassword.png" class="eye-button" id="show-confirm-btn" alt="show password" title="Click to show password" width="5%" onclick="showPassword('show-confirm-btn')"></label>
            </section>
            <section>
                <input type="Password" name="ConfirmPassword" id="confirmInput" required placeholder="Confirm your Password">
            </section>
            <br>
            <section>
                <label for="phone">Phone Number</label>
            </section>
            <section>
                <input id="phone" name="Tel" type="Tel" pattern="[0-9]{11,12}" style="width: 25vw;" required placeholder="0000000000 (include country code)">

                <script>
                    const input = document.querySelector("#phone");
                    const button = document.querySelector("#btn");
                    const errorMsg = document.querySelector("#error-msg");
                    const validMsg = document.querySelector("#valid-msg");

                    // here, the index maps to the error code returned from getValidationError - see readme
                    const errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

                    // initialise plugin
                    const iti = window.intlTelInput(input, {
                        utilsScript: "/intl-tel-input/js/utils.js?1695806485509"
                    });
                </script>
            </section>
            <br>
            <section>
                <label for="user_type">Roles</label>
            </section>
            <section>
                <select id="user_type" name="user_type" style="width: 15vw;" required>
                    <option value="" disabled selected>Select a role</option>
                    <option value="consumer">consumer</option>
                    <option value="supplier">supplier</option>
                </select>
            </section>
            <br>
            <input type="submit" value="register" class="form-btn">


            <p>Already have an account? <a href="../index.php">Login Now!</a></p>
        </form>
    </div>
    <script src="../src/showPassword.js"></script>
</body>
<?php include '../includes/footer.php'; ?>
</html>