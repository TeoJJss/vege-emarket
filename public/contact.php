<?php 
    require $_SERVER['DOCUMENT_ROOT'].'/agriculture/modules/config.php'; // Validate user role
    if ($role != ''){
        include $_SERVER['DOCUMENT_ROOT'].'/agriculture/includes/header.php'; // Get header
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../styles/title.css">
    <style>
        .content{
            align-items: center;
        }
        p.desc{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            margin-left: 10vw;
            margin-right: 9vw;
            font-size: 1.5vw;
        }
        table.contact-info{
            align-content: center;
            justify-content: center;
            width: 80%;
            height: 30vw;
            border: 0.1px solid;
        }
        div.contact-table{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        h1{
            color: midnightblue;
            text-align: center;
            font-size: 6vw;
            margin: 7vh 0vw;
        }
        table.contact-info td{
            width: 37%;
        }
        table.contact-info td{
            font-size: 1.5vw;
        }
        .contact-title{
            color: darkblue;
            font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            font-size: 2vw;
            line-height: 4vw;
        }
        #partner{
            line-height: 2;
        }
        a:hover{
            background-color: oldlace;
        }
        img.contact-icon{
            margin-right: 4%;
            width: 5%;
        }
        td#web_name{
            color: blue;
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-weight: bold;
            font-size: 150%;
            cursor: default;
        }
    </style>
</head>
<body>
    <h1>Contact Us</h1>
    <div class="content">
        <p class="desc">If you encounter any issue or have feedback 
            with the website, feel free to contact us and we will be glad to assist you. </p>
        <div class="contact-table"> 
            <table class="contact-info">
                <tr class="contact-info">
                    <td rowspan="3" class="contact-title" id="web_name">&nbsp;&nbsp;&nbsp;Vege e-Market</td>
                    <td><span class="contact-title">Phone number</span><br><img class="contact-icon" src="../images/phone.jpg" alt="phone"><a href="tel:+60123456789">+60123456789</a></td>
                    <td rowspan="2"><span class="contact-title">Operating Hours</span><br>[UTC +8] 09:00-18:00<br>(Monday to Sunday)</td>
                </tr>
                <tr class="contact-info">
                    <td><span class="contact-title">Email</span><br><img class="contact-icon" src="../images/email.jpeg" alt="phone"><a href="mailto:help@vegemarket.my">help@vegemarket.my</a></td>
                </tr>
                <tr class="contact-info">
                    <td><span class="contact-title">WhatsApp</span><br><img class="contact-icon" src="../images/whatsapp.jpg" alt="phone"><a href="https://api.whatsapp.com/send?phone=60123456789" target="_blank">Click Here to Chat</a></td>
                </tr>
            </table>
        </div><br>  
        <p class="desc" id="partner">Looking for a partnership opportunity with <b>Vege e-Market</b>? <br>Email us at <a href="mailto:partner@vegemarket.my">partner@vegemarket.my</a>.</p>
    </div>
</body>
</html>
<?php include $_SERVER['DOCUMENT_ROOT'].'/agriculture/includes/footer.php'; ?>