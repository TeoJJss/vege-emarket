<?php
    require '../modules/config.php'; // Validate user role
    if ($role != 'consumer') {
        header('Location: ../index.php');
        die;
    }
    
    $new_arrival = mysqli_query($conn, "SELECT products.imgPath, products.productName, products.priceLabel, products.productID 
                                        FROM products 
                                        WHERE availabilityStatus ='available'
                                        ORDER BY products.addDate DESC LIMIT 8");
    $vegetableTypes = array("Root", "Marrow", "Tropical", "Cactus", "Aquatic", "Leafy", "Spice", "Poaceae", "Gourd", "Stem", "Herbaceous", 
                            "Fungus", "Bulb");

    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $q=$_POST['search-input'];
        echo "<script>location.href='../consumer/searchresults.php?keyword=$q'</script>";
    }
    include '../includes/header.php';
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="stylesheet" href="../styles/title.css">
    <!-- <script src="https://kit.fontawesome.com/92d70a2fd8.js" crossorigin="anonymous"></script> -->
    <style>
        button.search-btn{
            width: 7vw;
            height: 5vh;
        }
        h2.card-title {
            border: 1px solid #ccc;
            width: 200px;
            background: none;
            align-items: center;
            clear: both;
            background-color: green;
            margin-left: 10vw;
            font-size: 30px;
            padding:10px;
            margin-bottom: 5px;
        }
        div.home-wrapper{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        div.top-area{
            float: right;
            text-align: right;
            margin-right: 13vw;
            margin-bottom: 3vh;
            font-size: 1.5vw;
        }
        div.home-wrapper a{
            color: darkgreen;
            font-weight: bold;
        }
        div.cat-banner a:hover{
            font-size: 1.7vw;
        }
        input.product-search-input{
            width: 23vw;
            font-size: 1vw;
            height: 2.5vw;
            min-height: 2vw;
        }
        button.search-button{
            cursor: pointer;
            height: 2.5vw;
            min-width: 2vw;
            width: fit-content;
            font-size: 1.5vw;
        }
        div.search-container{
            margin-right: 1vw;
        }
        div.new-arrivals-banner{
            margin-left: 10vw;
            font-size: 1.3vw;
        }
        div.cat-banner{
            background-color: palegreen;
            margin-left: 8vw;
            max-width: 80vw;
            padding: 20px;
            overflow: auto;
        }
        div.cat-banner img{
            background-color: lightgreen;
            border-radius: 100px;
            padding: 30px;
            min-width: 3vw;
        }
        div.cat-banner td{
            max-width: 30vw;
            text-align: center;
        }
        div.cat-banner table{
            border-spacing: 10px;
        }
        div#box {
            font-family: Arial, Helvetica, sans-serif;
            min-width: 17vw;
            max-width: 17vw;
            min-height: 200px;
            max-height: 305px;
            float: left;
            margin: 10px;
            border-radius: 10px;
            padding: 10px;
            background-color: lightgreen;
            border-collapse: collapse;
        }
        img.product-img{
            min-height: 200px;
            max-height: 200px;
            min-width: 100%;
            max-width: 100px;
        }
    </style>

<body>
    <h1 id="title">Consumer page</h1>
    <p id="title">Homepage</p>
    <div class="home-wrapper">
        <div class="top-area">
            <a href="../consumer/orderhistory.php" style="vertical-align: middle;">Order History</a>
            <a href="../consumer/cart.php" style="vertical-align: middle;" id="cart-btn"><img src="../images/shopping-cart.png" alt="Cart" width="8%"></a>
            <br>
            <form method="post" id="search-form">
                <div class="search-container">
                    <input type="text" name="search-input" class="product-search-input" id="product-search-input" placeholder="Search products" style="vertical-align: middle;" required><button class="search-button" type="submit" style="vertical-align: middle;">🔍</button>
                </div>
            </form>
        </div>
        <div class="mid-part">
            <h2 class="card-title" style="width: max-content;">Categories</h2>
            <div class="cat-banner">
                <table>
                    <tr>
                        <?php
                            foreach ($vegetableTypes as $type) {
                                echo '<td><a href="../consumer/searchresults.php?cat='.$type.'">';
                                echo '<img src="../images/' .$type. '-vege.png" alt="' . $type. '" width="60vw"><br>';
                                echo '<span style="font-weight: bold;">' . $type . '</span>';
                                echo '</a><td>';
                            }
                        ?>
                    </tr>
                </table>
            </div>
        </div><br>
        <div class="new-arrivals">
            <h2 class="card-title">New Arrivals</h2>
            <div class="new-arrivals-banner">
                <?php while ($product_info = mysqli_fetch_array($new_arrival)) { ?>
                    <div id="box">
                        <a href="../public/product.php?id=<?php echo $product_info['productID']; ?>"><img src="../assets/<?php echo $product_info['imgPath']; ?>" alt="<?php echo $product_info['productName']; ?>" class="product-img"></a>
                        <p><b>Item Name: </b><a href="../public/product.php?id=<?php echo $product_info['productID']; ?>"><?php echo $product_info['productName']; ?></a></p>
                        <p><b>Price: </b>RM <?php echo $product_info['priceLabel']; ?></p>
                    </div>
                <?php } ?>  
            </div>
        </div>
    </div>
</body>
</head>
</html>
<?php include '../includes/footer.php'; ?>