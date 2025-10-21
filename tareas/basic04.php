<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<body>
    <?php 
        $limit = 6;
        // for($i = 0; $i < $limit; $i++){
        //     $number = random_int(1, 49);
        //     echo "<h2>$number</h2>";
        // };
        $i=0;
        while($i <= $limit -1){
            $number = random_int(1, 49);
            
            if($i == $limit -1){
                echo $number;
            }
            else{
                echo "$number, ";
            };
            $i++;
        };
    ?>
</body>
</html>