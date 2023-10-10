<?php
    require '../modules/config.php'; // Validate user role
    if ($role !='supplier'){
        header('Location: ../index.php');
    }
    
    include '../includes/header.php'; // Get header
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <link rel="stylesheet" href="../styles/title.css">
    <style>
        .form-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 2vw;
            margin-right: 2vw;
            padding-left: 3vw;
            margin-top: 3vw;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
            padding: 12px 10px;
            margin: 8px 0;
            box-sizing: border-box;
            font-size: 1vw; 
        }
        
        input[type="text"]::placeholder,
        input[type="number"]::placeholder,
        select::placeholder,
        textarea::placeholder {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1vw;
        }

        .file-input-container{
            background-color: white;
            border: 1px solid rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            padding-left: 1vw;
            margin-bottom: 2vw;
            margin-top: 0.4vw;
            height: 5vw;
        }

        .file-input-label {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1vw;
        }

        .file-input {
            width: 470px;
            padding: 12px 10px;
            margin: 8px 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 0.9vw;
        }

        .buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px; 
            margin-top: 10px; 
        }

        input[type="submit"],
        input[type="reset"] {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: auto; 
            align-self: center;
            background-color: darkgreen;
            font-size: 1em;
            font-weight: bolder;
            color: white;
            border: none;
            width: 150px;
            height: 35px;
            border-radius: 5px;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            cursor: pointer;
            background-color: mediumseagreen;
            font-weight: bolder;
        }
</style>

</head>
<body>
    <h1 id="title">Supplier Page</h1>
    <p id="title">Add Products</p>
    <div class="form-container">
        <form method="post" enctype="multipart/form-data" action="../modules/add_item.php">
            <input type="text" name="name" id="name" maxlength="15" placeholder="Product Name"><br>
            <select id="category" name="category" required> 
                <option value="" disabled selected>Category</option>
                <option value="Poaceae">Poaceae</option>
                <option value="Root">Root</option>
                <option value="Marrow">Marrow</option>
                <option value="leafy">Leafy</option>
                <option value="cruciferous">Cruciferous</option>
                <option value="gourd">Gourd</option>
                <option value="nightshade">Nightshade</option>
                <option value="legume">Legume</option>
                <option value="stem">Stem</option>
                <option value="bulb">Bulb</option>
                <option value="fungus">Fungus</option>
                <option value="tuber">Tuber</option>
                <option value="herb">Herbaceous</option>
                <option value="vine">Vine</option>
                <option value="allium">Allium</option>
                <option value="pod">Podded</option>
                <option value="shoot">Shoot</option>
                <option value="spice">Spice</option>
                <option value="tropical">Tropical</option>
                <option value="temperate">Temperate</option>
                <option value="cactus">Cactus</option>
                <option value="aquatic">Aquatic</option>
                <option value="miscellaneous">Miscellaneous</option>
            </select><br>
            <textarea name="description" id="description" required placeholder="Description" rows="4" style="resize: none;"></textarea><br>
            <select id="status" name="status" required>
                <option value="" disabled selected>Availability Status</option>
                <option value="available">Available</option>
                <option value="out of stock">Out of Stock</option>
            </select><br>
            <input type="text" name="location" id="location" placeholder="Location"><br>
            <input type="number" name="price" id="price" required placeholder="Price (RM)">
            <select id="unit" name="unit" required>
                <option value="" disabled selected>Unit</option>
                <option value="KG">KG</option>
                <option value="G">G</option>
                <option value="oz">Ounces (oz)</option>
                <option value="lb">Pounds (lb)</option>
                <option value="piece">Pieces</option>
                <option value="bunch">Bunches</option>
                <option value="head">Heads</option>
                <option value="stalk">Stalks</option>
                <option value="bulb">Bulbs</option>
                <option value="bundle">Bundles</option>
                <option value="bag">Bags</option>
            </select><br><br>
            <label for="image" class="file-input-label">Insert product picture:</label><br>
            <div class="file-input-container">
                <input type="file" name="image" id="image" class="file-input"><br>
            </div>
            <div class="buttons">
                <input type="submit" name="submit" value="Add Product">
                <input type="reset" name="reset" value="Reset">
            </div>
        </form>
    </div>
</body>
</html>
<?php include '../includes/footer.php';?>