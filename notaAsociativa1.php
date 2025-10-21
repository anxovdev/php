<?php
// Array asociativo: estudiante => nota
$estudiantesNotas = array(
    "Ana" => 7.5,
    "Luis" => 8.0,
    "María" => 6.5,
    "Carlos" => 9.0,
    "Sofía" => 7.8
);

// Recorremos el array asociativo con while
$keys = array_keys($estudiantesNotas);
$i = 0;
while ($i < count($estudiantesNotas)) {
    $estudiante = $keys[$i];
    $nota = $estudiantesNotas[$estudiante];
    echo "La nota de $estudiante es $nota<br>";
    $i++;
}
?>
