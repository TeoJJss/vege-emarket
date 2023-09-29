<?php
    echo '<link rel="shortcut icon" type="image/png" href="../images/favicon.png">'; // Put tab icon
    $role = '';

    // Initiate Error handler
    include_once('../modules/err_handler.php');
    
    // Connection to Database
    $host="localhost";
    $user="root";
    $password="";
    $database="vegemarket";
    $conn=mysqli_connect($host, $user, $password,$database);
    if(mysqli_connect_errno()){
        die; //Terminate the website if no database
    }
    $web_name="Vege e-Market";

    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }
    if (isset($_SESSION['role'])){
        // If user has login, use the data from DB
        $role=$_SESSION['role']; 
        $username = $_SESSION['username'];
        $user_id=$_SESSION['user_id'];
    }else{
        $role=''; // Otherwise, the user is guest
    }
?>