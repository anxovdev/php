<?php
$myfile = fopen("./Data/webdictionary.txt", "r") or die("Unable to open file!");
echo fread($myfile, filesize("./Data/webdictionary.txt"));
fclose($myfile);