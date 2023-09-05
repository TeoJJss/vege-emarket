<?php
    $base = 'http://'.$_SERVER['HTTP_HOST']; // Base URL, e.g. localhost'; 
    // $role = '';
    if (isset($_SESSION['role'])){
        $role=$_SESSION['role'];
    }else{
        $role='';
    }
    $role='admin';
    if ($role != ''){
        $base_role="$base/$role";
    }else{
        $base_role=$base;
    }
?>