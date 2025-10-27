<?php
$servername = "localhost";
$username = "wuser";
$password = "abc123.";
$myDB = "world";

//REMEMBER: keywords in SQL ar not CASESENSITIVE. OBJECT NAMES (tables, rows...) ARE

try {
  //1.Open
  $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";

  //2.Process
  //1 copy the template from phpMyAdmin
  //$sql = "INSERT INTO `city` (`ID`, `Name`, `CountryCode`, `District`, `Population`) VALUES (NULL, \'CabezaDeVaca\', \'ESP\', \'\', \'201\');";
  //$sql = "INSERT INTO city (Name, CountryCode, Population) VALUES ('Moreiras','ESP',601)";

  //2 set a sentence with previous variables
  $nameCity = "Vila de Cruces";
  $codeCountry = "ESP";
  $popu = 5082;
  $sql = "INSERT INTO city (Name, CountryCode, Population) VALUES ('" . $nameCity . "','" . $codeCountry . "'," . $popu . ")";

  echo $sql; //sometimes it's important to debug
  $conn->exec($sql);
  echo "<br>Record inserted";

  }
catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
//3.Close
$conn = null;
?>