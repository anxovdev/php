<?php
// index.php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once 'src/DesignadorManual.php';
$app = new DesignadorManual();

// --- PROCESAR FORMULARIOS ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Añadir Árbitro
    if (isset($_POST['btn_add_arbitro'])) {
        $app->agregarArbitro($_POST['nombre'], $_POST['apellidos'], $_POST['categoria']);
    }
    // 2. Añadir Partido
    elseif (isset($_POST['btn_add_partido'])) {
        $app->agregarPartido(
            $_POST['division'],
            $_POST['categoria_juego'],
            $_POST['genero'],
            $_POST['local'],
            $_POST['visitante'],
            $_POST['pabellon'],
            $_POST['fecha'],
            $_POST['hora']
        );
    }
    // 3. Guardar una designación específica
    elseif (isset($_POST['btn_guardar_designacion'])) {
        $app->guardarDesignacion($_POST['partido_id'], $_POST['arb_principal'], $_POST['arb_auxiliar']);
    }
    // 4. Reset
    elseif (isset($_POST['btn_reset'])) {
        session_destroy();
        header("Location: index.php");
        exit;
    }
}

// Variables para vista
$partidos = $app->getPartidos();
$asignaciones = $app->getAsignaciones();
$modoEdicion = false;
$partidoAEditar = null;
$arbitrosDisponibles = [];

// Verificar si estamos editando un partido concreto (GET)
if (isset($_GET['editar_id'])) {
    foreach ($partidos as $p) {
        if ($p['id'] === $_GET['editar_id']) {
            $modoEdicion = true;
            $partidoAEditar = $p;
            // Calcular disponibles EXCLUYENDO los que pitan a la misma hora en otro sitio
            $arbitrosDisponibles = $app->getArbitrosDisponibles($p['id'], $p['fecha'], $p['hora']);
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Designador Manual</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 20px; max-width: 1200px; margin: 0 auto; }
        .grid { display: grid; grid-template-columns: 1fr 2fr; gap: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        h2 { margin-top: 0; color: #333; border-bottom: 2px solid #007bff; padding-bottom: 5px; }
        input, select { width: 100%; padding: 8px; margin-bottom: 10px; box-sizing: border-box; }
        .btn { padding: 10px 15px; border: none; cursor: pointer; color: white; font-weight: bold; border-radius: 4px; }
        .btn-blue { background: #007bff; }
        .btn-green { background: #28a745; }
        .btn-red { background: #dc3545; }
        .btn-sm { padding: 5px 10px; font-size: 0.8em; text-decoration: none; display: inline-block; }
        
        /* Tabla de partidos */
        .match-row { display: flex; justify-content: space-between; align-items: center; background: #f9f9f9; padding: 10px; border-left: 5px solid #ccc; margin-bottom: 5px; }
        .match-row.ok { border-left-color: #28a745; background: #e8f5e9; } /* Verde si ya tiene árbitros */
        .match-info { font-size: 0.9em; }
        .match-refs { font-size: 0.85em; color: #555; font-style: italic; }
        
        /* Modal simulado para edición */
        .edit-panel { background: #e3f2fd; border: 2px solid #2196f3; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
    </style>
</head>
<body>

    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1>🏀 Gestión de Designaciones</h1>
        <form method="POST"><button name="btn_reset" class="btn btn-red">Borrar Todo</button></form>
    </div>

    <?php if ($modoEdicion && $partidoAEditar): ?>
            <?php
            // Pre-seleccionar si ya estaba guardado
            $selPrincipal = $asignaciones[$partidoAEditar['id']]['principal'] ?? '';
            $selAuxiliar = $asignaciones[$partidoAEditar['id']]['auxiliar'] ?? '';
            ?>
            <div class="edit-panel">
                <h3>Designando para: <?php echo $partidoAEditar['info']; ?></h3>
                <p>📅 <?php echo "{$partidoAEditar['fecha']} - {$partidoAEditar['hora']} | 📍 {$partidoAEditar['pabellon']}"; ?></p>
            
                <form method="POST" action="index.php">
                    <input type="hidden" name="partido_id" value="<?php echo $partidoAEditar['id']; ?>">
                
                    <div style="display:flex; gap: 20px;">
                        <div style="flex:1">
                            <label><b>Árbitro Principal:</b></label>
                            <select name="arb_principal" required>
                                <option value="">-- Seleccionar --</option>
                                <?php foreach ($arbitrosDisponibles as $arb): ?>
                                        <option value="<?php echo $arb['id']; ?>" <?php if ($arb['id'] == $selPrincipal)
                                               echo 'selected'; ?>>
                                            <?php echo $arb['nombre'] . " (" . $arb['categoria'] . ")"; ?>
                                        </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div style="flex:1">
                            <label><b>Árbitro Auxiliar:</b></label>
                            <select name="arb_auxiliar" required>
                                <option value="">-- Seleccionar --</option>
                                <?php foreach ($arbitrosDisponibles as $arb): ?>
                                        <option value="<?php echo $arb['id']; ?>" <?php if ($arb['id'] == $selAuxiliar)
                                               echo 'selected'; ?>>
                                            <?php echo $arb['nombre'] . " (" . $arb['categoria'] . ")"; ?>
                                        </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="btn_guardar_designacion" class="btn btn-green">💾 Guardar Asignación</button>
                    <a href="index.php" class="btn btn-red" style="text-decoration:none;">Cancelar</a>
                </form>
            </div>
    <?php endif; ?>

    <div class="grid">
        <div class="left-col">
            <div class="card">
                <h2>1. Alta Árbitro</h2>
                <form method="POST">
                    <input type="text" name="nombre" placeholder="Nombre" required>
                    <input type="text" name="apellidos" placeholder="Apellidos" required>
                    <select name="categoria" required>
                        <option value="" disabled selected>Categoría</option>
                        <option value="Grupo 1">Grupo 1</option>
                        <option value="Disponibles">Disponibles</option>
                        <option value="Sub-25">Sub-25</option>
                        <option value="ESGAR">ESGAR</option>
                        <option value="Zonal">Zonal</option>
                    </select>
                    <button type="submit" name="btn_add_arbitro" class="btn btn-blue">➕ Añadir</button>
                </form>
            </div>

            <div class="card">
                <h2>2. Alta Partido</h2>
                <form method="POST">
                    <label>Género:</label>
                    <div style="margin-bottom:10px;">
                        <input type="radio" name="genero" value="M" required style="width:auto;"> Masc
                        <input type="radio" name="genero" value="F" required style="width:auto;"> Fem
                    </div>

                    <select name="categoria_juego" required>
                        <option value="" disabled selected>Categoría</option>
                        <option value="Senior">Senior</option>
                        <option value="Junior">Junior</option>
                        <option value="Cadete">Cadete</option>
                        <option value="Infantil">Infantil</option>
                        <option value="Mini">Mini</option>
                        <option value="Premini">Premini</option>
                    </select>

                    <select name="division" required>
                        <option value="" disabled selected>División</option>
                        <option value="1ª Autonómica">1ª Autonómica (Solo Fem)</option>
                        <option value="1ª">1ª División</option>
                        <option value="2ª">2ª División</option>
                        <option value="3ª">3ª División (Senior Masc)</option>
                    </select>
                    
                    <input type="text" name="local" placeholder="Equipo Local" required>
                    <input type="text" name="visitante" placeholder="Equipo Visitante" required>
                    <input type="text" name="pabellon" placeholder="Pabellón" required>
                    <div style="display:flex; gap:5px;">
                        <input type="date" name="fecha" required>
                        <input type="time" name="hora" required>
                    </div>
                    <button type="submit" name="btn_add_partido" class="btn btn-blue">➕ Añadir</button>
                </form>
            </div>
        </div>

        <div class="right-col">
            <div class="card">
                <h2>📋 Listado de Jornada (<?php echo count($partidos); ?>)</h2>
                <p style="font-size:0.8em; color:#666;">Selecciona "Designar" para asignar árbitros. El sistema solo mostrará los disponibles en esa hora.</p>
                
                <?php if (empty($partidos)): ?>
                        <p>No hay partidos registrados.</p>
                <?php else: ?>
                        <?php foreach ($partidos as $p): ?>
                                <?php
                                $asignado = isset($asignaciones[$p['id']]);
                                $clase = $asignado ? 'ok' : '';
                                ?>
                                <div class="match-row <?php echo $clase; ?>">
                                    <div class="match-info">
                                        <strong><?php echo $p['info']; ?></strong><br>
                                        <span>📍 <?php echo $p['pabellon']; ?> | ⏰ <?php echo $p['fecha'] . " " . $p['hora']; ?></span>
                                
                                        <?php if ($asignado): ?>
                                                <div class="match-refs">
                                                    👮 Princ: <?php echo $app->getNombreArbitro($asignaciones[$p['id']]['principal']); ?><br>
                                                    👮 Aux: <?php echo $app->getNombreArbitro($asignaciones[$p['id']]['auxiliar']); ?>
                                                </div>
                                        <?php endif; ?>
                                    </div>
                            
                                    <div>
                                        <a href="index.php?editar_id=<?php echo $p['id']; ?>" class="btn btn-sm <?php echo $asignado ? 'btn-green' : 'btn-blue'; ?>">
                                            <?php echo $asignado ? '✏️ Editar' : '👉 Designar'; ?>
                                        </a>
                                    </div>
                                </div>
                        <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="card">
                <h3>Árbitros en base de datos: <?php echo count($app->getArbitros()); ?></h3>
                <ul style="font-size:0.8em;">
                    <?php foreach ($app->getArbitros() as $a): ?>
                            <li><?php echo $a['nombre']; ?> (<?php echo $a['categoria']; ?>)</li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

</body>
</html>