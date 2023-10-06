<?php

// connect to database
require "../modules/config.php";

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $userName = ($_POST['name']);
    $birthday = $_POST["date"];
    $email= ($_POST['email']);
    $password = md5($_POST["Password"]);
    $cpassword= md5($_POST["ConfirmPassword"]);
    $phone= $_POST["Tel"];
    $gender= $_POST["gender"];
    $role = $_POST["user_type"];

    $sql= "SELECT * from users where email = '$email'";
    $result=mysqli_query($conn,$sql);


    if(mysqli_num_rows($result) > 0) {
        $error[] = "User already exist!";
    }
    elseif($password != $cpassword){
        $error[] = "Password and Confirmed Password are not matched!";
    }
    else{
        $new_user_id=uniqid("U"); 
        # Insert into users table
        $sql = "INSERT INTO users(userID, userName, gender, email, phone, birthday, password, role, accStatus) 
                VALUES('$new_user_id', '$userName', '$gender', '$email', '$phone','$birthday', '$password', '$role', 'active')";
        
        if (!mysqli_query($conn,$sql)) {
            trigger_error("Insertion to users table fail", E_USER_NOTICE);
            die;
        } else{
            if ($role=='consumer'){
                $new_cart_id=uniqid("C");
                # Insert into cart table
                $cart_sql = "INSERT INTO cart(cartID, userID)
                            VALUES('$new_cart_id', '$new_user_id')";
                if (!mysqli_query($conn,$cart_sql)) {
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
    <?php
    if(isset($error)){
        foreach($error as $error){
            echo '<span clas"error-msg">'.$error. '</span>';
        }}
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
</head>
<body>
<div class="form-container">

    <form action=""method="post">
        <section>
        <h3>Register Now!</h3>
        </section>
        
        <section>
        <label for="">Name</label>
        </section>
        <section>
        <input type="text" name="name" required placeholder="Enter your Name">
        </section>
        
        <section>
        <label for="">Date of birth</label>    
        </section>
        <section>
        <input type="Date" name="date" min="1923-01-01" max="2013-12-31" required placeholder="enter your Date of Birth">
        </section>

        <section>
        <br>choose your gender<br>
            <input type="radio" name="gender" value="Male" required="required">Male
            <input type="radio" name="gender" value="Female">Female
        </section>
        
        <section>
        <label for="">Email</label> 
        </section>
        <section>
        <input type="Email" name="email" required placeholder = "Enter your Email">
        </section>
        
        <section>
        <label for="">Password</label> 
        </section>
        <section>
        <input type="Password" name="Password" required placeholder = "Enter your Password">
        </section>

        <section>
        <label for="">Confirm Password</label> 
        </section>
        <section>
        <input type="Password" name="ConfirmPassword" required placeholder = "Confirm your Password">
        </section>

        <section>
        <label for="">Phone Number</label> 
        </section>
        <section>    
            <input id="phone" name="Tel" type="Tel"> 
            <span id="valid-msg" class="hide"></span>
            <span id="error-msg" class="hide"></span>
            
          
            
            <script> 
                const input = document.querySelector("#phone");
                const button = document.querySelector("#btn");
                    const errorMsg = document.querySelector("#error-msg");
                    const validMsg = document.querySelector("#valid-msg");

                    // here, the index maps to the error code returned from getValidationError
                    const errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

                    // initialise plugin
                    const iti = window.intlTelInput(input, {
                    utilsScript: "/intl-tel-input/js/utils.js?1695806485509"
                    });

                    const reset = () => {
                    input.classList.remove("error");
                    errorMsg.innerHTML = "";
                    errorMsg.classList.add("hide");
                    validMsg.classList.add("hide");
                    };

                    

                    input.addEventListener('change', reset);
                    input.addEventListener('keyup', reset);
            
            </script>
        </section>
        
        <section>
        <label for="">Roles</label> 
        </section>
        <section>
        <select name="user_type">
            <option value="consumer">consumer</option>
            <option value="supplier">supplier</option>
        </select>
        </section>
       
        <input type="submit" value="register" class="form-btn">
           

        <p>already have an account? <a href="Index.php">Login Now!</p>
    </form>
      
       
</div>
</body>
</html>
<?php include '../includes/footer.php'; ?>