<?php 
    require '../modules/config.php';
    $failed_template = '<center><iframe name="Product Not Found" loading="lazy" src="../templates/not_found.php" frameborder="0" width="100%" height="50%"></iframe></center>';
    if ($role!=""){
        include '../includes/header.php'; // Get header
    }
    if (isset($_GET['id'])){
        $id=$_GET['id'];
    }else{
        echo $failed_template;
        die;
    }
    $sql = "SELECT products.productName, products.category, products.priceLabel, products.availabilityStatus, users.userID as supplierID, users.userName as supplierName, users.email, users.phone,
            products.description, products.productID, products.location, products.addDate, products.unit, COUNT(orders_products.productID) as sold, products.imgPath
            FROM products
            LEFT JOIN users ON users.userID = products.userID
            LEFT JOIN orders_products on products.productID=orders_products.productID
            WHERE products.productID='$id' AND availabilityStatus!='deleted'";

    $product= mysqli_query($conn, $sql);
    $product_detail=mysqli_fetch_array($product); 
    if ($product_detail['productID']==""){
        echo $failed_template;
        die;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - <?php echo $product_detail['productName']; ?></title>
    <link rel="stylesheet" href="../styles/title.css">
    <style>
        h1#title{
            margin-top: 3vh;
            margin-bottom: 2vh;
        }
        button.product-button{
            margin-left: 30%;
            margin-top: 8%;
            font-size: 2vw;
            color: white;
            background-color: black;
            cursor: pointer;
            border-radius: 0%;
            width: max-content;
            max-width: 40%;
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
            width: 80%;
            background-color: lemonchiffon;
        }
        .product-second-container > td{
            width: 80%;
            min-width: 80%;
            padding: 1%;
        }
        table.product-container{
            margin-left: 3vw;
            max-width: 90%;
        }
        div#Description {
            background-color: wheat;
            max-width: 74%;
            max-height: 50%;
            padding-left: 20px;
            padding-top: 0.3%;
            word-wrap: break-word;
            padding-bottom: 0.5%;
            padding-right: 20px;
        }
        img.product-pic {
            margin-top: 3vh;
            border: 1px solid;
            margin-bottom: 2vh;
            max-height: 10%;
            max-width: 75%;
            min-width: 70%;
        }
        td.product-left-part{
            max-width: 10vw;
            width: 90%;
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
            width: 5.5%;
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
            padding: 2%;
            margin-left: 10%;
        }
        div.item-details-container{
            display: flex;
            justify-content: space-between;
            margin-right: 30vw;
            padding-left: 20px;
            padding-bottom: 10px;
        }
        img#product-category-icon{
            margin-left: 5vw;
            margin-right: 1vw;
        }
        h3.product-card-title{
            padding-top: 0.5%;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 2vw;
            padding-left: 20px;
        }
        span.detail{
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 1.3vw;
        }
        p.desc-text{
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 130%;
        }
        img.edit-button{
            cursor: pointer;
        }
        img#edit-title-btn{
            margin-left: 10vw;
        }
        button.save-button{
            display: none;
            margin-left: 17%;
            cursor: pointer;
            margin-bottom: 1px;
        }
        div.price{
            display: inline-block;
        }
        div.availability-status-dropdown-content {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 1.3vw;
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 10vw;
            min-height: 6vh;
            overflow: auto;
            text-align: center;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            right: 7vw;  
            padding: 5px;
        }
        div.availability-status-dropdown-content > a{
            color: darkgreen;
        }
        div.availability-status-dropdown-content > a:hover{
            font-size: 1.5vw;
        }
        a.contact{
            color: green;
            font-size: 1.3vw;
            padding-bottom: 10%;
        }
        div.product-info-left{
            max-width: 100%;
        }
        p#description{
            text-align: justify;
        }
    </style>
</head>
<body>
    <table class="product-container">
        <tr class="product-first-container">
            <td class="product-left-part">
                <h1 id="title" style="font-size: 3vw;" contenteditable="false"><?php echo $product_detail['productName']; ?></h1>
                <?php if ($role=="supplier" && $user_id==$product_detail['supplierID']){ ?>
                    <img class="edit-button" id="edit-title-btn" src="../images/edit.png" alt="edit" width="3%" onclick="editMode('title')">
                    <button class="save-button" id="save-button-title" onclick="saveEdit('title', 'productName')">SAVE</button><br>
                <?php } ?>
                
                <div class="product-info-container"> 
                    <div class="product-info-left">
                        <img id="product-category-icon" src="../images/category.png" alt="Category: " width="3%"><a id="product-category" style="font-size: 1.5vw; color:black;" <?php if ($role=="consumer"){ echo "href='../consumer/searchresults.php?cat=$product_detail[category]'"; }; ?>><?php echo $product_detail['category']; ?></a><br>
                        <img src="../assets/<?php echo $product_detail['imgPath']; ?>" alt="No Product Picture" class="product-pic" width="900vw" height="500vw" ><br>
                        <div id="Description">
                            <h3 class="product-card-title">Description<?php if ($role=="supplier" && $user_id==$product_detail['supplierID']){ ?>
                                <img class="edit-button" src="../images/edit.png" alt="edit" width="3%" onclick="editMode('description')">
                            <?php } ?></h3>
                            <p class="desc-text" id="description"><?php echo $product_detail['description']; ?></p>
                            <button class="save-button" id="save-button-description" onclick="saveEdit('description', 'description')">SAVE</button><br>
                        </div><br>
                    </div>
                </div>
            </td>
            <td class="product-right-part">
                <div class="product-right-card">
                    <div class="price" title="Price label">RM <span id="priceLabel"><?php echo $product_detail['priceLabel']; ?></span>
                    <?php if ($role=="supplier" && $user_id==$product_detail['supplierID']){ ?>
                        <img class="edit-button" src="../images/edit.png" alt="edit" width="5%"onclick="editMode('priceLabel')">
                        <button class="save-button" id="save-button-priceLabel" onclick="saveEdit('priceLabel', 'priceLabel')">SAVE</button><br>
                    <?php } ?></div>
                    <?php if ($role=="supplier" && $user_id==$product_detail['supplierID'] && $product_detail['availabilityStatus']!='banned'){ ?>
                        <div class="availability" title="Click here to change status" id="status" style="cursor: pointer;" onclick="showStatusOption()"><?php echo ucwords($product_detail['availabilityStatus']);?></div>
                        <div id="availability-status-dropdown" class="availability-status-dropdown-content">
                            <p>Change your product's availability</p>
                            <a href="<?php echo "../modules/save_edit.php?id=$id&col=availabilityStatus&new=available"; ?>"><img src="../images/available_status.png" alt="green" height="24" title="available"> Available</a><br><br>
                            <a href="<?php echo "../modules/save_edit.php?id=$id&col=availabilityStatus&new=out%20of%20stock"; ?>"><img src="../images/outofstock_status.png" alt="red"  height="24" title="out of stock"> Out of Stock</a><br> &nbsp;
                        </div>
                    <?php }else{ ?>
                        <div class="availability" id="status" style="cursor: default;"><?php echo ucwords($product_detail['availabilityStatus']);?></div>
                    <?php } ?>
                </div>
                <div class="product-contacts">
                    <div class="product-contact"><img class="contact-icon" src="../images/whatsapp.png" alt="phone"><a class="contact" href="https://api.whatsapp.com/send?phone=<?php echo $product_detail['phone']; ?>" target="_blank">Click Here to Chat</a>&nbsp;(<?php echo $product_detail['supplierName']; ?>)</div>
                    <div class="product-contact"><img class="contact-icon" src="../images/phone1.png" alt="phone"><a class="contact" href="tel:+<?php echo $product_detail['phone']; ?>"><?php echo $product_detail['phone']; ?></a></div>
                    <div class="product-contact"><img class="contact-icon" src="../images/email.png" alt="phone"><a class="contact" href="mailto:<?php echo $product_detail['email']; ?>"><?php echo $product_detail['email']; ?></a></div>    
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
                        $add_cart = "../modules/add_cart.php?id=$id"; ?>
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
                        <span class="detail"><b>Price: RM </b><?php echo $product_detail['priceLabel']; ?></span>
                    </div>
                    <div id="right">
                        <span class="detail"><b>Added:</b> <?php echo $product_detail['addDate']; ?></span><br>
                        <span class="detail"><b>Sold:</b> <?php echo $product_detail['sold']; ?></span><br>
                        <span class="detail"><b>Unit:</b> <?php echo $product_detail['unit']; ?></span>
                    </div>
                </div>
            </td>
        </tr>
    </table><br>
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
        function showStatusOption(){
            document.getElementById('availability-status-dropdown').style.display='block';
        }
        window.onclick = function(event) {
            if (!event.target.matches('.availability')) {
                document.getElementById('availability-status-dropdown').style.display='none';
            }
            if (!event.target.matches('.username-dropdown-btn')) {
                document.getElementById('header-username-dropdown').style.display='none';
            }
        }
        function editMode(field){
            var target = document.getElementById(field);
            target.setAttribute('contenteditable','true');
            target.focus();
            document.getElementById(`save-button-${field}`).style.display='block';
        }
        function saveEdit(field, column){
            var target = document.getElementById(field);
            var new_value=target.innerHTML;

            if (field=='priceLabel' && (isNaN(parseFloat(new_value))||new_value<1)){ // Check if price is number
                alert('Please enter positive numeric value for Price Label! ');
            }else if (field=='title' && new_value.length > 15){
                alert('Maximum length of product\'s name is 15 characters! ');
            }else if (field=='title' && new_value.length < 1){
                alert('Product name cannot be empty! ');
            }else if (field=='description' && new_value.length > 150){
                alert('Maximum length of product\'s description is 150 characters! ');
            }else if (field=='description' && new_value.length < 1){
                alert('Description cannot be empty! ');
            }else{
                var url=`../modules/save_edit.php?id=<?php echo $id; ?>&col=${column}&new=${new_value}`;
                window.location.href=url;
                target.setAttribute('contenteditable','false');
                document.getElementById(`save-button-${field}`).style.display='none';
            }
            
        }
        function chgStatus(type, id, action){
            if (window.confirm("Are you sure?")) {
                window.location.href=`../modules/ban.php?type=${type}&id=${id}&action=${action}`;
            }
        }
    </script>
    <script src="../src/dltItem.js"></script>
</body>
</html>
<?php include '../includes/footer.php'; ?>