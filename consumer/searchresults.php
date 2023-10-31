<?php
    require '../modules/config.php'; // Validate user role
    if ($role !='consumer'){
        header('Location: ../index.php');
        die;
    }

    // For search bar
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $q=$_POST['search-input'];
        echo "<script>location.href='../consumer/searchresults.php?keyword=$q'</script>";
    }

    // For query results
    $query = "SELECT * FROM products WHERE products.availabilityStatus ='available' ";
    if (isset($_GET['keyword']) && isset($_GET["cat"])){
        $key = $_GET['keyword'];
        $cat = $_GET["cat"];
        $query .="AND products.productName LIKE '%$key%' AND products.category = '$cat'";
    }else if (isset($_GET["cat"])){
        $cat = $_GET["cat"];
        $query .="AND products.category = '$cat' ";
    }else if (isset($_GET['keyword'])){
        $key = $_GET['keyword'];
        $query.="AND products.productName LIKE '%$key%' ";
    }else{
        trigger_error("Nothing found! ", E_USER_ERROR);
    }
    $product_list=mysqli_query($conn, $query);
    
    include '../includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="../styles/title.css">
    <style>
        img.product-img{
            min-height: 200px;
            max-height: 200px;
            min-width: 100%;
            max-width: 100px;
        }
        div#box {
            font-family: Arial, Helvetica, sans-serif;
            min-width: 17vw;
            max-width: 17vw;
            min-height: 200px;
            max-height: 305px;
            float: left;
            margin: 10px;
            margin-right: 20px;
            border-radius: 10px;
            padding: 10px;
            background-color: lightgreen;
            border-collapse: collapse;
        }
        div.products a{
            color: darkgreen;
            font-weight: bold;
        }
        div.products{
            margin-left: 10vw;
            font-size: 1.3vw;
            min-height: 80vh;
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
            margin-left: 40vw;
        }
        small#search-term{
            margin-top: 10px;
            margin-left: 8px;
        }
    </style>
</head>
<body>
    <h1 id="title">Consumer page</h1>
    <p id="title">Search Results</p>
    <form method="post" id="search-form">
        <div class="search-container">
            <input type="text" name="search-input" class="product-search-input" id="product-search-input" placeholder="Search products" style="vertical-align: middle;" required><button class="search-button" type="submit" style="vertical-align: middle;">🔍</button><br>
            <?php if (isset($_GET['keyword'])){ ?>
                <small id="search-term">Search Term: "<?php echo $_GET['keyword']; ?>"</small>
            <?php }else if (isset($_GET["cat"])){ ?>
                <small id="search-term">Category: <?php echo $_GET['cat']; ?></small>
            <?php } ?>
        </div>
    </form>
    <?php 
        if (mysqli_num_rows($product_list) == 0){
            echo "<br><center><h1>Nothing was found! Please use other keyword or category. </h1></center>";
            die;
        }
    ?>
    <div class="products">
        <?php while ($product_info = mysqli_fetch_array($product_list)) { ?>
            <div id="box">
                <a href="../public/product.php?id=<?php echo $product_info['productID']; ?>"><img src="../assets/<?php echo $product_info['imgPath']; ?>" alt="<?php echo $product_info['productName']; ?>" class="product-img"></a>
                <p><b>Item Name: </b><a href="../public/product.php?id=<?php echo $product_info['productID']; ?>"><?php echo $product_info['productName']; ?></a></p>
                <p><b>Price: </b>RM <?php echo $product_info['priceLabel']; ?></p>
            </div>
        <?php } ?>  
    </div>
</div>
</body>
</html>

<?php include '../includes/footer.php';?>