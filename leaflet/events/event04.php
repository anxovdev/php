<?php
// 1. Inicializamos con valores por defecto
$latitude = 42.343059;
$longitude = -7.870041;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lat'])) {
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $fecha = date("Y-m-d H:i:s");

    $content = "Fecha: $fecha, Latitude: $lat, Lonxitude: $lng" . PHP_EOL;
    file_put_contents('event04.txt', $content, FILE_APPEND);

    header("Location: " . $_SERVER['PHP_SELF'] . "?lastLat=$lat&lastLng=$lng");
    exit;
}

if (isset($_GET['lastLat']) && isset($_GET['lastLng'])) {
    $latitude = $_GET['lastLat'];
    $longitude = $_GET['lastLng'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base target="_top">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Click Coordinates - Leaflet</title>

    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .leaflet-container {
            height: 400px;
            width: 600px;
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>

<body>

    <div id="map" style="width: 100%; height: 100%;"></div>

    <form id="coordForm" method="POST">

        <input type="hidden" name="lat" id="lat">

        <input type="hidden" name="lng" id="lng">

    </form>

    <script>
        const map = L.map('map').setView([<?php echo "$latitude"; ?>, <?php echo "$longitude"; ?>], 13);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 25,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        function onMapClick(e) {
            document.getElementById("lat").value = e.latlng.lat;
            document.getElementById("lng").value = e.latlng.lng;

            document.getElementById('coordForm').submit();
        }

        map.on('click', onMapClick);

    </script>

</body>

</html>