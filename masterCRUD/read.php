<?php
// Verificar si existe el parámetro id
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

    require_once "config.php";

    // Consulta
    $sql = "SELECT * FROM plantillas_baloncesto_25_26 WHERE id = :id";

    if ($stmt = $pdo->prepare($sql)) {

        $stmt->bindParam(":id", $param_id);

        // Obtener id
        $param_id = trim($_GET["id"]);

        // Ejecutar
        if ($stmt->execute()) {

            if ($stmt->rowCount() == 1) {

                // Obtener la fila
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Extraer valores
                $equipo = $row["equipo"];
                $nombre = $row["nombre_jugador"];
                $posicion = $row["posicion"];
                $numero = $row["numero"];

            } else {
                // id no válido
                header("location: error.php");
                exit();
            }

        } else {
            echo "Oops! Algo salió mal. Inténtalo más tarde.";
        }
    }

    unset($stmt);
    unset($pdo);

} else {

    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ver Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <h1 class="mt-5 mb-3">Detalles del Jugador</h1>

                    <div class="form-group">
                        <label>Equipo</label>
                        <p><b><?php echo $equipo; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Nombre del Jugador</label>
                        <p><b><?php echo $nombre; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Posición</label>
                        <p><b><?php echo $posicion; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Número</label>
                        <p><b><?php echo $numero; ?></b></p>
                    </div>

                    <p><a href="index.php" class="btn btn-primary">Volver</a></p>

                </div>
            </div>
        </div>
    </div>
</body>

</html>