<?php
    require '../modules/config.php'; // Validate user role
    if ($role !='supplier'){
        header('Location: ../index.php');
    }

    include '../includes/header.php'; // Get header

    //Count number of products
    $product_list = mysqli_query($conn, "SELECT * FROM products");
    if ($product_list){
        $product_list_length = mysqli_num_rows($product_list);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Products</title>
    <link rel="stylesheet" href="../styles/title.css">
    <style>
        div.product-container {
            display: flex;
            align-items: center;
            flex-direction: column;
            margin-left: 2vw;
            margin-right: 2vw;
            min-height: 80%;
        }

        div.search-container{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .search-button{
            cursor: pointer;
            height: 2.5vw;
            min-width: 2vw;
            width: fit-content;
            font-size: 1.5vw;
        }
        input.product-search {
            width: 15vw;
            font-size: 1.5vw;
            height: 2.5vw;
            min-height: 2vw;
        }
        .button {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
            align-self: center;
        }
        div.menu_topbar {
            align-self: center;
            width: 30vw;
            height: 5vw;
            border-radius: 10px;
            font-size: 4vh;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, Helvetica, sans-serif;
            background-color: beige;
        }
        div.content {
            background-color: beige;
            padding: 20px;
            width: 80%;
            box-sizing: border-box;
            overflow: auto;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center; /* Center content horizontally */
            flex-grow: 1;
        }
        img.delete_img {
            width: 25px;
            height: 25px;
        }
        button.addproducts_button{
            background-color: darkgreen;
            font-size: 1em;
            font-weight: bolder;
            color: white;
            border: none;
            width: 150px;
            height: 35px;
            border-radius: 5px;
        }
        button.addproducts_button:hover{
            cursor: pointer;
            background-color: mediumseagreen;
            font-weight: bolder;
        }
        .button {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: auto; 
            align-self: center;
        }
        button.delete_button{
            cursor: pointer;
        }
        .table-container {
            max-height: 400px; 
            overflow-y: auto; 
            width: 80%;
        }
        table.product-content-table {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            width: 100%; 
            margin-top: 200px;
            margin: 0 auto; 
        }
        table.product-content-table th{
            text-align: center;
            font-size: 1.4vw;
            line-height: 3;
        }
        table.product-content-table td{
            text-align: center;
            font-size: 1.2vw;
            line-height: 3;
        }

    </style>
</head>
<body>
    <h1 id="title">Supplier Page</h1>
    <p id="title">Supplier Products</p>
    <div class="product-container">
        <div class="menu_topbar">
            <p>Products</p>
        </div>
        <div class="content" id="product-content">
            <div class="search-container">
                <input type="text" class="product-search" id="product-content-search-input" placeholder="Search Product..." onkeyup="searchFunction('product')" autofocus>
                <button class="search-button">🔍</button>
            </div><br>
            <div class="table-container">
                <table class="product-content-table" id="product-table">
                    <thead>
                        <tr class="product-table-header">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Sold</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($product_list_length){
                                $sql = "SELECT products.productID, products.productName, COUNT(orders_products.productID) as sold, products.availabilityStatus
                                        FROM products 
                                        LEFT JOIN orders_products ON orders_products.orderID = products.productID
                                        WHERE products.availabilityStatus != 'deleted'
                                        GROUP BY products.productID
                                        ORDER BY products.productID ASC";
                                $products = mysqli_query($conn, $sql);
                                while($product_info = mysqli_fetch_array($products)) {
                                    $id = $product_info['productID'];
                                    echo "<tr class='searchable-row'>";
                                    echo "<td class='search-key'>".$product_info['productID']."</td>";
                                    echo "<td class='search-key'>"."<a href='../public/product.php?id=$id' style='color:darkgreen;'>".$product_info['productName']."</a></td>";
                                    echo "<td class='search-key'>".$product_info['sold']."</td>";

                                    if ($product_info['availabilityStatus']=="available"){
                                        echo "<td>"."<img src= '../images/available_status.png' height='28'"."</td>";
                                    }
                                    else if ($product_info['availabilityStatus']=="out of stock") {
                                        echo "<td class='product_status'>"."<img src= '../images/outofstock_status.png' height='24'"."</td>";
                                    }
                                    else if ($product_info['availabilityStatus']=="banned") {
                                        echo "<td class='search-key'>".'<span style ="color: red;">Banned</span>';
                                    }
                                    
                                    echo "<td>"."<button class='delete_button' onclick='dltItem(\"$id\");'>"."<img class = 'delete_img' src='../images/trash.png'>"."</button>"."</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="button">
                <button class="addproducts_button" onclick="window.location.href='../supplier/addproducts.php?type=user';" title="Add Products">Add Products</button>
            </div>
        </div>
    </div>
    <script src="../src/search.js"></script>
    <script>

        function dltItem(id){
            if (window.confirm("Delete this product?")) {
                window.location.href=`../modules/delete_item.php?id=${id}`;
            }
        }
        
    </script>
</body>
</html>
<?php include '../includes/footer.php'; ?>