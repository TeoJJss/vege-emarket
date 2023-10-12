<?php
require '../modules/config.php';

/* INSERT */
if ($role != 'supplier') {
    include '../modules/access_denied.php';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //ProductID 
    $productID = uniqid("P");

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
            trigger_error("Failed to upload the image.");
        }
    }
    
    //Adding item into database
    $insert_sql = "INSERT INTO products (productID, productName, priceLabel, availabilityStatus, description, location, addDate, unit, category, imgPath, userID)
                   VALUES ('$productID', '$name', '$price', '$availability', '$description', '$location', '$addDate', '$unit', '$category', '$image_des', '$user_id')";

    if (mysqli_query($conn, $insert_sql)) {
        echo "<script>alert('Item added successfully!'); location.href='../supplier/myproducts.php';</script>";
    } else {
        echo "<script>alert('Failed to add product!'); location.href='../supplier/myproducts.php';</script>";
    }
}
?>
