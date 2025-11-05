<?php
$servername = "localhost";
$username = "wuser";
$password = "abc123.";
$myDB = "institutos";
try {
  //1 open
  $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully <br>";
  echo "--------------------------- <br>";


  // 2 Process
  $sql = "SELECT * FROM `alumnos`";
  $conn->query($sql);

  $results = $conn->query($sql);
  foreach($results as $row) {
    echo $row['id'] . " - " . 
         $row['nombre'] . " - " . 
         $row['edad'] . " - " . 
         $row['curso'] . " - " . 
         $row['modulo'] . "<br>";
}


} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
  //3 close
  $conn = null;
?>