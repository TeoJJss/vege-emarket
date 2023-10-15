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
    <title>Cart</title>
    <link rel="stylesheet" href="../styles/title.css">
    <style>
    
    </style>
</head>

<body>
    <h1 id="title"><strong>Consumer Page</strong></h1>
    <p>My Cart</p>
    <div>
        <h2>My Cart</h2>
    </div>

    <div>  
        <tr>
            <th>Item Image</th>
            <th>Item Name</th>
            <th>Price Label</th>
            <th>Action</th>
        </tr>
     </div>

     <p>Number of items selected -</p>

     <div>
        <p>RM-</p>
        <a href ="checkout.php" target="_blank"><button type="button">Checkout</button></a>

    </div>
    
     

</body>
</html>
<?php include '../includes/footer.php';?>
