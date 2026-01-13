<?php
// define variables and set to empty values
$option = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $option = test_input($_POST["pais"]);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$servername = "localhost";
$username = "wuser";
$password = "abc123.";
$myDB = "world";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $CCodeQ = "SELECT Code FROM country WHERE Name='$option'";
    $cCod = $conn->query($CCodeQ)->fetchColumn();

    if (!$cCod) {
        echo "El país no existe!";
        exit;
    }

    $sql = "SELECT countrylanguage.Language, countrylanguage.Percentage, countrylanguage.IsOfficial  FROM `countrylanguage` WHERE CountryCode='ESP'";
    $conn->exec($sql);

    foreach ($result as $fila) {
        echo "ID: {$fila['Language']} - Es Oficial: {$fila['IsOfficial']} - Email: {$fila['Percentage']}<br>";
    }

    $stmt = "DELETE FROM countrylanguage WHERE CountryCode = '$CCode' AND IsOfficial='F'";

    $num = $conn->exec($stmt);

    echo "Number of deleted records: " . $num;

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
//3.Close
$conn = null;
?>