<?php
$myfile = fopen("localidades.txt", "r") or die("Unable to open file!");
$divisor = fopen("divisor.txt", "r") or die("Unable to open file!");

$cortos = fopen("cortos.txt", "w");
$largos = fopen("largos.txt", "w");

$pueblosCortos = 0;
$pueblosLargos = 0;

while (!feof($myfile)) {
    if (strlen(fgets($myfile)) <= fgets($divisor)) {
        $nombrePuebloCorto = fgets($myfile);
        fwrite($cortos, $nombrePuebloCorto);

        $pueblosCortos++;
    } else {
        $nombrePuebloLargo = fgets($myfile);
        fwrite($largos, $nombrePuebloLargo);

        $pueblosLargos++;
    }
}

$txtDiv = "$pueblosLargos#$pueblosCortos";

fwrite($divisor, $txtDiv);


fclose($myfile);
fclose($divisor);
fclose($cortos);
fclose($largos);

?>