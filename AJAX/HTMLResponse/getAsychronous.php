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
                xmlhttp.open("GET", "dataCity.php?q=" + str, true);
                xmlhttp.send();
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