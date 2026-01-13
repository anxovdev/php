<?php
$apiKey = "06cabeef59b7d47c0fc3b83962755eba";
$cityId = "3114965";
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();
?>

<!doctype html>
<html>

<head>
    <title>Forecast Weather using OpenWeatherMap with PHP</title>
    Para lograr un estilo "Elegante", nos alejaremos del minimalismo plano y utilizaremos una estética conocida como
    "Glassmorphism" (Efecto Cristal) en modo oscuro.

    Esto implica:

    Tipografía Serif: Una fuente clásica para el título (como las de las revistas de moda).

    Transparencias y Blur: La tarjeta parecerá un cristal flotando sobre un fondo profundo.

    Monocromía: Iconos y textos en blanco para máxima sofisticación.

    Aquí tienes el código completo:

    PHP

    <?php
    $apiKey = "06cabeef59b7d47c0fc3b83962755eba";
    $cityId = "3114965";
    $googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($response);
    $currentTime = time();
    ?>

    <!doctype html>
    <html>

    <head>
        <title>Elegant Weather</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap"
            rel="stylesheet">

        <style>
            /* 1. Configuración de página y centrado perfecto */
            body {
                font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", "Segoe UI", Roboto, sans-serif;
                background-color: #000;
                /* Fondo negro estilo iOS */
                min-height: 100vh;
                /* Ocupa toda la altura de la pantalla */
                margin: 0;
                display: flex;
                /* Flexbox para centrar */
                justify-content: center;
                /* Centrado horizontal */
                align-items: center;
                /* Centrado vertical */
            }

            /* 2. Tarjeta estilo Widget iOS */
            .report-container {
                background: linear-gradient(180deg, #5AB2F8 0%, #2E8CE9 50%, #1562C1 100%);
                width: 320px;
                padding: 50px 20px;
                border-radius: 45px;
                /* Bordes muy redondeados */
                color: white;
                text-align: center;
                box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5);
                /* Sombra profunda */
                position: relative;
            }

            /* 3. Ciudad */
            h2 {
                margin: 0;
                font-size: 2.1rem;
                font-weight: 500;
                letter-spacing: 0.5px;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            /* 4. Temperatura Principal (Grande y Fina) */
            .main-temp {
                font-size: 6.5rem;
                font-weight: 200;
                /* Thin */
                margin: 0;
                letter-spacing: -3px;
                line-height: 1.1;
            }

            .degree-symbol {
                font-size: 0.5em;
                vertical-align: top;
                position: relative;
                top: 15px;
            }

            /* 5. Estado y Rangos */
            .condition {
                font-size: 1.3rem;
                font-weight: 500;
                text-transform: capitalize;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                margin-bottom: 4px;
            }

            .high-low {
                font-size: 1.2rem;
                font-weight: 400;
                opacity: 0.9;
            }

            .weather-icon-small {
                width: 28px;
                height: 28px;
                filter: drop-shadow(0 2px 2px rgba(0, 0, 0, 0.2));
            }

            /* 6. Caja de detalles (Viento/Humedad) */
            .details-row {
                display: flex;
                justify-content: space-between;
                margin-top: 40px;
                padding: 0 10px;
            }

            .detail-item {
                background: rgba(255, 255, 255, 0.15);
                /* Efecto cristal */
                backdrop-filter: blur(10px);
                border-radius: 20px;
                padding: 15px;
                width: 42%;
                font-size: 1rem;
                font-weight: 600;
            }

            .detail-label {
                display: block;
                font-size: 0.75rem;
                text-transform: uppercase;
                opacity: 0.7;
                margin-bottom: 5px;
            }
        </style>
    </head>

<body>
    <div class="report-container">
        <h2><?php echo $data->name; ?> Weather Status</h2>
        <div class="time">
            <div><?php echo date("l g:i a", $currentTime); ?></div>
            <div><?php echo date("jS F, Y", $currentTime); ?></div>
            <div><?php echo ucwords($data->weather[0]->description); ?></div>
        </div>
        <div class="weather-forecast">
            <img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                class="weather-icon" /> <?php echo $data->main->temp_max; ?>°C<span
                class="min-temperature"><?php echo $data->main->temp_min; ?>°C</span>
        </div>
        <div class="time">
            <div>Humidity: <?php echo $data->main->humidity; ?> %</div>
            <div>Wind: <?php echo $data->wind->speed; ?> km/h</div>
        </div>
    </div>
</body>

</html>