<?php 
    /* UPDATE */
    require $_SERVER['DOCUMENT_ROOT'].'/vege-emarket/modules/config.php'; 
    if ($role !='admin'){
        echo "Access denied";
        header('Location: '.$base);
    }
    if ($_GET['type']=='user'){
        $id=$_GET['id'];
        if ($_GET['action']=='ban'){
            $new_status='banned';
        }else if ($_GET['action']=='unban'){
            $new_status='active';
        }
        $sql="UPDATE users SET accStatus='$new_status' WHERE userID='$id';";
        mysqli_query($conn, $sql);
    }else if ($_GET['type']=='product'){
        $id=$_GET['id'];
        if ($_GET['action']=='ban'){
            $new_status='banned';
        }else if ($_GET['action']=='unban'){
            $new_status='out of stock';
        }
        $sql="UPDATE products SET availabilityStatus='$new_status' WHERE productID='$id';";
        mysqli_query($conn, $sql);
    }
    echo "<script>alert('Update success'); location.href='".$base."/admin/console.php?type=".$_GET['type']."';</script>";

?>