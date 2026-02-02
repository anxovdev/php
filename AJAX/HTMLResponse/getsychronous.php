<html>

<head>
    <script>
        function showUser(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();

                // El tercer parámetro 'false' hace que la petición sea SÍNCRONA
                xmlhttp.open("GET", "dataCity.php?q=" + str, false);

                // En modo síncrono, el script se detiene aquí hasta que llega la respuesta
                xmlhttp.send();

                // No necesitamos onreadystatechange, procesamos la respuesta directamente
                if (xmlhttp.status == 200) {
                    document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                } else {
                    console.error("Error al recuperar los datos");
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