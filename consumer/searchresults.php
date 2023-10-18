<?php
    require '../modules/config.php'; // Validate user role
    if ($role !='consumer'){
        header('Location: ../index.php');
        die;
    }
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
        .box{
            width: 200px;
            height: 200px;
            background-color:bisque;
            float:left;
            border-radius:10px;
            margin:10px;
            padding:10px;
        }
        .right{
        margin: 85px; 
    }
    </style>
</head>
<body>
    <h1 id="title">Consumer page</h1>
    <p id="title">Search Results</p>
    <div class="right">
        <?php
            $search_key ="";
            if (isset($_POST['search']))
                {
                    $search_key = $_POST["search_key"];
                }
            $sql = "SELECT * FROM products WHERE productName LIKE '%search_key%'";
            $search = mysqli_query($conn, "SELECT * FROM products");
                
            
            while($row = mysqli_fetch_array($search))
            {
                echo '<div class="box">';
                
                
                
                if ($row['imgPath']== "U02/corn.jpg"){
                    echo'<img src ="../assets/U02/corn.jpg" width="150">';
                }
                else if ($row['productName']== "pumpkin"){
                    echo'<img src ="../assets/U05/pumpkin-3f3d894.jpg" width="150">';
                }
                else if ($row['productName']== "corn"){
                    echo'<img src ="../assets/potato.jpg" width="50">';
                }
                else if ($row['productName']== "carrot"){
                    echo'<img src ="../assets/carrot.png" width="50">';
                }
                echo '<h3>'.$row['productName'].'</h3>';
                echo '</div>';
            }
        ?>
    </div>
</ul>
</div>
</body>
</html>
<?php include '../includes/footer.php';?>

