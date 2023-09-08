<?php
    require $_SERVER['DOCUMENT_ROOT'].'/config.php';

    if ($role!=''){
        header("Location: $role/index.php");
    }else{
        header("Location: login.php");
    }
        
?>