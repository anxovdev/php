<?php
// Array de estudiantes creado con array()
$estudiantes = array("Ana", "Luis", "María", "Carlos", "Sofía");

// Array de notas creado con índices manuales
$notas[0] = 7.5;
$notas[1] = 8.0;
$notas[2] = 6.5;
$notas[3] = 9.0;
$notas[4] = 7.8;

// Inicializamos el contador para el while
$i = 0;
while ($i < count($estudiantes)) {
    echo "La nota de " . $estudiantes[$i] . " es " . $notas[$i] . "<br>";
    $i++;
}
?>