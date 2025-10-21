<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic 09</title>
</head>

<body>
    <?php
    $students = [
        "Juan" => 9,
        "Adrian" => 4,
        "Santiago" => 7,
        "Diana" => 10,
        "Johan" => 3
    ];

    echo "<h3>Sorted by name (A-Z)</h3>";
    ksort($students); // Sort by key (name)
    foreach ($students as $name => $mark) {
        echo "$name: $mark<br>";
    }

    echo "<h3>Sorted by mark (Descending)</h3>";
    arsort($students); // Sort by value descending
    foreach ($students as $name => $mark) {
        echo "$name: $mark<br>";
    }
    ?>
</body>

</html>