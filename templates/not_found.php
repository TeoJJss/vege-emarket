<!-- This is an error page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Not Found</title>
    <style>
        body{
            text-align: center;
            margin-top: 5%;
            font-size: 1.5vw;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        button.back{
            width: max-content;
            height: 50%;
            font-size: 1.5vw;
        }
    </style>
</head>
<body>
    <h1>Product not found, invalid or deleted! </h1>
    <button class="back" onclick="javascript:history.go(-1)" style="cursor: pointer;" target="_parent">Back</button><br>
    <small>Still having troubles? <a href='../public/contact.php' style='color:green;' target="_parent">Report</a></small>
</body>
</html>