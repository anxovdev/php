<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 </title>
</head>
<body>
    <?php
        $base = 2.6;
        $heigth = 1.5;
        $baseFloat = (float) $base ?? null;
        $heigthFloat = (float) $heigth ?? null;

        if($baseFloat != null && $heigthFloat != null){
            $area = ($baseFloat * $heigthFloat) / 2;
            $area = (float) $area;
            echo "<h1>El area del triangulo con base $baseFloat y altura $heigthFloat es igual a $area</h1>";
        }
        else {
        echo "<h1>Area no se puede encontrar con valores nulos >:( </h1>";
        }
    ?>
</body>
</html>