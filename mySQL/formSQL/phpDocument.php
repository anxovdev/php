<?php
// define variables and set to empty values
$cityName = $countryCode = $population = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $cityName = test_input($_POST["name"]);
  $countryCode = test_input($_POST["CCode"]);
  $population = test_input($_POST["population"]);
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

  $sql = "INSERT INTO city (Name, CountryCode, Population) 
  VALUES ('" . $cityName . "','" . $countryCode . "'," . $population . ")";


  echo $sql; 
  $conn->exec($sql);
  echo "<br>Record inserted";

  }
catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
//3.Close
$conn = null;
?>