<?php
    require '../modules/config.php'; // Validate user role
    if ($role !='consumer'){
        header('Location: ../index.php');
        die;
    }

    
        $sql = "SELECT products.imgPath, products.productName, products.priceLabel
            FROM products
            JOIN cart_product ON products.productID = cart_product.productID
            JOIN cart ON cart_product.cartID = cart.cartID
            JOIN users ON cart.userID = users.userID";
                

    $cart = mysqli_query($conn, $sql);
           
    
   

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
        img.delete {
            width: 25px;
            height: 25px;
        }
        .box{
            width: 500px;
            height: 500px;
            background-color:gray;
            float:flex;
            clear:both;
            margin-left:200;
        }
        .h2-box {
            background-color: #eee;
            padding: 5px; 
            float:left;
            
            margin:15px;
            
        }
        .checkout{
            background-color: black;
            padding: 5px; 
            
            font-color:white;
            margin:15px;
            
        }
        .clear{
            float:right;
            clear:both;
        }
        .right{
        margin-left: 100px; 
    }


    </style>
</head>

<body>
    <h1 id="title"><strong>Consumer Page</strong></h1>
    <p id="title">My Cart</p>
    <div>
        <h2 class="h2-box">My Cart</h2>
    </div>

    <div class="box right">  
        <tr>
            <th>Item Image</th>
            <th>Item Name</th>
            <th>Price Label</th>
            <th>Delete </th>
        </tr>
        <?php 
            while($row = mysqli_fetch_array($cart)){
                echo '<tr>';
                echo $row['products.imgPath'];
                echo '<td>'.$row['products.productName'].'</td>';
                echo '<td>'.$row['products.priceLabel'].'</td>';
                echo '<td><a href="cart_delete.php?id='.$row['productid'].'">Delete</a></td>';
                       
                
                echo '</tr>';
            }
        ?>
    </div>

     <p class="right">Number of items selected -</p>

    <div class="clear">
        <p>RM-</p>
        <div class="checkout clear">
        <a href ="checkout.php" target="_blank"><button type="button">Checkout</button></a>
        </div>
    </div>
    
     

</body>
</html>
<?php include '../includes/footer.php';?>
