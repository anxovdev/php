<?php // content="text/plain; charset=utf-8"
require_once('../jpgraph/jpgraph.php');
require_once('../jpgraph/jpgraph_pie.php');
require_once('../jpgraph/jpgraph_pie3d.php');

// Some data
$data = array(40, 60, 21, 33);

$piepos = array(0.2, 0.35, 0.6, 0.28, 0.3, 0.7, 0.85, 0.7);
$titles = array('USA', 'Sweden', 'South America', 'Australia');

$n = count($piepos) / 2;

// A new graph
$graph = new PieGraph(450, 300, 'auto');

$theme_class = "VividTheme";
$graph->SetTheme(new $theme_class());

// Setup background
$graph->SetBackgroundImage('galicia.jpeg', BGIMG_FILLFRAME);

// Setup title
$graph->title->Set("Pie plots with background image");
$graph->title->SetFont(FF_DEFAULT, FS_BOLD);
$graph->title->SetColor('white');
$graph->SetTitleBackground('#004466@0.3', TITLEBKG_STYLE2, TITLEBKG_FRAME_FULL, '#004466@0.3', 10, 10, true);

$p = array();

// Position the four pies and change color
for ($i = 0; $i < $n; ++$i) {
    $p[$i] = new PiePlot3D($data);
    $graph->Add($p[$i]);

    $p[$i]->SetCenter($piepos[2 * $i], $piepos[2 * $i + 1]);

    // Set the titles
    $p[$i]->title->Set($titles[$i]);
    $p[$i]->title->SetFont(FF_DEFAULT, FS_BOLD, 10);
    $p[$i]->title->SetColor('white');

    // Size of pie in fraction of the width of the graph
    $p[$i]->SetSize(0.17);
    $p[$i]->SetHeight(8);
    $p[$i]->SetEdge(false);
    $p[$i]->ExplodeSlice(1, 7);
    $p[$i]->value->Show(false);
}

$graph->SetAntiAliasing(false);
$graph->Stroke();
?>