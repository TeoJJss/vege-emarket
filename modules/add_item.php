<?php
require '../modules/config.php';

/* INSERT */
if ($role != 'supplier') {
    echo "Access denied";
    header('Location: ../index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //ProductID 
    $productID_sql = "SELECT MAX(productID) AS lastproductID FROM products";
    $result = mysqli_query($conn, $productID_sql);
    $row = mysqli_fetch_assoc($result);
    $lastproductID = (int)$row['lastproductID'];
    $newproductID = $lastproductID + 1;

    //Prevent next productID being 'P00'
    if ($baseProductID <= 0) {
        $baseProductID = 1;
    }

    //ProductID incrementation
    do {
        $productID = 'P' . str_pad($baseProductID++, 2, '0', STR_PAD_LEFT);
        
        // Check if the generated 'productID' already exists in the database
        $check_sql = "SELECT COUNT(*) AS count FROM products WHERE productID = '$productID'";
        $check_result = mysqli_query($conn, $check_sql);
        $check_row = mysqli_fetch_assoc($check_result);
        $productIDExists = $check_row['count'] > 0;
    } while ($productIDExists);

    //Other input from form
    $category = $_POST['category'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $availability = $_POST['status'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $addDate = date('Y-m-d');
    $unit = $_POST['unit'];
    $unique_image_name = ''; 

    $upload_directory = '../assets/' . $user_id . '/';

    // Create directory if username doesnt exist
    if (!file_exists($upload_directory)) {
        mkdir($upload_directory, 0777, true);
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];

        //File imgPath for database
        $image_des = $user_id . '/' . $_FILES['image']['name'];
        
        //Moving file to correct destination
        $destination = $upload_directory . $image_name;
        if (!move_uploaded_file($image_tmp, $destination)) {
            echo "Failed to upload the image.";
        }
    }
    
    //Adding item into database
    $insert_sql = "INSERT INTO products (productID, productName, priceLabel, availabilityStatus, description, location, addDate, unit, category, imgPath, userID)
                   VALUES ('$productID', '$name', '$price', '$availability', '$description', '$location', '$addDate', '$unit', '$category', '$image_des', '$user_id')";

    if (mysqli_query($conn, $insert_sql)) {
        echo "<script>alert('Item added!'); location.href='../supplier/index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
