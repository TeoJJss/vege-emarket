<?php
    /* INSERT */
    require '../modules/config.php';
    if ($role !='consumer'){
        include '../modules/access_denied.php';
    }
    $product_id=$_GET['id'];

    // track the user's cart
    $sql="SELECT cartID FROM cart WHERE userID='$user_id'";
    $cart= mysqli_fetch_array(mysqli_query($conn, $sql));
    $cart_id=$cart['cartID'];
    $insert_sql="INSERT INTO cart_product(cartID, productID) VALUES ('$cart_id', '$product_id')";
    mysqli_query($conn, $insert_sql);

    echo "<script>alert('Add to cart success');</script>";
    echo "<script>location.href='../consumer/cart.php';</script>"; 
?>