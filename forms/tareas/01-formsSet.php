<?php
    $acum=0;
    for ($x = 1; $x <= 100; $x++) {
        if ($x<10)
        $acum *= $x;
        else if ($x % 3==0)
        $acum -= 25;
        else
        $acum = $acum + ($x++);
    }
?>