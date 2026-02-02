<?php
$latitude = 42.343059;
$longitude = -7.870041;

$capaSeleccionada = isset($_GET['estilo']) ? $_GET['estilo'] : 'satelite';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base target="_top">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tile Layers</title>

    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        html,
        body {
            height: 100%;
            margin: 20px;
            font-family: sans-serif;
        }

        /* ESTILOS DEL MAPA */
        #map {
            width: 800px;
            height: 600px;
            position: relative;
        }

        /* ESTILOS MINIMALISTAS DEL SELECT */
        #mapSelect {
            /* Posicionamiento flotante */
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 1000;
            /* Para que quede ENCIMA del mapa */

            /* Estética */
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 6px;
            padding: 8px 35px 8px 15px;
            font-size: 14px;
            color: #333;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

            /* Flecha SVG personalizada */
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23333%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 10px;
            transition: all 0.2s ease;
        }

        #mapSelect:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            transform: translateY(-1px);
        }

        #mapSelect:focus {
            outline: none;
            border-color: #555;
        }
    </style>
</head>

<body>

    <div id="map">
        <form action="" method="GET">
            <select id="mapSelect" name="estilo" onchange="this.form.submit()">
                <option value="satelite" <?php echo ($capaSeleccionada == 'satelite') ? 'selected' : ''; ?>>Satélite
                </option>
                <option value="noche" <?php echo ($capaSeleccionada == 'noche') ? 'selected' : ''; ?>>Modo Noche</option>
                <option value="relieve" <?php echo ($capaSeleccionada == 'relieve') ? 'selected' : ''; ?>>Relieve</option>
            </select>
        </form>
    </div>

    <script>
        var Stadia_AlidadeSatellite = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_satellite/{z}/{x}/{y}{r}.{ext}', {
            minZoom: 0,
            maxZoom: 20,
            ext: 'jpg'
        });

        var Stadia_AlidadeSmoothDark = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.{ext}', {
            minZoom: 0,
            maxZoom: 20,
            ext: 'png'
        });

        var Esri_WorldImagery2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        });

        var capas = {
            satelite: Stadia_AlidadeSatellite,
            noche: Stadia_AlidadeSmoothDark,
            relieve: Esri_WorldImagery2,
        }

        var estiloPHP = "<?php echo $capaSeleccionada; ?>";

        var capaInicial = capas[estiloPHP] || Stadia_AlidadeSatellite;

        const map = L.map('map', {
            center: [<?php echo "$latitude" ?>, <?php echo "$longitude" ?>],
            zoom: 13,
            layers: [capaInicial]
        });
    </script>

</body>

</html>