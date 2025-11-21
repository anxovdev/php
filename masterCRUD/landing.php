<?php
include "protect.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard – Plantillas Baloncesto 25/26</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .wrapper {
            width: 900px;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 150px;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Plantillas Baloncesto 25/26</h2>
                        <a href="create.php" class="btn btn-success pull-right">
                            <i class="fa fa-plus"></i> Añadir Jugador
                        </a>
                    </div>

                    <?php
                    require_once "config.php";

                    // Query actual
                    $sql = "SELECT * FROM plantillas_baloncesto_25_26";

                    if ($result = $pdo->query($sql)) {
                        if ($result->rowCount() > 0) {

                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>ID</th>";
                            echo "<th>Equipo</th>";
                            echo "<th>Jugador</th>";
                            echo "<th>Posición</th>";
                            echo "<th>Número</th>";
                            echo "<th>Acciones</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            while ($row = $result->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['equipo'] . "</td>";
                                echo "<td>" . $row['nombre_jugador'] . "</td>";
                                echo "<td>" . $row['posicion'] . "</td>";
                                echo "<td>" . $row['numero'] . "</td>";

                                echo "<td>";
                                echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="Ver" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Editar" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                echo '<a href="delete.php?id=' . $row['id'] . '" title="Eliminar" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                echo "</td>";

                                echo "</tr>";
                            }

                            echo "</tbody>";
                            echo "</table>";

                            unset($result);

                        } else {
                            echo '<div class="alert alert-danger"><em>No hay registros.</em></div>';
                        }
                    } else {
                        echo "Error en la consulta.";
                    }

                    unset($pdo);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>