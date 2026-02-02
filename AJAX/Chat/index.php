<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <style type="text/css">
        textarea {
            width: 60%;
            height: 300px;
            margin-top: 30px;
            margin-left: 10px;
        }

        input,
        button {
            margin: 10px;
        }
    </style>
</head>

<body>
    <input type="text" id="usuario" placeholder="Tu nombre" value="Usuario1"><br>
    <input type="text" id="mensaje" placeholder="Escribe aquí..."><br>
    <button onclick="sendMessage()">Enviar</button><br>

    <textarea id="chatArea" readonly></textarea>
    <script>
        function updateChat() {
            fetch('mensajes.txt')
                .then(response => response.text())
                .then(data => {
                    const area = document.getElementById('chatArea');
                    if (area.value !== data) {
                        area.value = data;
                        area.scrollTop = area.scrollHeight;
                    }
                })
                .catch(error => console.error('Error al cargar mensajes:', error))
        }
        function sendMessage() {
            const msg = document.getElementById('mensaje').value;
            const user = document.getElementById('usuario').value;

            const url = `enviar.php?usuario=${user}&mensaje=${msg}`;

            fetch(url)
                .then(() => {
                    document.getElementById('mensaje').value = ""; // Limpiar
                    updateChat(); // Refrescar
                });
        }

        setInterval(updateChat, 3000);
        updateChat();
    </script>
</body>

</html>