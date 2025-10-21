<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <?php
        header("http://localhost/php/forms/tareas/02-formsSet.php?user=''&password=''");
        $user = $_GET["user"] ?? "";
        $password = $_GET["password"] ?? "";

        $vowels = ["a", "e", "i", "o", "u"];

        $userVowels = [];
        foreach($vowels as $vowel){
            if(stripos($user , $vowel) !== false){
                $userVowels[] = $vowel;
            }
        };

        $valid = true;
        
        foreach($userVowels as $vowel){
            if(stripos($password , $vowel) !== false){
                $valid = false;
                break;
            }
        }
        
        if($valid){
            echo "<a href='./images/download.jpeg' download='pajarito'>
                    <img src='./images/download.jpeg' alt='Pajarito' width='104' height='142'>
                </a>";
        }
        else {
            echo "La contraseña es incorrecta (No pueden tener las mismas vocales) <br>";
            echo "La contraseña $password contiene una o mas vocales del usuario $user";
        }
    ?>
</body>
</html>


