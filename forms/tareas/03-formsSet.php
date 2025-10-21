<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms set 3</title>
</head>

<body>
    <h1>Calculadora peso</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        Genero:
        <br>
        <input type="radio" name="gender" value="female">Female
        <input type="radio" name="gender" value="male">Male
        <br>
        <br>
        Height:
        <br>
        <input type="number" name="height">
        <br>
        <br>
        Weight
        <input type="number" name="weight">
        <br>
        <input type="submit" value="enviar">
    </form>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $genero = $_POST["gender"];
        $altura = floatval($_POST["height"]);
        $peso = floatval($_POST["weight"]);
        $pesoIdeal = 0;

        // Cálculo general basado en la tabla (sin arrays ni elseif)
        if ($genero == "male") {
            $pesoIdeal = 50 + (($altura - 1.50) / 0.02) * 3;
        } elseif ($genero == "female") {
            $pesoIdeal = 48 + (($altura - 1.50) / 0.02) * 2.5;
        }

        $pesoIdeal = round($pesoIdeal, 1);

        echo "Tu peso ideal aproximado es <strong>$pesoIdeal kg</strong>.<br>";

        if ($peso < $pesoIdeal - 1) {
            echo "Estás por debajo de tu peso ideal.";
        } elseif ($peso > $pesoIdeal + 1) {
            echo "Estás por encima de tu peso ideal.";
        } else {
            echo "¡Estás en tu peso ideal!";
        }
    }
    ?>

</body>

</html>