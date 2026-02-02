<?php
$usuario = isset($_GET['usuario']) ? $_GET['usuario'] : '';
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';

if ($usuario && $mensaje) {
    $linea = $usuario . ":" . $mensaje . "\n";
    file_put_contents('mensajes.txt', $linea, FILE_APPEND | LOCK_EX);
}
?>