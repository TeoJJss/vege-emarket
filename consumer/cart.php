<?php
    require '../modules/config.php'; // Validate user role
    if ($role !='consumer'){
        header('Location: ../index.php');
        die;
    }
    $sum=0;
    $sql = "SELECT products.imgPath, products.productName, products.priceLabel, products.productID
            FROM products
            JOIN cart_product ON products.productID = cart_product.productID
            JOIN cart ON cart_product.cartID = cart.cartID
            JOIN users ON cart.userID = users.userID
            WHERE cart.userID='$user_id'";
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
        div.cart-wrapper{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            margin: 50px;
            margin-top: 3px;
        }
        div.product-list{
            font-size: 2.7vh;          
            margin-top: 1.5%;  
            padding: 3vw;
            padding-left: 4vw;
            max-width: 80vw;
        }
        div.product-list table{
            border-spacing: 30px;
            background-color: palegreen;
            min-width: 100%;
            max-width: 100%;
            
        }
        div.product-list thead{
            font-size: 2.5vw;
        }
        div.product-list th, div.product-list td{
            padding-right: 80px;
            text-align: center;
            font-size: 25px;
        }
        img.product-img{
            min-height: 200px;
            max-height: 200px;
            min-width: 250px;
            max-width: 250px;
        }
        div.product-list a{
            color: #006400;
            font-weight: bold;
        }
        button.delete_button{
            width: max-content;
            height: 50px;
            cursor: pointer;
        }
        button.delete_button:hover{
            background-color: red;
        }
        img.delete_img {
            width: 25px;
            height: 25px;
        }
        div.end-part{
            margin-left: 10vw;
        }
        div.end-part td{
            font-size: 1.5vw;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        button.checkout-btn{
            font-size: 1.5vw;
            text-align: center;
            min-width: 11vw;
            min-height: 7vh;
            cursor: pointer;
            background-color: darkgreen;
            font-weight: bold;
            color: white;
            border: none;
        }
        button.checkout-btn:hover{
            font-size: 1.7vw;
            background-color: green;
            color: black;
        }
    </style>
</head>

<body>
    <h1 id="title"><strong>Consumer Page</strong></h1>
    <p id="title">My Cart</p>
    <div class="cart-wrapper">
        <div class="product-list">
            <table>
                <thead>
                    <th>Product image</th>
                    <th>Item name</th>
                    <th>Price label</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($cart)<1){
                        echo '<h2>Nothing in the cart!</h2>';
                    }
                    while ($item=mysqli_fetch_array($cart)){?>
                        <tr>
                            <td><a href="../public/product.php?id=<?php echo $item['productID'] ?>"><img src="../assets/<?php echo $item['imgPath'];?>" alt="<?php echo $item['productName'] ?>" class="product-img"></a></td>
                            <td><a href="../public/product.php?id=<?php echo $item['productID'] ?>"><?php echo $item['productName'] ?></a></td>
                            <td>RM <?php echo $item['priceLabel'] ?></td>
                            <td><button onclick="location.href='../modules/cart-delete.php?id=<?php echo $item['productID'] ?>'" class="delete_button"><img src="../images/trash.png" alt="Delete" class='delete_img'></button></td>
                        </tr>
                    <?php 
                        $sum+=floatval($item['priceLabel']);
                    } 
                    ?>
                </tbody>
            </table>
        </div>
        <div class="end-part">
            <table>
                <tr>
                    <td>Number of products: <?php echo mysqli_num_rows($cart);?></td>
                    <td style="padding-left:42vw;">
                        <span>Total Price: RM <?php echo $sum;?></span><br>
                        <button onclick="location.href='../consumer/checkout.php'" class="checkout-btn">Check Out</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
<?php include '../includes/footer.php';?>
