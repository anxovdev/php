<?php
$servername = "localhost";
$username = "wuser";
$password = "abc123.";
$myDB = "company";

try {

    //Open

    $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);

    // set the PDO error mode to exception

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Connected successfully";



    //Process

    $sql = "CREATE TABLE employees (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(255) NOT NULL,
    salary INT(10) NOT NULL
);";


    $num = $conn->exec($sql);

    echo $sql; //sometimes it's important to debug

    $conn->exec($sql);

} catch (PDOException $e) {

    echo "Connection failed: " . $e->getMessage();

}

//Close

$conn = null;


?>