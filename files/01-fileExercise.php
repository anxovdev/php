<!DOCTYPE html>
<html>

<body>

    <?php
    // Open the file teams.txt
    $file = fopen('./data/teams.txt', 'r') or die("unvalid file");

    // Read the file line by line
    while (($line = fgets($file)) !== false) {
        $data = explode("#", trim($line));

        echo "<h1>Team: " . $data[0] . "</h1>";
        echo "<p><strong>Best Player:</strong> " . $data[1] . "</p>";
        echo "<p><strong>City:</strong> " . $data[2] . "</p>";
        echo "<p><strong>Followers:</strong> " . (int) $data[3] . "</p>";
    }


    fclose($file);


    ?>
</body>

</html>