<?php 
    require $_SERVER['DOCUMENT_ROOT'].'/agriculture/modules/config.php';
    if ($role!=""){
        include $_SERVER['DOCUMENT_ROOT'].'/agriculture/includes/header.php'; // Get header
    }
    if (isset($_GET['id'])){
        $id=$_GET['id'];
    }else{
        echo "Empty";
        die;
    }
    $sql = "SELECT products.productName, products.category, products.priceLabel, products.availabilityStatus, users.userID as supplierID, users.userName as supplierName, users.email, users.phone,
            products.description, products.productID, products.location, products.addDate, products.unit, COUNT(*) as sold, products.imgPath
            FROM products
            LEFT JOIN users ON users.userID = products.userID
            LEFT JOIN orders_products on products.productID=orders_products.productID
            WHERE products.productID='$id' AND availabilityStatus!='deleted'";

    $product= mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="../styles/title.css">

    <style>
        button.product-button{
            margin-left: 10%;
            margin-top: 5%;
            font-size: 3vw;
            color: white;
            background-color: black;
            cursor: pointer;
            border-radius: 0%;
            width: 30%;
            min-width: max-content;
        }
        button.product-button:hover{
            background-color: gray;
        }
        .product-first-container{
            width: 100%;
            overflow: hidden;
        }
        .product-first-container > td{
            min-width: 50%;
            max-width: 50%;
            overflow: hidden;
        }
        .product-second-container{
            width: 100%;
            min-width: 100%;
            background-color: lemonchiffon;
        }
        .product-second-container > td{
            padding: 1%;
        }
        table.product-container{
            margin-left: 5vw;
            max-width: 90%;
        }
        div#Description {
            background-color: wheat;
            max-width: 80%;
            max-height: 50%;
            padding-left: 1%;
            padding-top: 0.3%;
            padding-bottom: 0.5%;
        }
        img.product-pic {
            margin-top: 3vh;
            border: 1px solid;
            margin-bottom: 2vh;
            max-height: 10%;
            max-width: 80%;
        }
        td.product-left-part{
            max-width: 55%;
            width: 100%;
            padding: 0;
        }
        td.product-right-part > .product-right-card {
            background-color:  sandybrown;
            padding: 20px;
            width: 30vw;
            text-align: center;
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }
        a#product-category{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-weight: bold;
        }
        .product-right-card > .price {
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-size: 2vw;
            color: black;
            padding: 5px 0;
            border-radius: 5px 5px 0 0;
        }
        img.contact-icon{
            margin-right: 10%;
            width: 10%;
        }

        .availability {
            color: white;
            padding: 2%;
            border-radius: 5%;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            width: max-content;
            font-size: 2vw;
        }
        #availability{
            background-color: none;
        }
        div.product-contacts{
            clear: both;
            padding: 3.5%;
            background-color: seashell;
            width: 30vw;
        }
        div.product-contact{
            font-family: Arial, Helvetica, sans-serif;
            clear: both;
            padding: 2%;
        }
        div.item-details-container{
            display: flex;
            justify-content: space-between;
            margin-right: 30vw;
        }
        img#product-category-icon{
            margin-left: 7vw;
            margin-right: 1vw;
        }
        a.contact-detail{
            font-size: 1.5vw;
        }
        h3.product-card-title{
            padding-top: 0.5%;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 2vw;
        }
        span.detail{
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 1.3vw;
        }
        p.desc-text{
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 130%;
        }
    </style>
</head>
<body><br>
    <?php 
        $product_detail=mysqli_fetch_array($product); 
        if ($product_detail['productID']==""){
            die("No product found");
        }
    ?>
    <table class="product-container">
        <tr class="product-first-container">
            <td class="product-left-part">
                <h1 id="title" style="font-size: 3vw;">Product Name</h1>
                <div class="product-info-container"> 
                    <div class="product-info-left">
                        <img id="product-category-icon" src="../images/category.png" alt="Category: " width="3%"><a id="product-category" style="font-size: 1.5vw;"><?php echo $product_detail['category']; ?></a><br>
                        <img src="../assets/<?php echo $product_detail['imgPath']; ?>" alt="No Product Picture" class="product-pic" width="80%" height="20%" ><br>
                        <div id="Description">
                            <h3 class="product-card-title">Description</h3>
                            <p class="desc-text"><?php echo $product_detail['description']; ?></p>
                        </div><br>
                    </div>
                </div>
            </td>
            <td class="product-right-part">
                <div class="product-right-card">
                    <div class="price">RM <?php echo $product_detail['priceLabel']; ?></div>
                    <div class="availability" id="status"><?php echo $product_detail['availabilityStatus']; ?></div>
                </div>
                <div class="product-contacts">
                    <div class="product-contact"><img class="contact-icon" src="../images/whatsapp.jpg" alt="phone"><a href="https://api.whatsapp.com/send?phone=<?php echo $product_detail['phone']; ?>" target="_blank" class="contact-detail">Click Here to Chat</a></div>
                    <div class="product-contact"><img class="contact-icon" src="../images/phone.jpg" alt="phone"><a href="tel:+<?php echo $product_detail['phone']; ?>" class="contact-detail"><?php echo $product_detail['phone']; ?></a></div>
                    <div class="product-contact"><img class="contact-icon" src="../images/email.jpeg" alt="phone"><a href="mailto:<?php echo $product_detail['email']; ?>" class="contact-detail"><?php echo $product_detail['email']; ?></a></div>    
                </div>
                <?php if ($role=="admin"){ ?>
                    <?php if ($product_detail['availabilityStatus']!="banned"){ ?>
                        <button class="product-button" id="ban" onclick="chgStatus('product', '<?php echo $id; ?>', 'ban')">BAN</button>
                    <?php }else{ ?>
                        <button class="product-button" id="unban" onclick="chgStatus('product', '<?php echo $id; ?>', 'unban')">UNBAN</button>
                    <?php } ?>
                <?php } else if ($role=="consumer"){ ?>
                    <?php if ($product_detail['availabilityStatus'] != "available"){ ?>
                        <button class="product-button" id="add-to-cart" style="cursor: not-allowed;" title="This product is unavailable" disabled>ADD TO CART</button>
                    <?php }else{ 
                        $add_cart = "$base/modules/add_cart.php?id=$id"; ?>
                        <button class="product-button" id="add-to-cart" onclick="window.location.href='<?php echo $add_cart; ?>';">ADD TO CART</button>
                    <?php } ?>
                <?php }else if ($role=="supplier" && $user_id==$product_detail['supplierID']){ ?>
                    <button class="product-button" id="delete-item" onclick="dltItem('<?php echo $id ?>');">DELETE</button>
                <?php } ?>
            </td>
        </tr>
        <tr class="product-second-container">
            <td colspan="2" class="product-item-detail">
                <h3 class="product-card-title">Item Details</h3>
                <div class="item-details-container">
                    <div id="left">
                        <span class="detail"><b>Product ID:</b> <?php echo $id; ?></span><br>
                        <span class="detail"><b>Location:</b> <?php echo $product_detail['location']; ?></span><br>
                        <span class="detail"><b>Price: </b><?php echo $product_detail['priceLabel']; ?></span>
                    </div>
                    <div id="right">
                        <span class="detail"><b>Added:</b> <?php echo $product_detail['addDate']; ?></span><br>
                        <span class="detail"><b>Sold:</b> <?php echo $product_detail['sold']; ?></span><br>
                        <span class="detail"><b>Unit:</b> <?php echo $product_detail['unit']; ?></span>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var status = document.getElementById('status');
            
            if (status.innerHTML.toLowerCase() === 'out of stock') {
                status.style.backgroundColor = 'red';
            }else if (status.innerHTML.toLowerCase() === 'available') {
                status.style.backgroundColor = 'green';
            }else if (status.innerHTML.toLowerCase() === 'banned') {
                status.style.backgroundColor = 'grey';
            }
        });
        function chgStatus(type, id, action){
            if (window.confirm("Are you sure?")) {
                window.location.href=`<?php echo $base.'/modules/ban.php?'?>type=${type}&id=${id}&action=${action}`;
            }
        }
        function dltItem(id){
            if (window.confirm("Delete this product?")) {
                window.location.href=`<?php echo $base.'/modules/delete_item.php?'?>id=${id}`;
            }
        }
    </script>
</body>
</html>
<?php include $_SERVER['DOCUMENT_ROOT'].'/agriculture/includes/footer.php'; ?>
