<?php 
    require $_SERVER['DOCUMENT_ROOT'].'/agriculture/modules/config.php'; 
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
            color: blue; 
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
            right: 4vw;
        }
        span#logo_txt{
            text-decoration: none; /* Remove underline */
            color: blue;
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-weight: bold;
            font-size: 170%;
            cursor: pointer;
        }
    </style>
    <div class="header_logo">
        <a href="<?php echo $base.'/index.php'; ?>"><img src="" alt="LOGO_IMG"></a><span id="logo_txt" onclick="location.href='<?php echo $base.'/index.php'; ?>'">&nbsp;<?php echo $web_name; ?></span>
    </div>
    <div class="header_welcome">
        Welcome <br> <a class="username-dropdown-btn" onclick="displayUsernameDropdown()"><?php echo $username; ?></a>! <br>
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
    </script>
</header>
<br><br>