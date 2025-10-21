<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio3</title>
</head>
<body>
    <?php 
        $variable1 = "Hola Buenas este es un texto muy largo JAJAJAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
        $variable2 = "PHP es lo mejor que hay :)sssssssssssssssssssssssssssssssssssssssss";
        $variable3 = "No se como hacer este ejercicio :Dwqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq";

        $array = array(
            $variable1,
            $variable2, 
            $variable3
        );


        usort($array, function($elementA, $elementB){
            return strlen($elementA) - strlen($elementB);
        });

        foreach($array as $value){
            echo "<h2>$value</h2>";
        }


    ?>
</body>
</html>