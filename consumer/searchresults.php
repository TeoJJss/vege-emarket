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
    
    </style>
</head>
<body>
    <h1 id="title">Consumer page</h1>
    <p>Search Results</p>
    
</body>
</html>
<?php include '../includes/footer.php';?>

