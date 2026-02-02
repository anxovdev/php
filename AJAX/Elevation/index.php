<?php
$latitude = 42.343059;
$longitude = -7.870041;

if (isset($_GET['lat']) && isset($_GET['lng'])) {

    header('Content-Type: application/json');

    $lat = $_GET['lat'];
    $lng = $_GET['lng'];

    $apiUrl = "https://api.open-meteo.com/v1/elevation?latitude=" . $lat . "&longitude=" . $lng;

    $opciones = [
        "ssl" => [
            "verify_peer" => false,
            "verify_peer_name" => false,
        ],
        "http" => [
            "timeout" => 5
        ]
    ];

    $contexto = stream_context_create($opciones);
    $response = @file_get_contents($apiUrl, false, $contexto);

    if ($response === FALSE) {
        echo json_encode(["error" => "Error conectando con Open-Meteo"]);
    } else {
        echo $response;
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <base target="_top">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elevación - Open-Meteo</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #map {
            width: 600px;
            height: 600px;
            border: 2px solid #333;
            border-radius: 4px;
        }

        #info-panel {
            width: 400px;
            margin-top: 15px;
            text-align: center;
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .dato-altura {
            font-weight: bold;
            color: #2980b9;
            /* Azul para variar */
            font-size: 1.4em;
        }
    </style>
</head>

<body>

    <div id="map"></div>

    <div id="info-panel">
        <p id="resultado">Haz clic en el mapa para ver la altura.</p>
    </div>

    <script>
        const map = L.map('map').setView([<?php echo $latitude; ?>, <?php echo $longitude; ?>], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        let currentMarker = null;

        function onMapClick(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;
            const resultadoP = document.getElementById('resultado');

            // Mover marcador
            if (currentMarker) {
                currentMarker.setLatLng(e.latlng);
            } else {
                currentMarker = L.marker(e.latlng).addTo(map);
            }

            resultadoP.innerHTML = "Conectando con satélite...";

            fetch(`index.php?lat=${lat}&lng=${lng}`)
                .then(response => response.json())
                .then(data => {

                    if (data.elevation && data.elevation.length > 0) {
                        const meters = data.elevation[0];

                        resultadoP.innerHTML = `
                            Coordenadas: ${lat.toFixed(4)}, ${lng.toFixed(4)}<br>
                            Altura: <span class="dato-altura">${meters} metros</span>
                        `;
                    } else if (data.error) {
                        resultadoP.innerHTML = "Error de API: " + data.error;
                    } else {
                        resultadoP.innerHTML = "No se encontraron datos.";
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    resultadoP.innerHTML = "Error de conexión (Revisa la consola F12).";
                });
        }

        map.on('click', onMapClick);

    </script>

</body>

</html>