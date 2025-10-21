<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
</head>

<body>

    <!--make a php program with a form to be auto validated.
the form will have two input with numerica value-->
    <h1>Form</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
        <label for="firstMark">
            Nota 1:
        </label>
        <input type="text" name="firstMark" id="firstMark">
        <br><br>
        <label for="secondMark">
            Nota 2:
        </label>
        <input type="text" name="secondMark" id="secondMark">

        <input type="submit" value="Submit">
    </form>


    <?php
    $average = $firstMark = $secondMark = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstMark = testinput($_POST["firstMark"]);
        $secondMark = testinput($_POST["secondMark"]);
    } else {
        return;
    }

    $average = ($firstMark + $secondMark) / 2;
    if ($average < 5) {
        echo "Suspendiste la asignatura :( ";
        echo "Vuelve a intentarlo";
    } else {
        echo "Felicidades :)";
    }

    function testInput($data)
    {
        $data = is_numeric($data);
        return (int) $data;
    }



    ?>
</body>

</html>