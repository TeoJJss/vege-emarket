<?php require $_SERVER['DOCUMENT_ROOT'].'/config.php'; ?>

<header>
    <style>
        header{
            width: 100%;
            background-color: aliceblue;
        }
        table.header{
            width: 100%;
            text-align: center;
        }
        td.header-logo{
            cursor: default;
            width: 20%;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 200%;
        }
        td.header-content{
            text-align: center;
            width: 50%;
        }
        td.header-content-right{
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }
        td.header-content-right button{
            margin-top: 1vw;
        }
        td.header-content-right a{
            text-decoration: underline;
            color: blue; 
            cursor: pointer;
            margin: 10px;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        input.header-search-input{
            width: 70%;
            height: 4vh;
            font-size: 3vh;
        }
        body.header-search-button{
            background-color: default;
        }
        button.header-search-button{
            font-size: 100%;
            width: 5%;
            height: 5vh;
        }
        button.header-search-button:hover{
            cursor: pointer;
        }
        button.header-console-button{
            background-color: grey;
            color: white;
            border: none;
            height: 5vh;
            border-radius: 6vh;
            cursor: pointer;
        }
        button.header-username-button:hover{
            background-color: darkgrey;
            cursor: pointer;
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
    </style>
    <table class="header">
        <tr id="header">
            <td class="header-logo" colspan="2">Vege e-Market</td>
            <td class="header-content">
                <div><a href="<?php echo $base.'/admin/index.php'; ?>">Home</a><span style="margin-left: 3vw;"></span>
                    <a href="<?php echo $base.'/about.php'; ?>">About Us</a><span style="margin-left: 3vw;"></span>
                    <a href="<?php echo $base.'/contact.php'; ?>">Contact Us</a><span style="margin-left: 3vw;"></span>

                </div><br>
                <form action="" method="get">
                    <input type="text" class="header-search-input" placeholder="Search product">
                    <button class="header-search-button" >🔍</button>
                </form>
            </td>
            <td class="header-content-right">Welcome back, <a class="username-dropdown-btn" onclick="displayUsernameDropdown()"><?php echo $username; ?></a>! <br>
                    <div id="header-username-dropdown" class="header-username-dropdown-content">
                        <a href="<?php echo $base.'/profile.php'; ?>">Profile</a><br><br>
                        <a href="<?php echo $base.'/logout.php'; ?>">Logout</a><br> &nbsp;
                    </div>
                <button class="header-console-button" onclick="window.location.href='<?php echo $base_role; ?>/console.php';" title="Go to Admin Console">Console</button>
            </td>
        </tr>
    </table><br>
</header>
<script>
    function displayUsernameDropdown(){
        document.getElementById('header-username-dropdown').style.display='block'
    }
    window.onclick = function(event) {
    if (!event.target.matches('.username-dropdown-btn')) {
        document.getElementById('header-username-dropdown').style.display='none'
    }
    }
</script>