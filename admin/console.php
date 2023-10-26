<?php 
    require '../modules/config.php'; // Validate user role
    if ($role !='admin'){
        header('Location: ../index.php');
        die;
    }
    include '../includes/header.php'; // Get header

    // Get user list for user console
    $user_list = mysqli_query($conn, "SELECT * FROM users WHERE role != 'admin'; ");
    if ($user_list){
        $user_list_length = mysqli_num_rows($user_list);
    }
    
    // Get product list for product console
    $product_list = mysqli_query($conn, "SELECT users.userName as supplierName, products.productID, products.productName, products.category, products.priceLabel, products.availabilityStatus FROM products JOIN users ON products.userID=users.userID");
    if ($product_list){
        $product_list_length = mysqli_num_rows($product_list);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Console</title>
    <link rel="stylesheet" href="../styles/title.css">
    <style>
        div.console-container .selected-content{
            background-color: antiquewhite;
        }
        div.console-container {
            display: flex;
            align-items: center;
            flex-direction: column;
            margin-left: 2vw;
            margin-right: 2vw;
            min-height: 80%;
        }
        div.menu > button {
            width: 30vw;
            height: 5vw;
            text-align: center;
            font-size: 4vh;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            cursor: pointer;
            background-color: oldlace;
            border: none;
        }
        .menu > button:hover {
            background-color: azure;
        }
        div.console-container .content {
            background-color: oldlace;
            height: 2000px;
            max-height: 30vw;
            max-width: 80vw;
            padding: 20px;
            box-sizing: border-box;
            overflow: auto;
        }
        div.console-container #user-content, div.console-container #product-content{
            display: none;
        }
        div.console-container div.search-container{
            margin-left: 30vw;
            display: flex;
            align-items: center;
        }
        input.user-content-search-input, input.product-content-search-input{
            width: 15vw;
            font-size: 1.5vw;
            height: 2.5vw;
            min-height: 2vw;
        }
        div.console-container .search-button{
            cursor: pointer;
            height: 2.5vw;
            min-width: 2vw;
            width: fit-content;
            font-size: 1.5vw;
        }
        div.console-container table{
            margin-left: 2vw;
        }
        div.console-container th, div.console-container td{
            padding-bottom: 2vw;
            padding-right: 7vw;
            text-align: center;
            max-width: 4.7vw;
            overflow: hidden;
        }
        table.console-content-table{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 2.7vh;          
            margin-top: 1.5%;  
        }
        button.ban-button{
            color: white;
            background-color: red;
            cursor: pointer;
            border-radius: 10%;
            min-width: max-content;
            width: 80%;
            padding: 10%;
        }
        button.unban-button{
            color: white;
            background-color: green;
            cursor: pointer;
            border-radius: 10%;
            min-width: max-content;
            width: 80%;
            padding: 10%;
        }
        button.ban-button:hover{
            font-weight: bold;
            color: black;
            background-color: lightgreen;
        }
        button.unban-button:hover{
            font-weight: bold;
            color: black;
            background-color: lightcoral;
        }
        tbody.product-table > tr{
            padding: 0vw;
        }
        #title{
            color: darkgreen;
        }
        tr.console-table-headers{
            color: #006400;
        }
        td.search-key > a{
            color:darkgreen;
        }
        td#count{   
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 14px;
        }
        table#console-content-user-table td,table#console-content-user-table th{
            padding-right: 10vw;
        }
    </style>
</head>
<body>
    <h1 id="title">Administration Page</h1>
    <p id="title">Admin Console</p>
    <div class="console-container">
        <div class="menu">
            <button onclick="tab('user');" id="user-tab">User <img src="../images/user-management.png" alt="User Management" width="5%"></button>
            <button onclick="tab('product');" id="product-tab">Product <img src="../images/product-management.png" alt="Product Management" width="5%"></button>
        </div>

        <!-- For Product Management -->
        <div class="content" id="product-content">
            <div class="search-container">
                <input type="text" class="product-content-search-input" id="product-content-search-input" placeholder="Search product" onkeyup="searchFunction('product')" autofocus>
                <button class="search-button" >🔍</button>
            </div><br>
            <table class="console-content-table">
                <thead>
                    <tr class="console-table-headers">
                        <th id="count">ID</th>
                        <th>Product Name</th>
                        <th>Price Label</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="product-table" id="product-table">
                    <?php
                        $count=1;
                        if ($product_list_length){
                            while ($product_info=mysqli_fetch_array($product_list)){
                                $id = $product_info['productID'] ;
                                echo '<tr class="searchable-row">';
                                echo '<td id="count">'.$id.'</td>';
                                echo '<td class="search-key">'."<a class='search-product-url' href='../public/product.php?id=$id'>".$product_info['productName'].'</a></td>';
                                echo '<td class="search-key">RM'.$product_info['priceLabel'].'</td>';
                                echo '<td class="search-key">'.$product_info['category'].'</td>';
                                echo '<td class="search-key">'.$product_info['supplierName'].'</td>';
                                
                                if ($product_info['availabilityStatus'] != 'banned'){ ?>
                                    <?php if ($product_info['availabilityStatus']=='deleted'){
                                        echo '<td><font color="red">Deleted by supplier</font></td>';
                                    }else{ ?>
                                        <td><button class='ban-button' onclick="chgStatus('product', '<?php echo $id; ?>', 'ban')">BAN</button></td></tr>
                                    <?php }?>                                    
                                <?php }else{ ?>
                                    <td><button class='unban-button' onclick="chgStatus('product', '<?php echo $id; ?>', 'unban')">UNBAN</button></td></tr>
                                <?php }
                                $count++;
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- For User Management -->
        <div class="content" id="user-content">
            <div class="search-container">
                <input type="text" class="user-content-search-input" id="user-content-search-input" placeholder="Search user" onkeyup="searchFunction('user')" autofocus>
                <button class="search-button" >🔍</button>
            </div><br>
            <table class="console-content-table" id="console-content-user-table">
                <thead>
                    <tr class="console-table-headers">
                        <th></th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Contact</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="user-table" id="user-table">
                    <?php
                        $count=1;
                        if ($user_list_length){
                            while ($user_info=mysqli_fetch_array($user_list)){
                                echo '<tr class="searchable-row">';
                                echo '<td>'.$count.'</td>';
                                echo '<td class="search-key">'.$user_info['userName'].'</td>';
                                echo '<td class="search-key">'.$user_info['role'].'</td>';
                                echo "<td class='search-key'><a href='tel:$user_info[phone]'>".$user_info['phone']."</a>;<br>
                                        <a href='mailto:$user_info[email]'>".$user_info['email'].'</a></td>';
                                $id = $user_info['userID'] ;
                                if ($user_info['accStatus'] != 'banned'){ ?>
                                    <td><button class='ban-button' onclick="chgStatus('user', '<?php echo $id; ?>', 'ban')">BAN</button></td></tr>
                                <?php }else{ ?>
                                    <td><button class='unban-button' onclick="chgStatus('user', '<?php echo $id; ?>', 'unban')">UNBAN</button></td></tr>
                                <?php }
                                $count++;
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../src/search.js"></script>
    <script>
        function tab(type){ //If user clicks on tab
            if (type=='user'){
                document.getElementById('user-content').style.display='block';
                document.getElementById('user-tab').style.backgroundColor='lightyellow';
                document.getElementById('product-content').style.display='none';
                document.getElementById('product-tab').style.backgroundColor='oldlace';
            }
            if (type=='product'){
                document.getElementById('product-content').style.display='block';
                document.getElementById('product-tab').style.backgroundColor='lightyellow';
                document.getElementById('user-content').style.display='none';
                document.getElementById('user-tab').style.backgroundColor='oldlace';
            }
        }

        function chgStatus(type, id, action){
            if (window.confirm("Are you sure?")) {
                window.location.href=`<?php echo '../modules/ban.php?'?>type=${type}&id=${id}&action=${action}`;
            }
        }

        var url = new URL(window.location.href); //Get the URL
        var params = new URLSearchParams(url.search); //Get the parameter 'type' from URL
        if(params.get('type')=='user'){
            tab('user');
        }else if(params.get('type')=='product'){
            tab('product');
        }
    </script>
</body>
</html>
<?php include '../includes/footer.php'; ?>