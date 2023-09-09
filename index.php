<?php
    require $_SERVER['DOCUMENT_ROOT'].'/modules/config.php';

    if ($role!=''){
        header("Location: $role/index.php");
    }else{
        header("Location: public/login.php");
    }
        
?>