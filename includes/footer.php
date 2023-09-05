<?php 
    require $_SERVER['DOCUMENT_ROOT'].'/config.php'; 
?>
<br>
<footer>
    <style>
        footer{
            background-color: #2E2E2E;
            text-align: left;
            clear: both;
        }
        table#footer{
            width: 100%;
            height: 6%;
            font-family: 'Courier New', Courier, monospace;
        }
        td#footer{
            width: 50%;
            color: aliceblue;
        }
        td#footer-url > a{
            color: aliceblue;
            margin-left: 2vw;
            margin-right: 2vw;
        }
        span#footer-copyright, td#footer-url > a{
            margin-left: 0.5vw;
            font-family: 'Courier New', Courier, monospace;
            font-size: 80%;
        }
        td#footer-url{
            color:aliceblue;
            text-align: right;
            margin-right: 2%;
        }
        a.footer:hover{
            background-color: rgba(255,255,255,0.5);
        }
        span#footer-copyright, a.footer{
            font-size: 100%;
        }
    </style>
    <table id="footer">
        <tr id="footer">
            <td class="copyright" id="footer"><span id="footer-copyright">Copyright © 2023 Vege e-Market. All rights reserved.</span></td>
            <td class="footer-url" id="footer-url">
                <a style="font-size: 100%;" href="<?php echo $base_role.'/index.php'; ?>" class="footer">Home</a> |
                <a style="font-size: 100%;" href="<?php echo $base.'/about.php'; ?>" class="footer">About Us</a> | 
                <a style="font-size: 100%;" href="<?php echo $base.'/contact.php'; ?>" class="footer">Contact</a>
            </td>
        </tr>
    </table>
</footer>