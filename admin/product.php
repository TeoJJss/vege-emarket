<?php 
    require $_SERVER['DOCUMENT_ROOT'].'/modules/config.php';
    $id=123; // Change to actual data after database is ready 
    if ($role !='admin'){
        if ($role != ''){
            header("Location:".$_SERVER['DOCUMENT_ROOT']."/$role/product.php?id=$id");
        }else{
            header("Location:".$_SERVER['DOCUMENT_ROOT']."/index.php");
        }
    }
    include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; // Get header
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="../styles/title.css">
    <link rel="stylesheet" href="../styles/product.css">
    <style>
        button.product-ban{
            margin-left: 30%;
            margin-top: 5%;
            font-size: 3vw;
            color: white;
            background-color: black;
            cursor: pointer;
            border-radius: 10%;
            width: 20%;
        }
    </style>
</head>
<body><br>
    <table class="product-container">
        <tr class="product-first-container">
            <td class="product-left-part">
                <h1 id="title" style="font-size: max(14px, 2vw);">Product Name</h1>
                <div class="product-info-container"> 
                    <div class="product-info-left">
                        <img id="product-category-icon" src="../images/category.png" alt="Category: " width="2%"><a id="product-category">Category</a><br>
                        <img src="../assets/corn.jpg" alt="Product Picture" class="product-pic" width="80%" height="20%" ><br>
                        <div id="Description">
                            <h3 class="product-card-title">Description</h3>
                            <p class="desc-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem aspernatur dolorem nihil eligendi iste modi voluptates labore accusantium at ex excepturi 
                                commodi vel, odio veniam maiores quos laudantium minima ipsam.</p>
                        </div><br>
                    </div>
                </div>
            </td>
            <td class="product-right-part">
                <div class="product-right-card">
                    <div class="price">RM 10</div>
                    <div class="availability">Available</div>
                </div>
                <div class="product-contacts">
                    <div class="product-contact"><img class="contact-icon" src="../images/whatsapp.jpg" alt="phone"><a href="https://api.whatsapp.com/send?phone=60123456789" target="_blank" class="contact-detail">Click Here to Chat</a></div>
                    <div class="product-contact"><img class="contact-icon" src="../images/phone.jpg" alt="phone"><a href="tel:+60123456789" class="contact-detail">+60123456789</a></div>
                    <div class="product-contact"><img class="contact-icon" src="../images/email.jpeg" alt="phone"><a href="mailto:help@vegemarket.my" class="contact-detail">help@vegemarket.my</a></div>    
                </div>
                <button class="product-ban">BAN</button>
            </td>
        </tr>
        <tr class="product-second-container">
            <td colspan="2" class="product-item-detail">
                <h3 class="product-card-title">Item Details</h3>
                <div class="item-details-container">
                    <div id="left">
                        <span class="detail">Product ID:</span><br>
                        <span class="detail">Location:</span><br>
                        <span class="detail">Price:</span>
                    </div>
                    <div id="right">
                        <span class="detail">Added:</span><br>
                        <span class="detail">Sold:</span><br>
                        <span class="detail">Unit:</span>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    
</body>
</html>
<?php include '../includes/footer.php'; ?>
