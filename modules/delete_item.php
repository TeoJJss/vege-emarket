<?php
    require '../modules/config.php';
    
    /* UPDATE */ 
    if ($role !='supplier'){
        echo "Access denied";
        header('Location: ../index.php');
    }
    $product_id=$_GET['id'];
    $dlt_sql="UPDATE products SET availabilityStatus='deleted' WHERE productID='$product_id';";
    mysqli_query($conn, $dlt_sql);

    /* DELETE */
    $dlt_sql="DELETE FROM cart_product WHERE productID='$product_id';";
    mysqli_query($conn, $dlt_sql);
    echo "<script>alert('Delete success!'); location.href='../supplier/index.php';</script>";
?>