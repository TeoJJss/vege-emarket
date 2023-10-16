<?php
    require '../modules/config.php'; // Validate user role
    if ($role !='consumer'){
        header('Location: ../index.php');
        die;
    }

    include '../includes/header.php';
?>


<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="../styles/title.css">
    <style>
    
    </style>
</head>

<body>
    <div>
        <h1 id="title">Consumer page</h1>
        <p>Homepage</p>

    </div>
    <a href="orderhistory.php" target ="_blank"><u>Order History</u></a>
    <a href="cart.php" target="_blank">
    <button><img src="images/cart.png"></button></a>

    <form action="index.php" method="get">
    <input type="text" name="quantity">
    <input type="submit" value="search">
    </form>
    
    <div>
        <a href="searchresults.php" target="_blank" >
            <button type="Button">Categories<button>
        </a>
    </div>
</body>
</html>
<?php include '../includes/footer.php';?>