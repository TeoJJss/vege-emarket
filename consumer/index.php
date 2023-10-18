<?php
    require '../modules/config.php'; // Validate user role
    if ($role !='consumer'){
        header('Location: ../index.php');
        die;
    }

    $new_arrival = mysqli_query($conn, "SELECT * FROM products ORDER BY products.addDate");

    include '../includes/header.php';

   
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="stylesheet" href="../styles/title.css">
<script src="https://kit.fontawesome.com/92d70a2fd8.js" crossorigin="anonymous"></script>
<style>
    .search{
        background-color: #eee;
        width: 260px;
        height: 45px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0px 25px;
        float: right;
        margin: 50px;
    }
    input{
        font-size: 20px;
        width: 240px;
        margin-top: 15px;
        border: none;
        outline: none;
        background: none;
    }
    .fa-solid:hover{
        color: orangered;
        cursor: pointer;
    }

    h2 {
        border: 1px solid #ccc; 
        width:120px;
        background:none;
        align-items: center;
        background-color: #eee
        margin-left: 25px;
        font-size: 18px;
    }
    .h2-box {
        background-color: #eee;
        padding: 5px; 
        float:left;
        clear:both;
        margin:15px;
    }
    .order{
        float:right;
        margin-right:10px;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }
    .round-button {
        border: none;
        outline: none;
        background-color: none; 
        padding: 5px 5px; 
        text-align: center; 
        text-decoration: none; 
        display: inline-block; 
        margin: 10px;
    }
    .clear{
        clear:both;
    }
    .gray-row {
        background-color: gray; 
        padding: 10px; 
    }

    .clear.box {
    background-color: gray; 
    padding: 10px; 
    display: flex; 
    flex-wrap: wrap; 
    }
  
    .clear.gray-row div {
    margin: 5px; 
    padding: 15px; 
    border: 1px solid white; 
    font-size: 20;
    width: 75px; 
    height: 75px; 
    background-color:white;
    }

    .box{
            width: 100px;
            height: 100px;
            background-color:bisque;
            float:left;
            border-radius:10px;
            margin:10px;
            padding:10px;
    }
    .box2{
            width: 200px;
            height: 300px;
            background-color:bisque;
            float:left;
            border-radius:10px;
            margin:40px;
            padding:10px;
            
    }
    .right{
        margin-left: 85px; 
    }
    
</style>
<body >
    <div>
        <div>
        <h1 id="title">Consumer page</h1>
        <p id="title">Homepage</p>
        <div class="order"> 
            <a href="orderhistory.php" target ="_blank">
                <u>Order History</u>
            </a>
            <a href="cart.php" target="_blank">
                <button class="round-button"><img src="../images/shopping-cart.png" width="16"></button>
            </a>
        </div> 
    </div>

    <div class="search">
        <form action="searchresults.php" method="get">
            <input type="search" name ="q" placeholder="Search">
            <i class="fa-solid fa-magnifying-glass"></i>
        </form>
        
    </div>

    <div>
        <h2 class="h2-box right">Categories</h2>
        <div class="clear right">
        <?php 
                    $search_key ="";
                    if (isset($_POST['search']))
                        {
                            $search_key = $_POST["search_key"];
                        }
                    $sql = "SELECT * FROM products WHERE productName LIKE '%search_key%'";
                    $search = mysqli_query($conn, "SELECT * FROM products");
            $home = mysqli_query($conn, "SELECT * FROM products");
            while($row = mysqli_fetch_array($home))
            {
                echo'<div class="box">';
                echo '<p>'.$row['category'].'</p>';
                echo '</div>';
            }

        ?>
        </div>
    </div>
    <div>
        <h2 class="h2-box right">New Arrivals</h2>
        <div class="clear right"><a href="../public/product.php" target="_blank">
            <?php 
                $home = mysqli_query($conn, "SELECT * FROM products ORDER BY products.addDate DESC");
                while($row = mysqli_fetch_array($home))
                {
                    echo'<div class="box2">';
                    if ($row['imgPath']== "U02/corn.jpg"){
                        echo'<img src ="../assets/U02/corn.jpg" width="200">';
                    }
                    else if ($row['productName']== "pumpkin"){
                        echo'<img src ="../assets/U05/pumpkin-3f3d894.jpg" width="200">';
                    }
                    else if ($row['productName']== "corn"){
                        echo'<img src ="../assets/potato.jpg" width="200">';
                    }
                    else if ($row['productName']== "carrot"){
                        echo'<img src ="../assets/carrot.png" width="200">';
                    }
                    echo '<p>'.$row['productName'].'</p>';
                    echo '<p>'.$row['priceLabel'].'</p>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
</body>
</head>
</html>
<?php include '../includes/footer.php';?>