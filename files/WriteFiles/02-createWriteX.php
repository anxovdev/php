<?php
    $myfile = fopen("./data/newfile2.txt", "x") or die("Unable to open file!");
    $txt = "John Doe\n";
    fwrite($myfile, $txt);
    $txt = "Prueba archivos con x mode \n";
    fwrite($myfile, $txt);
    fclose($myfile);
?>