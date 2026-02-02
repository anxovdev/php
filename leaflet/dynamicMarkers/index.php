<?php
$latitude = 42.343059;
$longitude = -7.870041;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base target="_top">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Quick Start - Leaflet</title>

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

    <div id="map" style="width: 800px; height: 600px;"></div>
    <script>
        // Initialize the map
        const map = L.map('map').setView([<?php echo "$latitude"; ?>, <?php echo "$longitude"; ?>], 13);

        // Add the OpenStreetMap tiles
        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 25,
        }).addTo(map);

        // Read markers from the PHP file
        <?php
        $jsonCont = file_get_contents('mapFavorites.json');
        $marks = json_decode($jsonCont, true);

        if ($marks) {
            foreach ($marks as $item) {
                $latitud = $item['latitude'];
                $longitud = $item['longitude'];
                $text = $item['name'];
                $url = $item['url'];
                ?>

                L.marker([<?php echo $latitud; ?>, <?php echo $longitud; ?>])
                    .addTo(map)
                    .bindPopup(<?php echo json_encode("<b>$text</b><br><a href='$url' target='_blank'>Web del sitio</a>"); ?>);

                <?php

            }
        }
        ?>
    </script>

</body>

</html>