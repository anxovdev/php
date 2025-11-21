<?php
// Procesar eliminación después de confirmar
if (isset($_POST["id"]) && !empty($_POST["id"])) {

    require_once "config.php";

    // Sentencia para borrar
    $sql = "DELETE FROM plantillas_baloncesto_25_26 WHERE id = :id";

    if ($stmt = $pdo->prepare($sql)) {

        // Enlazar parámetro
        $stmt->bindParam(":id", $param_id);

        // Obtener id
        $param_id = trim($_POST["id"]);

        // Ejecutar sentencia
        if ($stmt->execute()) {
            header("location: index.php");
            exit();
        } else {
            echo "Oops! Algo salió mal. Inténtalo de nuevo más tarde.";
        }
    }

    unset($stmt);
    unset($pdo);

} else {

    // Comprobar que existe id por GET
    if (empty(trim($_GET["id"]))) {
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Registro</title>
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

                    <h2 class="mt-5 mb-3">Eliminar Registro</h2>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />

                            <p>¿Seguro que deseas eliminar este jugador?</p>

                            <p>
                                <input type="submit" value="Sí" class="btn btn-danger">
                                <a href="index.php" class="btn btn-secondary ml-2">No</a>
                            </p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>

</html>