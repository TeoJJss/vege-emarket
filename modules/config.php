<?php
    echo '<link rel="shortcut icon" type="image/png" href="../images/favicon.png">'; // Put tab icon
    $base = 'http://'.$_SERVER['HTTP_HOST'].'/vege-emarket'; // Base URL, e.g. localhost'; 
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

    // session_start();
    if (isset($_SESSION['role'])){
        // If user has login, use the data from DB
        $role=$_SESSION['role']; 
        $username = $_SESSION['username'];
    }else{
        $role=''; // Otherwise, the user is guest
    }

    $role='admin'; $user_id='U03'; // Remove this line later
?>