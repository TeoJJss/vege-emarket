<?php 
    require '../modules/config.php'; // Validate user role
    if ($role == ''){
        header("Location: ../index.php");
        die;
    }
    
    include '../includes/header.php'; // Get header

    /* READ */
    $read_sql = "SELECT * FROM users WHERE userID='$user_id'";

    $user_info=mysqli_fetch_array(mysqli_query($conn, $read_sql));

    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $username=$_POST['username'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];

        $sql = "SELECT * from users where email = '$email' AND userID != '$user_id'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email is used by another account'); </script>";
        }else{
            /* UPDATE */
            $update_sql = "UPDATE users SET userName='$username', email='$email', phone='$phone' WHERE userID='$user_id'";
            mysqli_query($conn, $update_sql);
            header("Location: ../public/profile.php");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="../styles/title.css">
    <style>
        h1#title{
            color: darkgreen;
            text-align: center;
            font-size: 6vw;
            margin: 7vh 0vw;
        }
        div.container{
            background-color: oldlace;
            min-width: max-content;
            min-height: max-content;
            width: 40%;
            margin-left: 30vw;

        }
        form.profile h2 {
            font-family: Georgia, 'Times New Roman', Times, serif;
            margin-left: 8vw;
            margin-top: 0.1vw;
            margin-bottom: 0vw;
        }
        form.profile input{
            font-size: 1.2vw;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            line-height: 0vw;
            margin-top: 0.2vw;
            margin-left: 8vw;
            margin-bottom: 2vw;
            background-color: transparent;
            border: 0;
            vertical-align: middle;
            margin-right: 2vw;
            overflow-x: auto;
        }
        form.profile div.input-container{
            display: flex;
            
        }
        form.profile button.edit{
            vertical-align: middle;
            background-color: transparent;
            border: none;
            width: 2vw;
            margin: 0 0.5vw 0;
            height: 1vw;
        }
        form.profile button:hover{
            cursor: pointer;
        }
        form.profile button.save{
            vertical-align: top;
            margin-left: 8vw;
            display: none;
        }
        label{
            color: forestgreen;
        }
    </style>
</head>
<body>
    <br>
    <h1 id="title">Profile</h1>
    <div class="container">
        <br>
        <form class="profile" method="post">
            <label for="username"><h2>Username</h2></label>
            <div class="input-container">
                <input type="text" name="username" id="username" value="<?php echo $user_info['userName']; ?>" maxlength="15" readonly required>
                <button title="Click me to edit" class="edit" id="editbutton" onclick="edit('username')"><img src="../images/edit.png" alt="Edit" width="100%"></button>
            </div>

            <label for="gender"><h2>Gender</h2></label>
            <div class="input-container">
                <input type="text" name="gender" id="gender" value="<?php echo ucfirst($user_info['gender']); ?>" readonly>
            </div>

            <label for="birthday"><h2>Birthday</h2></label>
            <div class="input-container">
                <input type="text" id="birthday" name="dob" value="<?php echo $user_info['birthday']; ?>" readonly>
            </div>

            <label for="email"><h2>Email</h2></label>
            <div class="input-container">
                <input type="email" id="email" name="email" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" value="<?php echo $user_info['email']; ?>" readonly required>
                <button title="Click me to edit" class="edit" id="editbutton" onclick="edit('email')"><img src="../images/edit.png" alt="Edit" width="100%"></button>
            </div>

            <label for="phone"><h2>Phone Number</h2></label>
            <div class="input-container">
                <input type="tel" id="phone" name="phone" pattern="[0-9]{11,12}" value="<?php echo $user_info['phone']; ?>" readonly required>
                <button title="Click me to edit" class="edit" id="editbutton" onclick="edit('phone')"><img src="../images/edit.png" alt="Edit" width="100%"></button>
            </div>

            <label for="role"><h2>Role</h2></label>
            <div class="input-container">
                <input type="text" id="role" name="role" value="<?php echo ucfirst($user_info['role']); ?>" readonly>
            </div>
            <br>
            <button title="Save changes" type="submit" class="save" style="font-size: 1vw;" id="save">Save</button>
        </form>
    </div><br>
    <script>
        function edit(info){
            var inp = document.getElementById(info);
            inp.removeAttribute('readonly');
            inp.focus();
            event.preventDefault(); //Avoid the form submitted immediately
            document.getElementById('save').style.display='block';
            document.getElementById('save').style.backgroundColor='white';
        }
        function save(){
            var inputs = document.getElementsByTagName('input');
            for (let i=0; i<inputs.length; i++){
                var input = inputs[i];
                input.setAttribute('readonly', 'readonly');
            }
            document.getElementById('save').style.display='none';            
        }
    </script>
</body>
</html>
<?php include '../includes/footer.php'; ?>