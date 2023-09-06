<?php
    $base = 'http://'.$_SERVER['HTTP_HOST']; // Base URL, e.g. localhost'; 
    $role = '';
    
    // below are dummy data, records will be obtained from DB later
    $username = 'test'; 
    $gender = "male";
    $birthday = "2002-02-02";
    $email = "test@example.com";
    $phone = "011111111";
    $role = "Consumer"; 

    if (isset($_SESSION['role'])){
        // If user has login, use the data from DB
        $role=$_SESSION['role']; 
        $username = $_SESSION['username'];
    }else{
        $role=''; // Otherwise, the user is guest
    }

    $role='admin'; // Remove this line later
    
    // Set the base url with role, e.g. localhost/admin
    if ($role != ''){
        $base_role="$base/$role";
    }else{
        $base_role=$base;
    }
?>