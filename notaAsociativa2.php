<?php
// Creamos el array asociativo sin usar array()
//$estudiantesNotas = []; no es estrictamente necesario
$estudiantesNotas["Ana"] = 7.5;
$estudiantesNotas["Luis"] = 8.0;
$estudiantesNotas["María"] = 6.5;
$estudiantesNotas["Carlos"] = 9.0;
$estudiantesNotas["Sofía"] = 7.8;

// Recorremos el array asociativo con while
$keys = array_keys($estudiantesNotas);
$i = 0;
while ($i < count($estudiantesNotas)) {
    $estudiante = $keys[$i];
    $nota = $estudiantesNotas[$estudiante];
    echo "La nota de $estudiante es $nota<br>";
    $i++;
}

