<?php
    require '../modules/config.php';
    
    /* UPDATE */ 
    if ($role !='supplier'){
        include '../modules/access_denied.php';
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $orderId = $_POST["order_id"];
        $newStatus = $_POST["status"];
    
        $sql = "UPDATE orders_products SET status = '$newStatus' WHERE orderID = '$orderId' AND productID IN (SELECT productID FROM products WHERE userID = '$user_id')";
    
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Status updated successfully!'); location.href='../supplier/myorders.php';</script>";
        } else {
            echo "<script>alert('Failed to update status!'); location.href='../supplier/myorders.php';</script>" ;
        }
    }
?>
