<?php
require_once "config.php";

// Variables
$equipo = $nombre_jugador = $posicion = $numero = "";
$equipo_err = $nombre_jugador_err = $posicion_err = $numero_err = "";

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // EQUIPO
    $input_equipo = trim($_POST["equipo"]);
    if (empty($input_equipo)) {
        $equipo_err = "Introduce el nombre del equipo.";
    } else {
        $equipo = $input_equipo;
    }

    // NOMBRE DEL JUGADOR
    $input_nombre = trim($_POST["nombre_jugador"]);
    if (empty($input_nombre)) {
        $nombre_jugador_err = "Introduce el nombre del jugador.";
    } else {
        $nombre_jugador = $input_nombre;
    }

    // POSICIÓN
    $input_posicion = trim($_POST["posicion"]);
    if (empty($input_posicion)) {
        $posicion_err = "Introduce la posición.";
    } else {
        $posicion = $input_posicion;
    }

    // NÚMERO
    $input_numero = trim($_POST["numero"]);
    if (empty($input_numero)) {
        $numero_err = "Introduce el número.";
    } elseif (!ctype_digit($input_numero)) {
        $numero_err = "Debe ser un número entero.";
    } else {
        $numero = $input_numero;
    }

    // Si no hay errores → insertar
    if (empty($equipo_err) && empty($nombre_jugador_err) && empty($posicion_err) && empty($numero_err)) {

        $sql = "INSERT INTO plantillas_baloncesto_25_26 (equipo, nombre_jugador, posicion, numero)
                VALUES (:equipo, :nombre_jugador, :posicion, :numero)";

        if ($stmt = $pdo->prepare($sql)) {

            $stmt->bindParam(":equipo", $equipo);
            $stmt->bindParam(":nombre_jugador", $nombre_jugador);
            $stmt->bindParam(":posicion", $posicion);
            $stmt->bindParam(":numero", $numero);

            if ($stmt->execute()) {
                header("location: index.php");
                exit();
            } else {
                echo "Error al guardar en la base de datos.";
            }
        }

        unset($stmt);
    }

    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Añadir jugador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="wrapper" style="width:600px; margin:auto;">
        <h2 class="mt-5">Añadir jugador</h2>
        <p>Rellena el formulario para añadir un jugador a la tabla.</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group">
                <label>Equipo</label>
                <input type="text" name="equipo"
                    class="form-control <?php echo (!empty($equipo_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $equipo; ?>">
                <span class="invalid-feedback"><?php echo $equipo_err; ?></span>
            </div>

            <div class="form-group">
                <label>Nombre del Jugador</label>
                <input type="text" name="nombre_jugador"
                    class="form-control <?php echo (!empty($nombre_jugador_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $nombre_jugador; ?>">
                <span class="invalid-feedback"><?php echo $nombre_jugador_err; ?></span>
            </div>

            <div class="form-group">
                <label>Posición</label>
                <input type="text" name="posicion"
                    class="form-control <?php echo (!empty($posicion_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $posicion; ?>">
                <span class="invalid-feedback"><?php echo $posicion_err; ?></span>
            </div>

            <div class="form-group">
                <label>Número</label>
                <input type="text" name="numero"
                    class="form-control <?php echo (!empty($numero_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $numero; ?>">
                <span class="invalid-feedback"><?php echo $numero_err; ?></span>
            </div>

            <input type="submit" class="btn btn-primary" value="Guardar">
            <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>

        </form>
    </div>
</body>

</html>