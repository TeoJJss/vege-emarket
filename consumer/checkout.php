<?php
    require '../modules/config.php'; // Validate user role
    if ($role !='consumer'){
        header('Location: ../index.php');
        die;
    }

    include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out</title>
    <link rel="stylesheet" href="../styles/title.css">
    <style>
    
    </style>
</head>
<body>
    <h1 id="title"><strong>Consumer Page</strong></h1>
    <p>Checkout</p>
    <div>
        <p>Delivery address</p>
    </div>
    <div>
        Total price:RM-
        <button type="button">Place Order</button>
    </div>
    
</body>
</html>
<?php include '../includes/footer.php';?>