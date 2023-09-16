<?php 
    require '../modules/config.php';
?>
<br><br>
<footer>
    <style>
        footer{
            background-color: #2E2E2E;
            text-align: left;
            clear: both;
            max-width: 100%;
            max-height: 100%;
            height: 3%;
        }
        table#footer{
            width: 100%;
            height: 6%;
            max-width: 100%;
            max-height: 100%;
            min-height: max-content;
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
            font-size: 20vw;
        }
        span#footer-copyright, td#footer-url > a{
            margin-left: 0.5vw;
            font-family: 'Courier New', Courier, monospace;
            
        }
        td#footer-url{
            clear:both;
            color:aliceblue;
            text-align: right;
            margin-right: 2%;
        }
        a.footer:hover{
            background-color: rgba(255,255,255,0.5);
        }
        span#footer-copyright{
            font-size: 1vw;
        }
    </style>
    <table id="footer">
        <tr id="footer">
            <td class="copyright" id="footer"><span id="footer-copyright">Copyright © 2023 Vege e-Market. All rights reserved.</span></td>
            <td class="footer-url" id="footer-url">
                <a style="font-size: 1vw;" href="<?php echo $base.'/index.php'; ?>" class="footer">Home</a> |
                <a style="font-size: 1vw;" href="<?php echo $base.'/public/about.php'; ?>" class="footer">About Us</a> | 
                <a style="font-size: 1vw;" href="<?php echo $base.'/public/contact.php'; ?>" class="footer">Contact</a>
            </td>
        </tr>
    </table>
</footer>