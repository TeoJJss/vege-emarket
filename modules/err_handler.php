<?php 
    function err_handler($err_code, $err_msg, $file_dir, $line_no){
        $filename= basename($file_dir); //Get the filename from file directory
        echo "<title>Error!</title>";
        echo '<center style="font-family: Arial; margin-top: 6vh;"><a href="../index.php"><img src="../images/logo.png"></a>
                <br><br><img src="../images/something-went-wrong.png" alt="Something went wrong" width="20%">';
        echo "<h1 style='color:red;'>Something went wrong!</h1> <br> $err_code $err_msg";
        echo "<p>at $filename, line $line_no</p><br>";

        echo "If you think this is a mistake, copy the message above and email to 
                <a href='mailto:assist@vegemarket.com' style='color: green;'>assist@vegemarket.com</a>.";
        echo "</center>";
    }
    set_error_handler("err_handler");
?>