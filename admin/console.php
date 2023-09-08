<?php 
    require $_SERVER['DOCUMENT_ROOT'].'/config.php'; // Validate user role
    if ($role !='admin'){
        header('Location: '.$base);
    }
    include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; // Get header
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Console - Product Management</title>
    <link rel="stylesheet" href="../styles/title.css">
    <link rel="stylesheet" href="../styles/admin_console.css">
</head>
<body>
    <h1 id="title">Administration Page</h1>
    <p id="title">Admin Console</p>
    <div class="console-container">
        <div class="menu">
            <button onclick="tab('user');" id="user-tab">User</button>
            <button onclick="tab('product');" id="product-tab">Product</button>
        </div>
        <div class="content" id="product-content">
            <div class="search-container">
                <input type="text" class="product-content-search-input" placeholder="Search product" onkeyup="searchFunction('product')">
                <button class="search-button" >🔍</button>
            </div><br>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Supplier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="product-table">
                    <tr class="searchable-row">
                        <td class="search-key">1</td>
                        <td class="search-key">Lorem ipsum dolor sit amet consectetur adipisicing.</td>
                        <td class="search-key">Lorem ipsum dolor sit.</td>
                        <td><button>BAN</button></td>
                    </tr>
                    <tr class="searchable-row">
                        <td class="search-key">2</td>
                        <td class="search-key">Lorem ipsum dolor sit amet consectetur adipisicing.</td>
                        <td class="search-key">Lorem ipsum dolor sit. iii</td>
                        <td class="search-key"><button>BAN</button></td>
                    </tr>
                    <tr class="searchable-row">
                        <td class="search-key">3</td>
                        <td class="search-key">Lorem ipsum dolor sit amet consectetur adipisicing.</td>
                        <td class="search-key">Lorem ipsum dolor sit.</td>
                        <td><button>BAN</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="content" id="user-content">
            <div class="search-container">
                <input type="text" class="user-content-search-input" placeholder="Search user" onkeyup="searchFunction('user')">
                <button class="search-button" >🔍</button>
            </div><br>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Contact</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="user-table">
                    <tr class="searchable-row">
                        <td class="search-key">1</td>
                        <td class="search-key">User1</td>
                        <td class="search-key">Consumer</td>
                        <td class="search-key">012345678 ; user@example.com</td>
                        <td><button>BAN</button></td>
                    </tr>
                    <tr class="searchable-row">
                        <td class="search-key">2</td>
                        <td class="search-key">User2</td>
                        <td class="search-key">Supplier</td>
                        <td class="search-key">012345678 ; user@example.com</td>
                        <td><button>BAN</button></td>
                    </tr>
                    <tr class="searchable-row">
                        <td class="search-key">3</td>
                        <td class="search-key">User3</td>
                        <td class="search-key">Consumer</td>
                        <td class="search-key">012345678 ; user@example.com</td>
                        <td><button>BAN</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../src/search.js"></script>
    <script>
        function tab(type){ //If user clicks on tab
            if (type=='user'){
                document.getElementById('user-content').style.display='block';
                document.getElementById('user-tab').style.backgroundColor='lightcyan';
                document.getElementById('product-content').style.display='none';
                document.getElementById('product-tab').style.backgroundColor='aliceblue';
            }
            if (type=='product'){
                document.getElementById('product-content').style.display='block';
                document.getElementById('product-tab').style.backgroundColor='lightcyan';
                document.getElementById('user-content').style.display='none';
                document.getElementById('user-tab').style.backgroundColor='aliceblue';
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
<?php include '../includes/footer.php' ?>
