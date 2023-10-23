<?php
    require '../modules/config.php'; // Validate user role
    if ($role !='consumer'){
        header('Location: ../index.php');
        die;
    }

    include '../includes/header.php';
    $block=false;
    $product_sql="SELECT products.imgPath, products.productName, products.priceLabel, users.userName, products.productID, products.availabilityStatus, products.unit
                    FROM cart_product
                    LEFT JOIN cart ON cart_product.cartID = cart.cartID
                    LEFT JOIN products ON cart_product.productID=products.productID
                    LEFT JOIN users ON cart.userID = users.userID
                    WHERE cart.userID='$user_id'";
    $product_list=mysqli_query($conn, $product_sql);
    $num_products=mysqli_num_rows($product_list);
    if ($num_products < 1) {
        header("Location: ../consumer/cart.php");
        die;
    }
    
    if ($_SERVER['REQUEST_METHOD']=="POST"){
        $prefix = date('Ymd'); 
        $orderID = uniqid("O".$prefix);
        $date=date("Y-m-d");
        $address=$_POST['address'];
        $paymentMethod=$_POST['payment-method'];
        $consumer_id=$user_id;

        //bulk input (array)
        $prices= $_POST['agreedPrice'];
        $remarks = $_POST['remark'];
        $ids = $_POST['productID'];

        //Create Order
        $sql = "INSERT INTO orders(orderID, orderDate, address, paymentMethod, userID)
                VALUES ('$orderID', '$date', '$address', '$paymentMethod', '$user_id')";
        
        
        if (mysqli_query($conn, $sql)){    
            $sql = "INSERT INTO orders_products(orderID, productID, agreedPrice, remark, status) VALUES";
            for ($i=0; $i < count($ids); $i++) {
                $id= $ids[$i];
                $price=$prices[$i];
                $remark = $remarks[$i];
                if ($i != count($ids)-1) {
                    $sql .= "('$orderID', '$id', '$price', '$remark', 'paid'),";
                }else{
                    $sql .= "('$orderID', '$id', '$price', '$remark', 'paid');";
                }
            }
            if (!mysqli_query($conn, $sql)){ 
                echo "<script>alert('Something went wrong!')</script>";
                die;
            }
            $dlt_sql = "DELETE FROM cart_product WHERE cartID=(SELECT cartID FROM cart WHERE userID='$user_id')";
            mysqli_query($conn, $dlt_sql);
            echo "<script>alert('Place order success!'); location.href='../consumer/orderhistory.php'</script>";
        }else{
            echo "<script>alert('Something went wrong!')</script>";
            die;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out</title>
    <link rel="stylesheet" href="../styles/title.css">
    <style>
        div.address{
            margin-left: 6vw;
            margin-top: 1vh;
        }
        div.address img {
            margin-bottom: 1vh;
            margin-left: 1vw;
        }
        div.products{
            margin-left: 5vw;
            min-width: 80%;
            max-width: 85%;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        div.product{
            background-color: palegreen;
        }
        div.product td{
            padding: 10px;
            min-width: 23vw;
            max-width: 30vw;
            overflow: hidden;
            text-align: center;
            font-size: 25px;
        }
        div.product a{
            text-decoration: underline;
            color: #006400; 
            cursor: pointer;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 1.5vw;
        }
        div.product a:hover{
            font-size: 1.6vw;
        }
        img#product-image{
            min-width: 15vw;
            width: 15vw;
            min-height: 15vw;
            max-width: 15vw;
            max-height: 15vw;
        }
        input#agreedPrice{
            width: 19vw;
            height: 5vh;
            font-size: 13.3px;
        }
        span#priceLabel{
            font-size: 15px;
        }
        .product-info-title{
            font-weight: bold;
        }
        div.checkout{
            margin-left: 15vw;
        }
        div.checkout img{
            background-color: darkgreen;
            padding: 5px;
            border-radius: 5px;
        }
        select#payment-methods{
            border-radius: 5px;
            min-height: 10vh;
            font-size: 2vw;
            cursor: pointer;
            min-width: 16vw;
        }
        select#payment-methods option{
            font-size: 1.5vw;
        }
        div.checkout td{
            font-size: 1.5vw;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        div.checkout input[type="submit"]{
            font-size: 1.5vw;
            text-align: center;
            min-width: 11vw;
            min-height: 7vh;
            cursor: pointer;
            background-color: darkgreen;
            font-weight: bold;
            color: white;
            border: none;
        }
        div.checkout input[type="submit"]:hover{
            font-size: 1.7vw;
            background-color: green;
            color: black;
        }
    </style>
</head>
<body>
    <h1 id="title"><strong>Consumer Page</strong></h1>
    <p id="title">Checkout</p><br>
    <div class="address">
        <img src="../images/pin.png" alt="Delivery Address" title="Delivery address" width="1%">
        <form action="" method="post">
            <textarea style="resize: none; padding: 5px; font-size: 15px;" maxlength="150" name="address" id="address" cols="140" rows="3" placeholder="Enter your Delivery Address" required></textarea>
    </div><br>
    <div class="products">
        <p>Number of products: <?php echo $num_products; ?></p>
        <?php while ($product_info=mysqli_fetch_array($product_list)){ ?>
            <input type="hidden" name="productID[]" id="productID" value="<?php echo $product_info['productID']; ?>">
            <div class="product">
                <table>
                    <tr>
                        <td>
                            <img src="../assets/<?php echo $product_info['imgPath'];?>" alt="Product image" id="product-image"><br>
                            <a href="../public/product.php?id=<?php echo $product_info['productID']; ?>"><?php echo $product_info['productName'];?></a>
                        </td>
                        <td>
                            <label for="agreedPrice" class="product-info-title">Enter Agreed Price</label>
                            <input type="number" name="agreedPrice[]" id="agreedPrice" placeholder="Enter a finalized price with the supplier, in RM" min="0" oninput="addTotal()" required><br>
                            <span id="priceLabel">Price tag: RM <?php echo $product_info['priceLabel']; ?>/<?php echo $product_info['unit'];?></span>
                            
                                <?php
                                    if ($product_info['availabilityStatus']!='available'){
                                        echo "<br><br><small style='color: red;'>This product is $product_info[availabilityStatus]</small>";
                                        $block = true;
                                    }
                                ?>
                            
                        </td>
                        <td>
                            <label for="remark" class="product-info-title">Remark</label>
                            <textarea style="resize: none; padding: 5px; font-size: 15px;" maxlength="150" name="remark[]" id="remark" cols="50" rows="7" placeholder="Enter some details, e.g. Amount"></textarea>
                        </td>
                    </tr>
                </table>
            </div><br>
        <?php } ?>
    </div>
    <div class="checkout">
        <table>
            <tr>
                <td>
                    <img src="../images/payment-gateway.png" alt="Payment Method" width="7%" style="vertical-align: middle;">
                    <select name="payment-method" id="payment-methods" style="vertical-align: middle;" required>
                        <option value="" selected disabled>Payment Method</option>
                        <option value="Cash On Delivery">Cash On Delivery</option>
                        <option value="Card">Credit/Debit Card</option>
                        <option value="QR">QR Payment</option>
                    </select>
                </td>
                <td style="text-align:right; max-width: 20vw; overflow:hidden;text-overflow: ellipsis;">
                    Total Price RM <span id="total">-</span><br>
                    <input type="submit" value="Place Order" 
                        <?php if ($block){ echo "style='cursor: not-allowed;' disabled";} ?>
                    >
                </td>
            </tr>
        </table>
    </div>
    </form>
    <br>
    <script>
        function addTotal(){
            var agreedPriceInputs = document.getElementsByName("agreedPrice[]");
            let total = 0;

            for (const input of agreedPriceInputs) {
                total += parseFloat(input.value) || 0;
            }

            var resultElement = document.getElementById("total");
            resultElement.textContent = total;
        }
    </script>
</body>
</html>
<?php include '../includes/footer.php';?>