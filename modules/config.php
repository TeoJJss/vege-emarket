<?php
    $base = 'http://'.$_SERVER['HTTP_HOST'].'/agriculture'; // Base URL, e.g. localhost'; 
    $role = '';
    
    // Connection to Database
    $host="localhost";
    $user="root";
    $password="";
    $database="vegemarket";
    $conn=mysqli_connect($host, $user, $password,$database);
    if(mysqli_connect_errno()){
        die("Failed to connect to database."); //Terminate the website if no database
    }
    $web_name="Vege e-Market";

    // below are dummy data, records will be obtained from DB later
    $username = 'test'; 
    $gender = "male";
    $birthday = "2002-02-02";
    $email = "test@example.com";
    $phone = "011111111"; 
    // session_start();
    if (isset($_SESSION['role'])){
        // If user has login, use the data from DB
        $role=$_SESSION['role']; 
        $username = $_SESSION['username'];
    }else{
        $role=''; // Otherwise, the user is guest
    }

    $role='admin'; $user_id='U05'; // Remove this line later
?>