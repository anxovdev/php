<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $fechaNacimiento = new DateTime("24/09/2006");
        $hoy = new DateTime();

        $edad = (string)($hoy -> diff($fechaNacimiento));
        
        echo "tu edad es: $edad";
    ?>
</body>
</html>