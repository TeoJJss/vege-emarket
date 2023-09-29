<?php 
    function err_handler($err_code, $err_msg, $file_dir, $line_no){
        $filename= basename($file_dir); //Get the filename from file directory
        echo "<center style='font-family: Arial'><h1 style='color:red;'>Something went wrong!</h1> <br> $err_code $err_msg";
        echo "<p>at $filename, line $line_no</p><br>";

        echo "If you think this is a mistake, copy the message above and email to 
                <a href='mailto:assist@vegemarket.com'>assist@vegemarket.com</a>.</center>";
    }
    set_error_handler("err_handler");
?>