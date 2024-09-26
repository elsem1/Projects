<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title>
    <style>
       h1 {
        display: grid;
        place-items: center;
        height: 50vh;
        margin: 0;
        font-family: calibri;
       }
       form {
            text-align: center;
            font-size: 20px;
            font-family: sans-serif;
            font-weight: bolder;
       }
    </style>
</head>
<body>
   <?php
    $name_book = "The Wheel of Time"; 
    $read = "";
    $message = "";
    
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $read = $_POST['read'];
        if ($read === "Yes"){
            $message = "You have read $name_book.";
           
        } elseif  ($read === "No") {
            $message = "You have not read $name_book.";           
        } else {
            $message = "Please select an option.";
        }
    }
   ?>
   <form method="POST" action="">
    Have you read <?=$name_book?>? <br>
        
        <input type ="radio" name="read" id="Yes" value="Yes" />
            <label for="Yes">Yes</label>
        <input type ="radio" name="read" id="No" value="NO" />
            <label for="No">No</label>
        <input type="submit">
    </form>
        
<h1>
    <?php 
    if (!empty($message)) {
        echo "<h1>$message</h1>";
    }
    ?>
</h1>
</body>
</html>