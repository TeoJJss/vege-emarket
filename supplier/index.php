<?php
    require '../modules/config.php'; // Validate user role
    if ($role !='supplier'){
        header('Location: ../index.php');
        die;
    }

    include '../includes/header.php'; // Get header

    //Count number of products
    $product_list = mysqli_query($conn, "SELECT * FROM products WHERE products.userID='$user_id'");
    if ($product_list){
        $product_list_length = mysqli_num_rows($product_list);
    }else{
        $product_list_length = 0;
    }

    // Count number of orders
    $order_list = mysqli_query($conn, "SELECT * FROM orders");
    if ($order_list){
        $order_list_length = mysqli_num_rows($order_list);
    }else{
        $order_list_length = 0;
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage - Supplier</title>
    <link rel="stylesheet" href="../styles/title.css">
    <style>
        #card{
            align-self: center;
            float: left;
            background-color: beige;
            width: 40vw;
            height: 70%;
            border-radius: 25px;
            margin-left: 5vw;
            margin-bottom: 2vw;
            display: flex;
            flex-direction: column;
        }
        .card_title{
            font-size:  max(14px, max(2vw, 12px));
            line-height: 1px;
            font-family: Arial, Helvetica, sans-serif;
            margin-left: 2vw;
        }
        .button{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }
        button.product-button{
            position: absolute;
            bottom: 10px;
            background-color: darkgreen;
            font-size: 1em;
            font-weight: bolder;
            color: white;
            border: none;
            width: 10%;
            height: 30px;
            border-radius: 5px;
            bottom: 10vh;
            position: fixed;
            align-self: center;
        }
        button.product-button:hover{
            cursor: pointer;
            background-color: mediumseagreen;
            font-weight: bolder;
        }
        .product_name{
            max-width: 50%;
            overflow: hidden;
        }
        .product_status{
            width: 20%;
        }
        table.product_table{
            margin-left: 35px;
            max-width: 90%;
            line-height: 2;
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        table.product_table th{
            text-align: center;
            font-size: 1.4vw;
        }
        table.product_table td{
            text-align: center;
            font-size: 1.2vw;
            line-height: 2;
            overflow-x: hidden;
            max-width: 48px;
        }
        table.orders_table{
            max-width: 95%;
            margin-left: 20px;
            line-height: 1.6;
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        table.orders_table th{
            text-align: center;
            font-size: 1.4vw;
        }
        table.orders_table td{
            border-bottom: 1px solid darkgreen;
            text-align: center;
            font-size: 1.2vw;
            word-wrap: break-word;
            max-width: 48px;
        }
        #order_details_td{
            font-size: 1vw;
            text-align: left;
            padding-left: 4%;
        }
        .order_details{
            width: 35%;
        }
        div.product_stock, div.incoming_orders{
            position: relative;
            max-height: 35vw;
            height: 100%;
            overflow: auto;
        }
    </style>
</head>
<body>
    <div>
        <p style="clear:both;"></p>
        <h1 id="title">Supplier Page</h1>
        <p id="title">Supplier HomePage</p>
        <br>
        <div class="product_stock" id="card">
            <h3 class="card_title" style="text-align: left;"><img src="../images/stock.png" alt="Stock Management" width="5%"> Product Stock</h3>
            <table class="product_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class = "product_name">Name</th>
                        <th class = "product_price">Price</th>
                        <th class = "product_status">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($product_list_length){
                            $product_sql = "SELECT products.productID, products.productName, products.availabilityStatus, products.priceLabel, products.unit
                                            FROM products WHERE products.availabilityStatus != 'deleted' AND products.userID='$user_id'
                                            ORDER BY productID ASC";
                            $products = mysqli_query($conn,$product_sql);
                            while($product_status = mysqli_fetch_array($products)) {
                                $id = $product_status['productID'];
                                echo "<tr><td>".$product_status['productID']."</td>";
                                echo "<td class='product_name'>"."<a href='../public/product.php?id=$id' style='color:darkgreen;'>".$product_status['productName']."</a></td>";
                                echo "<td>RM".$product_status['priceLabel'].'/'.$product_status['unit']."</td>";
                                if ($product_status['availabilityStatus']=="available"){
                                    echo "<td>"."<img src= '../images/available_status.png' height='28'"."</td>";
                                }
                                else if ($product_status['availabilityStatus']=="out of stock") {
                                    echo "<td class='product_status'>"."<img src= '../images/outofstock_status.png' height='24'>"."</td>";
                                }
                                else if ($product_status['availabilityStatus']=="banned") {
                                    echo "<td>".'<span style ="color: red;">Banned</span>';
                                }
                                echo "</tr>";
                            }
                        }else{
                            echo "<tr><center><p style='color:red;'>No product advertised</p><center></tr>";
                        }
                    ?>
                </tbody>
            </table>
            <div class="button">
                <button class="product-button" onclick="window.location.href='../supplier/myproducts.php';" title="My Products Page">My Products</button>
            </div>
            <br>
        </div>
    </div>

    <div class="incoming_orders" id="card">
        <h3 class="card_title" style="text-align: left;"><img src="../images/order.png" alt="Orders" width="5%"> Incoming Orders</h3>
        <table class="orders_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th class = 'order_details'>Order Details</th>
                    <th>Remark</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($order_list_length){
                        $order_sql = "SELECT orders.orderID, users.userID, users.userName, orders.orderDate, orders.address, orders_products.remark
                                      FROM orders 
                                      INNER JOIN orders_products ON orders.orderID=orders_products.orderID 
                                      INNER JOIN users ON orders.userID = users.userID 
                                      INNER JOIN products ON products.productID=orders_products.productID
                                      WHERE products.userID='$user_id'
                                      ORDER BY orders.orderDate DESC";
                        $orders = mysqli_query($conn, $order_sql);
                        while($order_info=mysqli_fetch_array($orders)) {
                            echo "<tr><td>".$order_info['orderID']."</td>";
                            echo "<td>".$order_info['userName']."</td>";
                            echo "<td id='order_details_td'><b>Customer ID:</b> ".$order_info['userID']."<br><b>Order Date:</b> ".$order_info['orderDate']."<br><b>Address:</b> ".$order_info['address']."</td>";
                            echo "<td>".$order_info['remark']."</td>";
                            echo "</tr>";
                        }
                    }else{
                        echo "<tr><center><p style='color:red;'>No received orders</p><center></tr>";
                    }
                ?>
            </tbody>
        </table>
        <button class="product-button" onclick="window.location.href='../supplier/myorders.php';" title="My Orders Page">My Orders</button>
    </div>
</body>


</html>
<?php include '../includes/footer.php';?>