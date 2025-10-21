<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic 07</title>
</head>

<body>
    <?php
    $number = 5;

    // Using for loop
    $factFor = 1;
    for ($i = 1; $i <= $number; $i++) {
        $factFor *= $i;
    }
    echo "Factorial of $number: $factFor<br>";

    // Using while loop
    $i = 1;
    $factWhile = 1;
    while ($i <= $number) {
        $factWhile *= $i;
        $i++;
    }
    echo "Factorial of $number: $factWhile<br>";

    // Using do-while loop
    $i = 1;
    $factDoWhile = 1;
    do {
        $factDoWhile *= $i;
        $i++;
    } while ($i <= $number);
    echo "Factorial of $number: $factDoWhile<br>";
    ?>
</body>

</html>