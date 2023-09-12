<?php
    /* INSERT */
    require $_SERVER['DOCUMENT_ROOT'].'/agriculture/modules/config.php'; 
    if ($role !='consumer'){
        echo "Access denied";
        header('Location: '.$base);
    }
    $product_id=$_GET['id'];

    // track the user's cart
    $sql="SELECT cartID FROM cart WHERE userID='$user_id'";
    $cart= mysqli_fetch_array(mysqli_query($conn, $sql));
    $cart_id=$cart['cartID'];
    $insert_sql="INSERT INTO cart_product(cartID, productID) VALUES ('$cart_id', '$product_id')";
    mysqli_query($conn, $insert_sql);

    echo "<script>location.href='".$base."/public/product.php?id=".$product_id."';</script>";
?>