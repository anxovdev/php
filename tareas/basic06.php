<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    echo "<h2>Multiplication Table</h2>";
    echo "<table border='1'>";
    echo "<tr><th>X</th>";
    
    for ($j = 1; $j <= 10; $j++) {
        echo "<th>$j</th>";
    }
    echo "</tr>";

    for ($i = 1; $i <= 10; $i++) {
        echo "<tr>";

        echo "<th>$i</th>";

        for ($j = 1; $j <= 10; $j++) {
            echo "<td>",$i * $j,"</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
    ?>
</body>

</html>