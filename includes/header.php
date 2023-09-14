<?php 
    require $_SERVER['DOCUMENT_ROOT'].'/vege-emarket/modules/config.php'; 

    /* READ (change to session after login page done) */
    $read_sql = "SELECT userName FROM users WHERE userID='$user_id'";

    $user_info=mysqli_fetch_array(mysqli_query($conn, $read_sql));
    $username=$user_info['userName'];
?>

<header>
    <style>
        div.header_logo {
            float: left;
            margin-left: 5%;
        }
        div.header_welcome{
            float: right;
            margin-right: 4%;
        }
        header{
            margin-top: 2%;
            font-size: 120%;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        div.header-username-dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 5vw;
            min-height: 6vh;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            right: 9vw;
        }
        div.header_welcome > a{
            text-decoration: underline;
            color: green; 
            cursor: pointer;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        div.header-username-dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 5vw;
            min-height: 6vh;
            overflow: auto;
            text-align: center;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            right: 8vw;
        } 
        div.header-username-dropdown-content > a{
            cursor: pointer;
            color: darkgreen;
        }
    </style>
    <div class="header_logo">
        <a href="<?php echo $base.'/index.php'; ?>"><img src="../images/logo.png" alt="Vege e-Market" height="100vh"></a>
    </div>
    <div class="header_welcome">
        <span id="header_greeting">Welcome</span>, <br> <a class="username-dropdown-btn" onclick="displayUsernameDropdown()"><?php echo $username; ?></a>! <br>
                    <div id="header-username-dropdown" class="header-username-dropdown-content">
                        <a href="<?php echo $base.'/public/profile.php'; ?>">Profile</a><br><br>
                        <a href="<?php echo $base.'/modules/logout.php'; ?>">Logout</a><br> &nbsp;
                    </div>
    </div>
    <script>
        function displayUsernameDropdown(){
            document.getElementById('header-username-dropdown').style.display='block';
        }
        window.onclick = function(event) {
            if (!event.target.matches('.username-dropdown-btn')) {
                document.getElementById('header-username-dropdown').style.display='none';
            }
        }
        var currentDate = new Date();
        var currentHour = currentDate.getHours();
        const greetTag=document.getElementById('header_greeting');

        if (currentHour >= 6 && currentHour < 12) {
            greetTag.innerHTML="Good Morning";
        } else if (currentHour >= 12 && currentHour < 17) {
            greetTag.innerHTML="Good Afternoon";
        }else if (currentHour>=17 && currentHour<22){
            greetTag.innerHTML="Good Evening";
        }else if (currentHour>=22 || currentHour<6){
            greetTag.innerHTML="Good Night";
        }
    </script>
</header>
<p style="clear:both;"></p>