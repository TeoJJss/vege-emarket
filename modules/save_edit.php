<?php
    require '../modules/config.php'; 
    if ($role !='supplier'){
        echo "Access denied";
        header('Location: ../index.php');
    }

    /* UPDATE */
    $product_id=$_GET['id'];
    $col=$_GET['col'];
    $new=$_GET['new'];
    $sql_update="UPDATE products SET $col='$new' WHERE productID='$product_id' AND userID='$user_id'";

    mysqli_query($conn, $sql_update);
    echo "<script>location.href='../public/product.php?id=$product_id'</script>";
?>