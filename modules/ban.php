<?php 
    /* UPDATE */
    require '../modules/config.php'; 
    if ($role !='admin'){
        include '../modules/access_denied.php';
    }

    // To ban user
    if ($_GET['type']=='user'){
        $id=$_GET['id'];
        if ($_GET['action']=='ban'){
            $new_status='banned';
        }else if ($_GET['action']=='unban'){
            $new_status='active';
        }

        // Ban user acc
        $sql="UPDATE users SET accStatus='$new_status' WHERE userID='$id';";
        mysqli_query($conn, $sql);

        // Set available products to out of stock
        $sql="UPDATE products SET products.availabilityStatus='out of stock' WHERE products.userID='$id' AND products.availabilityStatus='available';";
        mysqli_query($conn, $sql);

    // To ban product
    }else if ($_GET['type']=='product'){
        $id=$_GET['id'];
        if ($_GET['action']=='ban'){
            $new_status='banned';
        }else if ($_GET['action']=='unban'){
            $new_status='out of stock';
        }

        // Ban Product
        $sql="UPDATE products SET availabilityStatus='$new_status' WHERE productID='$id';";
        mysqli_query($conn, $sql);
    }
    echo "<script>alert('Update success'); location.href='../admin/console.php?type=".$_GET['type']."';</script>";

?>