<?php 
    require '../modules/config.php';
        
    if ($role !='consumer'){
        include '../modules/access_denied.php';
    }

    $product_id=$_GET['id'];

    /* DELETE */
    $delete_sql="DELETE FROM cart_product
                WHERE cart_product.cartID=(SELECT cart.cartID FROM cart
                                            WHERE cart.userID='$user_id')
                AND cart_product.productID='$product_id'";
    if (mysqli_query($conn, $delete_sql)) {
        echo "<script>location.href='../consumer/cart.php'</script>";
    }
    
?>