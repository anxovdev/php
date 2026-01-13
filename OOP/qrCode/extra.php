<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista QR con PDO</title>
    <style>
        body {
            display: flex;
            font-family: sans-serif;
            padding: 20px;
        }

        .col-izq {
            width: 40%;
            border-right: 1px solid #ccc;
            padding-right: 20px;
        }

        .col-der {
            width: 60%;
            text-align: center;
            position: fixed;
            right: 0;
            top: 50px;
        }

        .item {
            display: block;
            padding: 10px;
            background: #eee;
            margin-bottom: 5px;
            text-decoration: none;
            color: black;
        }

        .item:hover {
            background: orange;
        }

        .error {
            color: red;
        }

        p {
            font-size: 14px;
        }
    </style>
</head>

<body>

    <?php
    $servername = "localhost";
    $username = "wuser";
    $password = "abc123.";
    $myDB = "gestion_qr";

    $urlSelected = "";
    $nameSelected = "";

    try {
        // Conexión a la base de datos
        $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /* Si existe el ID del enlace que pulsas, selecciona la URL y el nombre y 
        lo incluye en dos variables personalizadas */
        if (isset($_GET['id'])) {
            $stmt = $conn->prepare("SELECT * FROM enlaces WHERE id = :id");
            $stmt->execute(['id' => $_GET['id']]);
            $fila_seleccionada = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($fila_seleccionada) {
                $urlSelected = $fila_seleccionada['url'];
                $nameSelected = $fila_seleccionada['nombre_sitio'];
            }
        }

        /* Creación del primer div que tendrá todos los enlaces a mostrar */

        echo '<div class="col-izq">';
        echo '<h3>Lista de Webs</h3>';

        $sql = "SELECT * FROM enlaces";
        $results = $conn->query($sql);

        foreach ($results as $row) {
            echo '<a class="item" href="extra.php?id=' . $row['id'] . '">';
            echo $row['nombre_sitio'] . "<br>";
            echo "<p>" . $row['url'] . "</p>";
            echo '</a>';
        }

        echo '</div>';

    } catch (PDOException $e) {
        echo "<p class='error'>Connection failed: " . $e->getMessage() . "</p>";
    }

    $conn = null;
    ?>

    /* Creación dels egundo div, en el que si la url no esta vacía, utiliza qr.php para
    generar el codigo qr del enlace seleccionado*/
    <div class="col-der">
        <?php if ($urlSelected != ""): ?>

            <h2>QR de: <?php echo $nameSelected; ?></h2>

            <img src="qr.php?texto=<?php echo urlencode($urlSelected); ?>" border="1">

        <?php else: ?>
            <h3>Selecciona una web de la lista</h3>
        <?php endif; ?>
    </div>

</body>

</html>