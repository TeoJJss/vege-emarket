<?php
    require '../modules/config.php'; // Validate user role
    if ($role !='supplier'){
        header('Location: ../index.php');
        die;
    }

    include '../includes/header.php'; // Get header
    if (isset($_GET['q'])){
        $search_value="AND (customers.userName LIKE '%$_GET[q]%' OR products.productName LIKE '%$_GET[q]%')";
    }else{
        $search_value="";
    }

    $sql = "SELECT customers.userName AS customerName, customers.email AS customerEmail, customers.phone AS customerPhone, orders.orderID, products.productName, 
                    orders.address, orders_products.agreedPrice, orders_products.status, orders.orderDate, orders_products.remark, orders_products.productID 
            FROM users AS customers
            JOIN orders ON customers.userID = orders.userID
            JOIN orders_products ON orders.orderID = orders_products.orderID
            JOIN products on orders_products.productID = products.productID
            JOIN users AS suppliers ON products.userID = suppliers.userID
            WHERE suppliers.userID = '$user_id' $search_value
            ORDER BY orders.orderDate DESC";
    $orders = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Orders</title>
    <link rel="stylesheet" href="../styles/title.css">
    <style>
        a{
            color: green;
        }
        .page-container{
            display: flex;
            align-items: center;
            flex-direction: column;
            margin-left: 2vw;
            margin-right: 2vw;
            min-height: 70%;
            overflow: auto;
        }
        .order-container{
            background-color: beige;
            padding: 20px;
            padding-bottom: 10px;
            width: 60%;
            box-sizing: border-box;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center; 
        }
        table.order-header {
            border-spacing: 0;
        }
        table.order-header td{
            border-bottom: 2px solid green;
            font-weight: normal;
            font-size: 1.2vw;
            padding-bottom: 15px;
            max-width: 18vw;
            vertical-align: top;
            padding-left: 50px;
        }
        table.order-header, table.order-content{
            font-size: 1.4vw;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            min-width: 100%; 
            padding-top: 20px;
        }
        td.order-id{
            text-align: center;
        }
        td.customer-name{
            width: 20%;
            font-size: 2vw;
        }
        td.product-name{
            color: green;
            font-size: 2vw;
            width: 34%;
        }
        td.order-date{
            width: 34%;
        }
        tr.second-row  td{
            text-align: center;
        }
        td.status{
            display: flex;
            justify-content: center;
        }
        td.customer-name, td.customer-contacts{
            text-align: left;
        }
        tr.third-row td{
            padding-top: 40px;
            text-align: center;
            vertical-align: top;
            min-height: 100px;
            max-width: 18vw;
            word-wrap: break-word;
        }
        .submit-button {
            background-color: darkgreen;
            font-size: 0.8vw;
            color: white;
            border: none;
            width: 130px;
            height: 30px;
            border-radius: 5px;
            margin-top: 5px;
            margin-left: 5px;
        }
        .submit-button:hover{
            cursor: pointer;
            background-color: mediumseagreen;
            font-weight: bolder;
        }
        select.status-dropdown {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 1.2vw; 
            color: black; 
            cursor: pointer;
            text-align: center;
        }
        select.status-dropdown option[value="paid"] {
            background-color: lightsteelblue;
        }

        select.status-dropdown option[value="shipped"] {
            background-color: orange;
        }

        select.status-dropdown option[value="delivered"] {
            background-color: palegreen;
        }
        div.search-container{
            display: flex;
            align-items: center;
        }
        input.order-search-input{
            width: 23vw;
            font-size: 1vw;
            height: 2.5vw;
            min-height: 2vw;
        }
        button.search-button{
            cursor: pointer;
            height: 2.5vw;
            min-width: 2vw;
            width: fit-content;
            font-size: 1.5vw;
        }
        small#search-term{
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1 id="title">Supplier Page</h1>
    <p id="title">My Orders</p>
    <div class="page-container">
            <div class="search-container">
                <input type="text" class="order-search-input" id="order-search-input" placeholder="Search orders by customer name or product name" 
                        onkeypress="if(event.key == 'Enter'){search()}" value="<?php 
                                                                                    if (isset($_GET['q'])){
                                                                                        echo $_GET['q']; 
                                                                                    }
                                                                                ?>" 
                                                                                autofocus>
                <button class="search-button" onclick="search()" title="Press Enter or click me to search">🔍</button>
            </div>
            <?php 
                if ($search_value!=""){
                    echo "<small id='search-term'>Search term: '$_GET[q]'</small>";
                }
            ?><br>
            <?php
                if (mysqli_num_rows($orders)==0){
                    echo "<center><b>Nothing found</b></center>";
                }
                while($order_info = mysqli_fetch_array($orders)) {
                    echo '<div class="order-container">';
                    echo '<table class="order-header">';
                    echo '<tbody>';
                    echo '<tr class="first-row">';
                    echo '<td class="customer-name">'.$order_info['customerName'].'</th>';
                    echo '<td class="customer-contacts"><a href="tel:'.$order_info['customerPhone'].'">'.$order_info['customerPhone'].'</a><br>';
                    echo '<a href="mailto:'.$order_info['customerEmail'].'">'.$order_info['customerEmail'].'</a></th>';
                    echo '<td class="order-id"><b>Order ID: </b>'.$order_info['orderID'].'</th>';
                    echo '</tr>';
                    echo '</tbody>';
                    echo '</table>';
                    echo '<table class="order-content">';
                    echo '<tbody>';
                    echo '<tr class="second-row">';
                    echo "<td class='product-name'><a href='../public/product.php?id=$order_info[productID]'>".$order_info['productName'].'</a></td>';
                    echo '<td class="product-price"><b>RM </b>'.$order_info['agreedPrice'].'</td>';
                    echo '<td class="order-date"><b>Date: </b>'.$order_info['orderDate'].'</td>';
                    echo '</tr>';
                    echo '<tr class="third-row">';
                    echo '<td class="address"><b>Address: </b><br>'.$order_info['address'].'</td>';
                    echo '<td class= "status">';
                    
                    // Dynamic field for order status
                    echo '<div class="select-css">';
                    echo '<form method= "POST" action="../modules/status_update.php">';
                    echo '<select class="status-dropdown" name="status" data-order-id="' . $order_info['orderID'] . '" style="background-color: ';
                        if ($order_info['status'] === 'paid') {
                            echo 'lightsteelblue';
                        } elseif ($order_info['status'] === 'shipped') {
                            echo 'orange';
                        } elseif ($order_info['status'] === 'delivered') {
                            echo 'palegreen; cursor: not-allowed;';
                        }
                    echo '">';
                    echo '<option value="shipped" ' . ($order_info['status'] === 'shipped' ? 'selected' : '') . ($order_info['status'] === 'delivered' ? 'disabled' : '') . '>SHIPPED</option>';
                    echo '<option value="paid" ' . ($order_info['status'] === 'paid' ? 'selected' : '') . ($order_info['status'] === 'delivered' ? 'disabled' : '') . '>PAID</option>';
                    echo '<option value="delivered" ' . ($order_info['status'] === 'delivered' ? 'selected' : '') . ' disabled>DELIVERED</option>';
                    echo '</select>';
                    echo '<br>';
                    echo '<input type="hidden" name = "order_id" value="'. $order_info['orderID'].'">';
                    echo '<input type="hidden" name = "product_id" value="'. $order_info['productID'].'">';
                    echo '<input type="submit" class="submit-button" value="Confirm Update"'.($order_info['status'] === 'delivered' ? 'disabled style="cursor: not-allowed;"' : ''). '>';
                    echo '</form>';
                    echo '</div>';

                    echo '</td>';
                    echo '<td class="remark"><b>Remark: </b><br>'.$order_info['remark'].'</td>';
                    echo '</tr>';
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div><br>';
                }
            ?>
        </div>
    </div>
    <script>
        function search(){
            var input = document.getElementById("order-search-input").value;
            window.location.href="myorders.php?q="+input
        }
    </script>
</body>
</html>
<?php include '../includes/footer.php'; ?>