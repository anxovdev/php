<?php
include('../phpqrcode/qrlib.php');
if (isset($_GET['texto'])) {
    $contenido = $_GET['texto'];
} else {
    $contenido = 'Sin datos';
}
header('Content-Type: image/png');
QRcode::png($contenido, null, 'L', 10, 2);
?>