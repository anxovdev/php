<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    // Abrimos el archivo y extraemos los nombres de los equipos
    $file = fopen('./Data/futbol.txt', 'r') or die("Archivo no válido");
    $equipos = [];

    while (($line = fgets($file)) !== false) {
        $data = explode("#", trim($line));
        $equipos[] = $data[0]; // Solo guardamos el nombre del equipo
    }
    fclose($file);

    // Eliminamos duplicados en caso de que un equipo aparezca varias veces
    $equipos = array_unique($equipos);
    ?>

    <form method="GET">
        <select name="option" id="options">
            <?php
            foreach ($equipos as $equipo) {
                // Si el usuario ya seleccionó una opción, la marcamos como seleccionada
                $selected = (isset($_GET['option']) && $_GET['option'] == $equipo) ? "selected" : "";
                echo "<option value='$equipo' $selected>$equipo</option>";
            }
            ?>
        </select>
        <br>
        <br>
        <input type="submit" value="Filtrar">
    </form>

    <?php
     if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['option'])) {
        $result = $_GET["option"];
        // Abrimos el archivo nuevamente
        $file = fopen('./Data/futbol.txt', 'r') or die("Archivo no válido");
        $data = [];

        // Leemos las líneas y guardamos los datos
        while (($line = fgets($file)) !== false) {
            $data[] = explode("#", trim($line));
        }

        // Filtramos por el equipo seleccionado
        $filter = array_filter($data, function ($item) use ($result) {
            return $item[0] == $result;
        });

        // Mostramos resultados
        if (!empty($filter)) {
            echo "<h3>Resultado del filtro para: $result</h3>";
            foreach ($filter as $info) {
                echo "<p><strong>Equipo:</strong> $info[0]<br>";
                echo "<strong>Jugador:</strong> $info[1]<br>";
                echo "<strong>Ciudad:</strong> $info[2]<br>";
                echo "<strong>Valor:</strong> $info[3]</p>";
            }
        } else {
            echo "<p>No se encontró información para $result.</p>";
        }

        fclose($file);
    }
    ?>
</body>

</html>