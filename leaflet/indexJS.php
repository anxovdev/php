<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ourense Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map {
            width: 500px;
            height: 500px;
        }

        /* Estilos simples para el formulario */
        .controls {
            margin-top: 15px;
            font-family: Arial, sans-serif;
        }

        input {
            padding: 5px;
        }

        button {
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>

<body>

    <div id="map"></div>

    <div class="controls">
        <label for="colorInput">Cambiar color del círculo:</label>
        <input type="text" id="colorInput" placeholder="Ej: blue, green, #000000">
        <button id="updateBtn">Actualizar</button>
    </div>

    <script>
        <?php
        $latitud = 42.3358;
        $longitud = -7.8639;
        ?>

        var map = L.map('map').setView([<?php echo $latitud ?>, <?php echo $longitud ?>], 12);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([42.331378, -7.874870]).addTo(map);

        // Círculo inicial
        var circle = L.circle([42.34074276979661, -7.8758156195969296], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map);

        var popup = L.popup()
            .setLatLng([42.331378, -7.874870])
            .setContent("<a href='https://cifpacarballeira.gal/' target='_blank'>CIFP A Carballeira</a>")
            .openOn(map);

        var polygon = L.polygon([
            [42.34556407488532, -7.874182910958454],
            [42.35780642728298, -7.851187101180619],
            [42.330208308813454, -7.867973585767386]
        ]).addTo(map);

        // NUEVO: Lógica JS para cambiar el color
        document.getElementById('updateBtn').addEventListener('click', function () {
            // 1. Obtenemos el valor escrito en el input
            var newColor = document.getElementById('colorInput').value;

            // 2. Verificamos que no esté vacío
            if (newColor.trim() !== "") {
                // 3. Usamos setStyle de Leaflet para actualizar las propiedades
                circle.setStyle({
                    color: newColor,      // Color del borde
                    fillColor: newColor   // Color del relleno
                });
            } else {
                alert("Por favor, escribe un color.");
            }
        });
    </script>
</body>

</html>