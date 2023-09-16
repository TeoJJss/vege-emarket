<?php
    require './modules/config.php';

    if ($role!=''){
        header("Location: $base/$role/index.php");
    }else{
        header("Location: $base/public/login.php");
    }
        
?>