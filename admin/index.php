<?php 
    require '../modules/config.php'; // Validate user role
    if ($role !='admin'){
        header('Location: ../index.php');
    }
    
    include '../includes/header.php'; // Get header
    
    $user_list_length =0;
    $product_list_length=0;

    // Count number of useers
    $user_list = mysqli_query($conn, "SELECT * FROM users WHERE role != 'admin'; ");
    if ($user_list){
        $user_list_length = mysqli_num_rows($user_list);
    }

    // Count number of products
    $product_list = mysqli_query($conn, "SELECT * FROM products");
    if ($product_list){
        $product_list_length = mysqli_num_rows($product_list);
    }

    // Count number of orders
    $order_list = mysqli_query($conn, "SELECT * FROM orders");
    if ($order_list){
        $order_list_length = mysqli_num_rows($order_list);
    }

    // Count total spending
    $total_spend = mysqli_query($conn, "SELECT SUM(agreedPrice) as totalspend FROM orders_products");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage - Admin</title>
    <link rel="stylesheet" href="../styles/title.css">
    <style>
        #up_card, #mid_card{
            align-self: center;
            float: left;
            background-color: oldlace;
            width: 40vw;
            text-align: center;
            border-radius: 25px;
        }
        div.manage_user{
            margin-left: 5vw;
            margin-right: 3vw;
        }
        .card_title{
            font-size:  max(14px, max(2vw, 12px));
            line-height: 1px;
            font-family: Arial, Helvetica, sans-serif;
            margin-left: 2vw;
            white-space: nowrap; 
            text-overflow: ellipsis;
        }
        .card_desc{
            font-size:  max(12px, 1vw);
            font-family:Verdana, Geneva, Tahoma, sans-serif;
        }
        span.card_desc{
            font-family: 'Courier New', Courier, monospace;
        }
        button.index-button{
            background-color: darkgreen;
            font-size: 1em;
            font-weight: bolder;
            color: white;
            border: none;
            width: 20%;
            height: 30px;
        }
        button.index-button:hover{
            cursor: pointer;
            background-color: mediumseagreen;
            font-weight: lighter;
        }
        #mid_card{
            width: 83vw;
            margin-left: 5vw;
            margin-top: 1vw;
            margin-bottom: 1vw;
        }
        table.info-table{
            margin-left: 50px;
            max-width: 83vw;
            border-spacing: 10px;
            font-size: 1.2vw;
        }
        table.info-table th, table.info-table td{
            padding-right: 100px;
            text-align: center;
            padding-right: 70px;
            border-spacing: 10px;
        }
        tr.customer > th, tr.customer > td{
            text-align: center;
            padding-right: 70px;
            border-spacing: 10px;
        }
        table.customer{
            font-size: 1.2vw;
            margin-left: 20px;
            line-height: 200%;
        }
        .product_name{
            width: 60%;
        }
        div.top_selling, div.mvc{
            background-color: oldlace;
            margin-left: 5vw;
            max-height: 30vw;
            overflow-x: scroll;
            overflow-y: scroll;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 1vw;
        }
        div.mvc{
            max-width: 50vw;
            margin-right: 3vw;
            float: left;
            border-radius: 25px;
            width: 35vw;
            height: 40%;
        }
        div.conclusion{
            margin-top: 3vw;
            text-align: center;
            float: right;
            margin-right: 10vw;
            width: 30vw;
            background-color: oldlace;
            border-radius: 25px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 1.3vw;
        }
        #title{
            color: darkgreen;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <p style="clear:both;"></p>
        <h1 id="title">Administration Page</h1>
        <p id="title">Admin HomePage</p>
        <br>
        <div class="manage_user" id="up_card">
            <h3 class="card_title" style="text-align: center;">Manage Users</h3>
            <p class="card_desc">Manage the <b>users</b> in this website</p>
            <span class="card_desc" >&nbsp;Total users: <b><?php echo $user_list_length; ?></b> </span><br><br>
            <button class="index-button" onclick="window.location.href='../admin/console.php?type=user';" title="Go to User Management page">GO!</button>

            <br>&nbsp;
        </div>
        <div class="manage_product" id="up_card">
            <h3 class="card_title" style="text-align: center;">Manage Products</h3>
            <p class="card_desc">Manage the <b>products</b> in this website</p>
            <span class="card_desc" >&nbsp;Total products: <b><?php echo $product_list_length; ?></b> </span><br><br>
            <button class="index-button" onclick="window.location.href='../admin/console.php?type=product';" title="Go to Product Management page">GO!</button>
            <br>&nbsp;
        </div>
        <div class="top_selling" id="mid_card">
            <h3 class="card_title" style="text-align: left;">Top Selling Products</h3>
            <table class="info-table">
                <thead>
                    <?php if ($product_list_length){ ?>
                        <tr>
                            <th></th>
                            <th class="product_name">Product Name</th>
                            <th>Category</th>
                            <th>Sold</th>
                            <th>Supplier</th>
                        </tr>
                    <?php } ?>
                </thead>
                <tbody>
                    <?php 
                        $count=1;
                        if ($product_list_length){
                            $sql="SELECT products.productID, COUNT(orders_products.productID) as sold, products.category, products.productName, users.userName as supplierName 
                                    FROM products LEFT JOIN orders_products ON products.productID=orders_products.productID JOIN users ON products.userID=users.userID 
                                    WHERE products.availabilityStatus!= 'deleted'
                                    GROUP BY products.productID ORDER BY sold DESC LIMIT 5";
                            $products=mysqli_query($conn, $sql);
                            while($product_info=mysqli_fetch_array($products)) {
                                $id=$product_info['productID'];
                                echo "<tr><td> $count </td>";
                                echo "<td class='product_name'>"."<a href='../public/product.php?id=$id' style='color:darkgreen;'>".$product_info['productName']."</a></td>";
                                echo "<td>".$product_info['category']."</td>";
                                echo "<td>".$product_info['sold']."</td>";
                                echo "<td>".$product_info['supplierName']."</td>";
                                echo "</tr>";
                                $count++;
                            }
                        }else{
                            echo "<br><p>No available content</p>";
                        }
                    ?>
                </tbody>
            </table>
            <br>&nbsp;
        </div>
        <div class="mvc" >
            <h3 class="card_title" style="text-align: left;">Most Valuable Customers</h3>
            <table class="customer">
                <thead>
                    <?php if ($user_list_length){ ?>
                        <tr class="customer">
                            <th></th>
                            <th>Customer Name</th>
                            <th>No. of Orders</th>
                        </tr>
                    <?php } ?> 
                </thead>
                <tbody>
                    <?php
                        $count=1;
                        if ($user_list_length){
                            $sql = "SELECT users.userName as consumerName, COUNT(orders.orderID) as num_of_orders FROM users 
                                    LEFT JOIN orders ON users.userID = orders.userID 
                                    WHERE users.role = 'consumer' 
                                    GROUP BY users.userName 
                                    ORDER BY num_of_orders DESC
                                    LIMIT 5;";
                            $users=mysqli_query($conn, $sql);
                            while ($user_info=mysqli_fetch_array($users)){
                                echo "<tr class='customer'>"; 
                                echo "<td >$count. </td>";
                                echo "<td >".$user_info['consumerName']."</td>";
                                echo "<td >".$user_info['num_of_orders']."</td>";
                                echo "</tr>"; 
                                $count++;  
                            }
                            
                        }else{
                            echo "<br><p>No available content</p>";
                        } 
                    ?>
                </tbody>
            </table>
            <br>&nbsp;
        </div>
        <div class="conclusion" id="down_card">
            <br>
            <ul style="list-style: none;">
                <li>Number of Orders: <b><?php echo $order_list_length;?> </b></li><br>
                <li>Transaction total: <b>RM <?php 
                                        $total=mysqli_fetch_array($total_spend);
                                        echo $total['totalspend'];
                                    ?></b></li>
            </ul>
            <br>
        </div>
    </div>
    <br style="clear:both;">
    </body>

</html>
<?php include '../includes/footer.php'; ?>