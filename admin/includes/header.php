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
            width: 20%;
        }
        td.header-content{
            text-align: center;
            width: 50%;
        }
        td.header-content-right{
            text-align: center;
        }
        td.header-content-right button{
            margin-top: 1vw;
            
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
            width: 7%;
            height: 5vh;
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
            <td class="header-content-right">Welcome back, <a href="<?php echo $base; ?>/profile.php">username</a>! <br>
                <button class="console-button" onclick="window.location.href='<?php echo $base_role; ?>/console.php';" title="Go to User Management page">
                    Console
                </button>
            </td>
        </tr>
    </table><br>
</header>