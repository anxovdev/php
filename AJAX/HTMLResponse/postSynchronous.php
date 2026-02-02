<html>

<head>
    <script>
        function showUser(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();

                // 1. Configuramos el método POST y el tercer parámetro en 'false' (Síncrono)
                xmlhttp.open("POST", "dataCity.php", false);

                // 2. Encabezado obligatorio para peticiones POST
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                // 3. Enviamos los datos. El script se detiene aquí hasta que el servidor conteste.
                xmlhttp.send("q=" + str);

                // 4. La respuesta se procesa inmediatamente después de send()
                if (xmlhttp.status == 200) {
                    document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                }
            }
        }
    </script>
</head>

<body>
    <form>
        <select name="cities" onchange="showUser(this.value)">
            <option value="">Select a city:</option>
            <option value="1">Ourense</option>
            <option value="2">Coruña</option>
            <option value="3">Lugo</option>
            <option value="4">Pontevedra</option>
        </select>
    </form>
    <br>
    <div id="txtHint"><b>City</b></div>
</body>

</html>