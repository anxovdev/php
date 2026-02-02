<html>

<head>
  <script>
    function showUser(str) {
      if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
          }
        };

        // 1. Cambiamos a POST y eliminamos los parámetros de la URL
        xmlhttp.open("POST", "dataCity.php", true);

        // 2. IMPORTANTE: Definimos el tipo de contenido para el envío de datos
        xmlhttp.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded",
        );

        // 3. Enviamos los datos en el cuerpo de la petición
        xmlhttp.send("q=" + str);
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
  <br />
  <div id="txtHint"><b>City</b></div>
</body>

</html>