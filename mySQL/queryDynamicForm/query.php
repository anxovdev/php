<?php 
// define variables and set to empty values
$country = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $country = test_input($_POST["country"]);
}

function test_input($data) {
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

  $cCodQuery = "SELECT Code FROM country WHERE Name = '$country'";
  $cCod = $conn->query($cCodQuery)->fetchColumn();

  if (!$cCod) {
    echo "El país '$country' no existe!";
    exit;
  }

  $sql = "SELECT Name FROM city WHERE CountryCode = '$cCod'";
  $results = $conn->query($sql);

  foreach($results as $row) {
    echo $row['Name'] . "<br>";
  }

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

//3.Close
$conn = null;
?>
