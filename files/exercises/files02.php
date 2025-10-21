<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Files 2</title>
</head>
<body>
    <?php
        include "./menu/menu.php";
    ?>
    <h1>Login</h1>
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
        <label for="userName">
            USERNAME : 
        </label>
        <input type="text" name="userName" id="userName">
        <br>
        <br>
        <label for="password">
            PASSWORD : 
        </label>
        <input type="password" name="password" id="password">
        <br><br><br>
        <input type="submit" value="Enviar">

    </form>
    <?php 
        if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST'){
            $user = $_POST['userName'];
            $password = $_POST['password']; 
            $valid  = false;
            
            $file = fopen("./data/files02.txt", 'r') or die("file not found");

            while(($line = fgets($file)) !== false && !$valid){
                $line = trim($line);
                list($mainUser, $mainPass) = explode(":", $line);

                if($mainUser == $user && $mainPass == $password){
                    $valid = true;
                }
            }

            fclose($file);

            if($valid){
                echo "<h2>Bienvenido $user</h2>";
            }
            else {
                echo "<h2>Usuario no encontrado</h2>";
            }


        }
    ?>
</body>
</html>