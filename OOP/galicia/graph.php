<?php

// INCLUDES Y CONFIGURACIÓN

require_once('../jpgraph/jpgraph.php');
require_once('../jpgraph/jpgraph_pie.php');
require_once('../jpgraph/jpgraph_pie3d.php');

// 1. LEER DATOS (data.txt)

$filename = 'data.txt';
$data_population = array();
$data_labels = array();
$data_colors = array();
$explode_index = -1;

// Mapa de colores (normalizado)

$color_map = array(
    'coruna' => 'red',
    'coruña' => 'red',
    'lugo' => 'blue',
    'ourense' => 'yellow',
    'orense' => 'yellow',
    'pontevedra' => 'green'
);

if (file_exists($filename)) {
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $index => $line) {
        // Evitamos líneas vacías o mal formadas

        if (strpos($line, '#') === false)
            continue;

        list($name, $population) = explode('#', trim($line));

        $name = trim($name);
        $population = (int) trim($population);

        $data_population[] = $population;

        // Etiqueta simple para el sector
        $data_labels[] = $name;

        // Asignar color
        $name_lower = strtolower($name);
        // Quitamos acentos para comparar
        $name_clean = str_replace(array('á', 'é', 'í', 'ó', 'ú', 'ñ'), array('a', 'e', 'i', 'o', 'u', 'n'), $name_lower);

        $color_assigned = 'gray'; // Fallback
        foreach ($color_map as $key => $color) {
            if (strpos($name_clean, $key) !== false || strpos($name_lower, $key) !== false) {
                $color_assigned = $color;
                break;
            }
        }
        $data_colors[] = $color_assigned;

        // Detectar Ourense para separar
        if (strpos($name_clean, 'ourense') !== false || strpos($name_clean, 'orense') !== false) {
            $explode_index = $index;
        }
    }
} else {
    // Genera una imagen de error si falta el archivo
    $graph = new PieGraph(400, 200);
    $graph->title->Set("Error: Faltan datos");
    $graph->Stroke();
    exit;
}

// 2. CONFIGURACIÓN DEL GRÁFICO (Basado en el ejemplo que funciona)

$graph = new PieGraph(600, 450, 'auto');

// Configurar el tema
$theme_class = "VividTheme";
$graph->SetTheme(new $theme_class());

// Configuración de fondo
if (file_exists('galicia.jpeg')) {
    $graph->SetBackgroundImage('galicia.jpeg', BGIMG_FILLFRAME);
}

// Título
$graph->title->Set("Población de Galicia");
// Usamos FF_DEFAULT (Arial/Helvetica) en lugar de FF_FONT1 para evitar errores de fuentes bitmap
$graph->title->SetFont(FF_DEFAULT, FS_BOLD, 14);
$graph->title->SetColor('white'); // Blanco para que se vea sobre la foto oscura

// 3. Pie

$p1 = new PiePlot3D($data_population);

// Configuración de colores y posición
$p1->SetSliceColors($data_colors);


$p1->SetSize(0.25);

$p1->SetEdge(false); // Quitar bordes negros para estilo más limpio
$p1->SetHeight(20);  // Grosor del 3D

// Etiquetas dentro de los sectores
$p1->SetLabels($data_labels);
$p1->SetLabelPos(0.6); // Posición relativa al centro (0.5 es mitad del radio)

// Configuración de fuente de las etiquetas
$p1->value->SetFont(FF_DEFAULT, FS_BOLD, 10);
$p1->value->SetColor('black'); // Color del texto de las etiquetas

// Separar Ourense
if ($explode_index !== -1) {
    $p1->ExplodeSlice($explode_index, 30);
}

// Ángulo de visión
$p1->SetAngle(45);

$graph->Add($p1);

// 4. GENERAR

$graph->SetAntiAliasing(false); // Desactivar AA a veces ayuda con fondos complejos
$graph->Stroke();

?>