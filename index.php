<?php
    session_start();
    if ($_SESSION['role']!=''){
        $role=$_SESSION['role'];
        header("Location: ./$role/index.php");
    }else{
        session_write_close();
        header("Location: ./public/index.php");
    }
?>