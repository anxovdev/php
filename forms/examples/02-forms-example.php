<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php    
            if($_GET["age"] >= 18)echo "Welcome ",$_GET["name"], " :)";
            else echo "Sorry, ",$_GET["name"], " :("; 
        ?>
    </title>
</head>
<body>
    <?php 
        $name = $_GET["name"];
        $age = $_GET["age"];
        if($age < 18){
            echo "<h2>Sorry $name you are under 18th years old</h2>";
        }
        else{
            echo "<h2>Your welcome $name you are over 18th years old, you are $age years old</h2>";
        };
    ?>
</body>
</html>