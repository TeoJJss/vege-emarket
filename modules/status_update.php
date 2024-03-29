<?php
    require '../modules/config.php';
    
    /* UPDATE */ 
    if ($role !='supplier'){
        include '../modules/access_denied.php';
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $orderId = $_POST["order_id"];
        $productId = $_POST["product_id"];
        $newStatus = $_POST["status"];
    
        $sql = "UPDATE orders_products SET status = '$newStatus' 
                WHERE orders_products.orderID = '$orderId' AND orders_products.productID = '$productId' 
                AND orders_products.productID IN (SELECT products.productID FROM products WHERE products.userID = '$user_id')";
    
        if (mysqli_query($conn, $sql)) {
            echo "<script>location.href='../supplier/myorders.php'; alert('Status updated successfully!');</script>";
        } else {
            echo "<script>alert('Failed to update status!'); location.href='../supplier/myorders.php';</script>" ;
        }
    }
?>
