<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $polygonCoords = $data['polygon'];

    file_put_contents('polygon_save.json', $json);

    $allPoints = [];
    $baseLat = 42.34;
    $baseLng = -7.87;

    for ($i = 0; $i < 100; $i++) {
        $allPoints[] = [
            "id" => $i,
            "name" => "Punto " . $i,
            "lat" => $baseLat + (mt_rand(-500, 500) / 10000),
            "lng" => $baseLng + (mt_rand(-500, 500) / 10000)
        ];
    }

    function isPointInPolygon($point, $polygon)
    {
        $c = false;
        $i = -1;
        $l = count($polygon);
        $j = $l - 1;

        while (++$i < $l) {
            if (
                (($polygon[$i]['lat'] <= $point['lat'] && $point['lat'] < $polygon[$j]['lat']) ||
                    ($polygon[$j]['lat'] <= $point['lat'] && $point['lat'] < $polygon[$i]['lat'])) &&
                ($point['lng'] < ($polygon[$j]['lng'] - $polygon[$i]['lng']) * ($point['lat'] - $polygon[$i]['lat']) / ($polygon[$j]['lat'] - $polygon[$i]['lat']) + $polygon[$i]['lng'])
            ) {
                $c = !$c;
            }
            $j = $i;
        }
        return $c;
    }

    $pointsInside = [];
    foreach ($allPoints as $p) {
        if (isPointInPolygon($p, $polygonCoords)) {
            $pointsInside[] = $p;
        }
    }

    echo json_encode([
        "status" => "success",
        "count" => count($pointsInside),
        "points" => $pointsInside
    ]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Polygon Map</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        #map {
            flex-grow: 1;
            width: 100%;
        }

        #info {
            height: 60px;
            background: #333;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 10px;
        }

        b {
            color: #f1c40f;
        }
    </style>
</head>

<body>
    <div id="info">
        <span id="status">Usa el polígono para dibujar un área.</span>
    </div>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    <script>
        var map = L.map('map').setView([42.3430, -7.8700], 14);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '© OpenStreetMap, © CartoDB'
        }).addTo(map);

        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var resultLayer = new L.LayerGroup().addTo(map);

        var drawControl = new L.Control.Draw({
            draw: {
                polygon: {
                    allowIntersection: false,
                    showArea: true,
                    shapeOptions: { color: '#bada55' }
                },
                marker: false,
                circle: false,
                rectangle: false,
                polyline: false,
                circlemarker: false
            },
            edit: {
                featureGroup: drawnItems,
                remove: true,
                edit: false
            }
        });
        map.addControl(drawControl);

        map.on(L.Draw.Event.CREATED, function (e) {
            var layer = e.layer;

            drawnItems.clearLayers();
            resultLayer.clearLayers();

            drawnItems.addLayer(layer);

            var vertices = layer.getLatLngs()[0];

            document.getElementById('status').innerHTML = "Calculando...";

            fetch('index.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ polygon: vertices })
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('status').innerHTML =
                        `Encontrados <b>${data.count}</b> puntos dentro.`;

                    data.points.forEach(p => {
                        L.marker([p.lat, p.lng])
                            .bindPopup(`<b>${p.name}</b>`)
                            .addTo(resultLayer);
                    });
                })
                .catch(err => {
                    console.error(err);
                    document.getElementById('status').innerHTML = "Error.";
                });
        });

        map.on(L.Draw.Event.DELETED, function () {
            resultLayer.clearLayers();
            document.getElementById('status').innerHTML = "Dibuja un área nueva.";
        });
    </script>
</body>

</html>