<?php 
    require $_SERVER['DOCUMENT_ROOT'].'/agriculture/modules/config.php'; // Validate user role
    if ($role == ''){
        header("Location: $base");
    }
    
    include $_SERVER['DOCUMENT_ROOT'].'/agriculture/includes/header.php'; // Get header

    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $username=$_POST['username'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
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
            color: midnightblue;
            text-align: center;
            font-size: 6vw;
            margin: 7vh 0vw;
        }
        div.container{
            background-color: whitesmoke;
            width: 40%;
            height: 80%;
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
    </style>
</head>
<body>
    <br>
    <h1 id="title">Profile</h1>
    <div class="container">
        <br>
        <form class="profile" action="" method="post" onsubmit="window.confirm('Save changes?');save();">
            <label for="username"><h2>Username</h2></label>
            <div class="input-container">
                <input type="text" name="username" id="username" value="<?php echo $username; ?>" readonly required>
                <button title="Click me to edit" class="edit" id="editbutton" onclick="edit('username')"><img src="../images/edit.jpg" alt="Edit" width="100%"></button>
            </div>

            <label for="gender"><h2>Gender</h2></label>
            <div class="input-container">
                <input type="text" name="gender" id="gender" value="<?php echo $gender; ?>" readonly>
            </div>

            <label for="birthday"><h2>Birthday</h2></label>
            <div class="input-container">
                <input type="text" id="birthday" name="dob" value="<?php echo $birthday; ?>" readonly>
            </div>

            <label for="email"><h2>Email</h2></label>
            <div class="input-container">
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly required>
                <button title="Click me to edit" class="edit" id="editbutton" onclick="edit('email')"><img src="../images/edit.jpg" alt="Edit" width="100%"></button>
            </div>

            <label for="phone"><h2>Phone Number</h2></label>
            <div class="input-container">
                <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>" readonly required>
                <button title="Click me to edit" class="edit" id="editbutton" onclick="edit('phone')"><img src="../images/edit.jpg" alt="Edit" width="100%"></button>
            </div>

            <label for="role"><h2>Role</h2></label>
            <div class="input-container">
                <input type="text" id="role" name="role" value="<?php echo $role; ?>" readonly>
            </div>
            <br>
            <button title="Save changes" type="submit" class="save" id="save">Save</button>
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
<?php include $_SERVER['DOCUMENT_ROOT'].'/agriculture/includes/footer.php'; ?>