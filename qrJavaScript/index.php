<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR GENERATOR</title>

    <script src="qrcode.min.js"></script>
</head>

<body>
    <h2>QR Generator with JS</h2>

    <form method="get" action="">
        <input type="text" name="url" placeholder="Escribe aquí..." required
            value="<?php echo isset($_GET['url']) ? htmlspecialchars($_GET['url']) : ''; ?>">
        <button type="submit">Generar QR</button>
    </form>

    <canvas id="qr"></canvas>

    <script>
        const contenido = "<?php echo isset($_GET['url']) ? addslashes(string: $_GET['url']) : 'Esperando datos...'; ?>";
        const canvas = document.getElementById('qr');

        QRCode.toCanvas(canvas, contenido, {
            width: 250,
            color: {
                dark: '#000000',
                light: '#ffffff'
            }
        }, function (error) {
            if (error) console.error(error);
            console.log('QR generado para:', contenido);
        });
    </script>
</body>

</html>