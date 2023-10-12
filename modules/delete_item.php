<?php
    require '../modules/config.php';
    
    /* UPDATE */ 
    if ($role !='supplier'){
        include '../modules/access_denied.php';
    }
    $product_id=$_GET['id'];
    $dlt_sql="UPDATE products SET availabilityStatus='deleted' WHERE products.productID='$product_id' AND products.userID='$user_id';";

    if (mysqli_query($conn, $dlt_sql)){
        /* DELETE */
        $dlt_sql="DELETE FROM cart_product WHERE productID='$product_id';";
        mysqli_query($conn, $dlt_sql);
        echo "<script>alert('Delete success!'); location.href='../supplier/myproducts.php';</script>";
    }else{
        echo "<script>alert('Deletion failed!'); location.href='../supplier/myproducts.php';</script>";
    }
?>