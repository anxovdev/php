<?php // content="text/plain; charset=utf-8"
require_once('../jpgraph/jpgraph.php');
require_once('../jpgraph/jpgraph_line.php');

// 1. CONFIGURACIÓN Y LECTURA
// Usamos __DIR__ para asegurar que busca el txt en la misma carpeta que este script
$filePath = __DIR__ . "/lang.txt";

// Verificamos si existe el archivo antes de intentar leerlo
if (!file_exists($filePath)) {
    die("Error: El archivo no existe en: " . $filePath);
}

// Leemos el archivo
$data_lines = file($filePath, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);

//Creamos los arrays necesario para guardar los datos de las lineas y de los nombres
$datay = [];
$names = [];

if ($data_lines === false) {
    die("Error: No se pudo leer el contenido del archivo.");
}

// 2. PROCESAMIENTO DE DATOS
foreach ($data_lines as $line) {
    // Dividimos la línea por el delimitador '#'
    $parts = explode('#', $line);

    // El primer elemento es el nombre (leyenda)
    $name = array_shift($parts);
    $names[] = $name;

    // Los elementos restantes son los datos. 
    // Los convertimos a enteros para que JPGraph los entienda bien.
    $datay[] = array_map('intval', $parts);
}

// Verificación: Necesitamos al menos 3 líneas de datos
if (count($datay) < 3) {
    die("Error: El archivo lang.txt debe tener al menos 3 líneas de datos.");
}

// Cada una de las líneas del gráfico
$dataLine1 = $datay[0];
$dataLine2 = $datay[1];
$dataLine3 = $datay[2];


// 3. CONFIGURACIÓN DEL GRÁFICO
$graph = new Graph(600, 550);
$graph->SetScale("textlin", 0, 100);
$graph->yaxis->SetTickPositions(array(0, 20, 40, 60, 80, 100));

$theme_class = new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->title->Set('Backend Programming Languages');
$graph->SetBox(false);

$graph->SetMargin(40, 20, 36, 63);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false, false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels(array('2014', '2018', '2021', '2024'));
$graph->xgrid->SetColor('#E3E3E3');

// Línea 1
$p1 = new LinePlot($dataLine1);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend($names[0]);

// Línea 2
$p2 = new LinePlot($dataLine2);
$graph->Add($p2);
$p2->SetColor("#B22222");
$p2->SetLegend($names[1]);

// Línea 3
$p3 = new LinePlot($dataLine3);
$graph->Add($p3);
$p3->SetColor("#FF1493");
$p3->SetLegend($names[2]);

$graph->legend->SetFrameWeight(1);

// Generar la imagen
$graph->Stroke();

?>