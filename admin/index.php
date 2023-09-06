<?php 
    require $_SERVER['DOCUMENT_ROOT'].'/config.php';
    include './includes/header.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage - Admin</title>
    <link rel="stylesheet" href="../styles/title.css">
    <style>
        #up_card, #mid_card{
            align-self: center;
            float: left;
            background-color: ghostwhite;
            width: 40vw;
            text-align: center;
            border-radius: 25px;
        }
        div.manage_user{
            margin-left: 5vw;
            margin-right: 3vw;
        }
        .card_title{
            font-size:  max(14px, max(2vw, 12px));
            line-height: 1px;
            font-family: Arial, Helvetica, sans-serif;
            margin-left: 2vw;
            white-space: nowrap; 
            text-overflow: ellipsis;
        }
        .card_desc{
            font-size:  max(12px, 1vw);
            font-family:Verdana, Geneva, Tahoma, sans-serif;
        }
        span.card_desc{
            font-family: 'Courier New', Courier, monospace;
        }
        button.index-button{
            background-color: midnightblue;
            font-size: 1em;
            font-weight: bolder;
            color: white;
            border: none;
            width: 20%;
            height: 30px;
        }
        button.index-button:hover{
            cursor: pointer;
            background-color: mediumblue;
            font-weight: lighter;
        }
        #mid_card{
            width: 83vw;
            margin-left: 5vw;
            margin-top: 1vw;
        }
        table.info-table{
            margin-left: 50px;
            max-width: 83vw;
            border-spacing: 10px;
        }
        table.info-table th, table.info-table td{
            padding-right: 100px;
            text-align: center;
            padding-right: 70px;
            border-spacing: 10px;
        }
        tr.customer > th, tr.customer > td{
            text-align: center;
            padding-right: 70px;
            border-spacing: 10px;
        }
        table.customer{
            margin-left: 20px;
        }
        .product_name{
            width: 60%;
        }
        div.top_selling, div.mvc{
            background-color: ghostwhite;
            margin-left: 5vw;
            max-height: 30vw;
            overflow-x: scroll;
            overflow-y: scroll;
        }
        div.mvc{
            max-width: 50vw;
            margin-right: 3vw;
            margin-top: 1vw;
            float: left;
            border-radius: 25px;
            width: 35vw;
            height: 20%;
        }
        div.conclusion{
            margin-top: 3vw;
            text-align: center;
            float: right;
            margin-right: 10vw;
            width: 30vw;
            background-color: ghostwhite;
            border-radius: 25px;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <h1 id="title" style="font-size: max(14px, 2vw);">Administration Page</h1>
        <p id="title" style="font-size: max(10px, 1vw);">Admin HomePage</p>
        <br>
        <div class="manage_user" id="up_card">
            <h3 class="card_title" style="text-align: center;">Manage Users</h3>
            <p class="card_desc">Manage the <b>users</b> in this website</p>
            <span class="card_desc" >&nbsp;Total users: </span><br><br>
            <button class="index-button" onclick="window.location.href='<?php echo $base_role; ?>/console.php?type=user';" title="Go to User Management page">GO!</button>

            <br>&nbsp;
        </div>
        <div class="manage_product" id="up_card">
            <h3 class="card_title" style="text-align: center;">Manage Products</h3>
            <p class="card_desc">Manage the <b>products</b> in this website</p>
            <span class="card_desc" >&nbsp;Total products: </span><br><br>
            <button class="index-button" onclick="window.location.href='<?php echo $base_role; ?>/console.php?type=product';" title="Go to User Management page">GO!</button>
            <br>&nbsp;
        </div>
        <div class="top_selling" id="mid_card">
            <h3 class="card_title" style="text-align: left;">Top Selling Products</h3>
            <table class="info-table">
                <thead>
                    <tr>
                        <th></th>
                        <th class="product_name">Product Name</th>
                        <th>Category</th>
                        <th>Sold</th>
                        <th>Supplier</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1. </td>
                        <td class="product_name">Spinach</td>
                        <td>Leafy Green</td>
                        <td>10</td>
                        <td>Lorem ipsum dolor sit.</td>
                    </tr>
                    <tr>
                        <td>2. </td>
                        <td class="product_name">Gourd</td>
                        <td>Marrow</td>
                        <td>10</td>
                        <td>Lorem ipsum dolor sit.</td>
                    </tr>
                    <tr>
                        <td>3. </td>
                        <td class="product_name">Potato</td>
                        <td>Root</td>
                        <td>10</td>
                        <td>Lorem ipsum dolor sit.</td>
                    </tr>
                </tbody>
            </table>
            <br>&nbsp;
        </div>
        <div class="mvc" >
            <h3 class="card_title" style="text-align: left;">Most Valuable Customers</h3>
            <table class="customer">
                <thead>
                    <tr class="customer">
                        <th></th>
                        <th>Customer Name</th>
                        <th>No. of Orders</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="customer">
                        <td >1. </td>
                        <td>User 1</td>
                        <td>90</td>
                    </tr>
                    <tr class="customer">
                        <td >2. </td>
                        <td>User 2</td>
                        <td>90</td>
                    </tr>
                    <tr class="customer">
                        <td >3. </td>
                        <td>User 3</td>
                        <td>90</td>
                    </tr>
                </tbody>
            </table>
            <br>&nbsp;
        </div>
        <div class="conclusion" id="down_card">
            <br>
            <p>Number of Orders: 9000 </p>
            <p>Transaction total: RM1000 </p>
            <br>
        </div><br>
    </div>
    
    </body>

</html>
<?php include '../includes/footer.php'; ?>