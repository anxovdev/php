<?php 
    $servername = "localhost";
$username = "wuser";
$password = "abc123.";
$myDB = "world";

    try {

  //Open

  $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);

  // set the PDO error mode to exception

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //echo "Connected successfully";



  //Process

  // 1: $sql = "UPDATE city SET Name = 'Rivendell' where Name= 'Amsterdam'";
  // 2: $sql = "UPDATE city SET CountryCode = 'ESP' where Name= 'Kabul'";
  // 3: $sql = "UPDATE city SET CountryCode = 'ESP' where CountryCode= 'ITA'";
  // 4: $sql = "UPDATE city SET Population = Population*1.1 where CountryCode= 'PRT'";
  // 5: $sql = "UPDATE country SET Code = 'POR' where Code= 'PRT'"; (NO DEJA)


  $num = $conn->exec($sql);

  echo $sql; //sometimes it's important to debug

  $conn->exec($sql);

  echo "<br>Number of updated records: " . $num;

} catch(PDOException $e) {

  echo "Connection failed: " . $e->getMessage();

}

//Close

$conn = null;


?>