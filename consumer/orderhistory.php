<?php
    require '../modules/config.php'; // Validate user role
    if ($role !='consumer'){
        header('Location: ../index.php');
        die;
    }

    // If confirm receive
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        if (isset($_POST['confirm'])){
            $order_id = $_POST['orderID'];
            $product_id = $_POST['productID'];

            // Check if the consumer ID created the order
            $sql = "SELECT * FROM orders WHERE orders.orderID='$order_id' AND orders.userID = '$user_id'";
            if (mysqli_num_rows($result = mysqli_query($conn, $sql))>0) {
                $update_sql = "UPDATE orders_products
                                SET orders_products.status = 'delivered'
                                WHERE orders_products.orderID='$order_id'
                                AND orders_products.productID='$product_id'
                                AND orders_products.orderID IN (SELECT orders.orderID FROM orders WHERE orders.userID = '$user_id')";
                if (mysqli_query($conn, $update_sql)) {
                    echo "<script>alert('Update Success! ');</script>";
                }else{
                    trigger_error("Failed to Confirm Receive", E_USER_ERROR);
                }
            }
        }
    }

    $sql = "SELECT orders_products.orderID, products.productName, products.imgPath, orders_products.status, orders_products.agreedPrice, orders_products.remark, orders_products.productID, orders.orderDate 
            FROM orders_products
            LEFT JOIN orders ON orders_products.orderID = orders.orderID
            LEFT JOIN products ON orders_products.productID = products.productID
            WHERE orders.userID = '$user_id'
            ORDER BY orders.orderDate DESC";

    $order_list=mysqli_query($conn, $sql);
    
    include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="../styles/title.css">
    <style>
        div.order-wrapper{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            margin-left: 6vw;
        }
        img#product-image{
            min-width: 15vw;
            width: 15vw;
            min-height: 15vw;
            max-width: 15vw;
            max-height: 15vw;
            background-color: whitesmoke;
        }
        div.order-wrapper table{
            background-color: palegreen;
            min-width: 80vw;
            padding: 10px;
            max-width: 85vw;
            font-size: 1.5vw;
        }
        div.order-wrapper td{
            min-width: 5vw;
            max-width: 15vw;
            width: 20vw;
            text-align: center;
            padding: 10px;
            word-wrap: break-word;
        }
        div.order-wrapper a{
            color: darkgreen;
        }
        p.status{
            font-size: 1.2vw;
            max-width: 80px;
            min-width: fit-content;
            margin-left: 5vw;
        }
        input.confirm{
            float: right;
            margin-right: 10vw;
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
        input.confirm:hover{
            font-size: 1.6vw;
            background-color: green;
            color: black;
        }
    </style>
</head>
<body>
    <h1 id="title">Consumer page</h1>
    <p id="title">Order History</p><br>
    <div class="order-wrapper">
        <?php 
            if (mysqli_num_rows($order_list) < 1) {
                echo '<h2>Nothing in the Order History!</h2>';
            }
        ?>
        <?php while ($order=mysqli_fetch_array($order_list)){ 
            // Status Color
            if ($order['status']=='paid'){
                $status_color="lightsteelblue";
            }else if ($order['status']=='shipped'){
                $status_color="orange";
            }if ($order['status']=='delivered'){
                $status_color="yellow";
            }
            ?>
            <table>
                <tr>
                    <td>
                        <p><b>ID: </b><?php echo $order['orderID']; ?></p>
                        <a href="../public/product.php?id=<?php echo $order['productID'] ?>"><img src="../assets/<?php echo $order['imgPath'];?>" alt="Product image" id="product-image"></a><br>
                    </td>
                    <td>
                        <b>Product Name</b><br>
                        <p><a href="../public/product.php?id=<?php echo $order['productID'] ?>"><?php echo $order['productName']; ?></a></p>
                    </td>
                    <td>
                        <b>Status</b><br>
                        <p class="status" style="background-color: <?php echo $status_color; ?>"><?php echo ucfirst($order['status']); ?></p>
                    </td>
                    <td>
                        <b>Paid</b><br>
                        <p>RM <?php echo $order['agreedPrice']; ?></p>
                        <b>On</b><br><p><?php echo $order['orderDate']; ?></p>
                    </td>
                    <td>
                        <b>Remark</b><br>
                        <p><?php echo $order['remark']; ?></p>
                    </td>
                </tr>
            </table>
            <?php if ($order['status'] != 'delivered') {?>
                <form action="" method="post">
                    <input type="hidden" name="orderID" value="<?php echo $order['orderID']; ?>">
                    <input type="hidden" name="productID" value="<?php echo $order['productID']; ?>">
                    <input type="submit" name="confirm" class="confirm" value="Confirm Receive">
                </form>
            <?php } ?>
            <br><br><br>
        <?php } ?>
    </div>
</body>
</html>
<?php include '../includes/footer.php';?>