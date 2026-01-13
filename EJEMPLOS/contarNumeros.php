<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contar numeros</title>
</head>
<body>
    <h1>El valor introducido fue 
        <?php
            echo $_POST["limit"];
        ?>
    </h1>
        <?php
            
            $value = $_POST["limit"];
            if ($value == 0 || $value == null){
                echo "<h3> No puedo contar hasta 0 bro >:( </h3>";
            }else {
                echo "<p>Vamos a contar</p><ul>";
                $i = 0;
                while($i < $value){
                    $i++;
                    echo  "<li>$i</li>";
                };
                echo "</ul>";
            };
        ?>
    </ul>
</body>
</html>