<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic 08</title>
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

    echo "<h3>Student Marks</h3>";

    $total = $failed = 0;
    foreach ($students as $name => $mark) {
        echo "$name: $mark<br>";
        $total += $mark;
        if ($mark < 5)
            $failed++;
    }

    $average = $total / count($students);
    $maxMark = max($students);

    echo "<br>Average mark: $average<br>";
    echo "Maximum mark: $maxMark<br>";
    echo "Number of students who failed: $failed<br>";
    ?>
</body>

</html>