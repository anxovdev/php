<?php
// --- CONFIGURACIÓN ---
$archivo = "0_palabras_todas_no_conjugaciones.txt";
$max_sugerencias = 10;
mb_internal_encoding("UTF-8");

// Obtener el parámetro q de la URL
$q = isset($_REQUEST["q"]) ? $_REQUEST["q"] : "";

$hint = "";

if ($q !== "") {
    if (file_exists($archivo)) {

        // Convertimos la búsqueda a minúsculas para comparar
        $q = mb_strtolower($q);
        $len = mb_strlen($q);

        // Abrimos el archivo en modo lectura ("r")
        $handle = fopen($archivo, "r");

        $contador = 0;

        if ($handle) {
            // Leemos línea por línea hasta el final del archivo
            while (($linea = fgets($handle)) !== false) {

                // Limpiamos la palabra (quitamos espacios y saltos de línea)
                $name = trim($linea);

                // Si la línea está vacía, pasamos a la siguiente
                if (empty($name))
                    continue;

                // --- LÓGICA DE BÚSQUEDA ---
                // Comprobamos si la palabra ($name) EMPIEZA con lo que escribió el usuario ($q)
                if (mb_stripos($name, $q) === 0) {

                    if ($hint === "") {
                        $hint = $name;
                    } else {
                        $hint .= ", $name";
                    }

                    $contador++;

                    // Si ya tenemos suficientes sugerencias, paramos de leer para ir más rápido
                    if ($contador >= $max_sugerencias)
                        break;
                }
            }
            // Cerramos el archivo
            fclose($handle);
        }
    } else {
        $hint = "Error: No se encuentra el archivo diccionario.txt";
    }
}

// Salida: "sin sugerencias" o la lista de palabras
echo $hint === "" ? "sin sugerencias" : $hint;
?>