<?php
    $servername = "localhost";
$username = "wuser";
$password = "abc123.";
$myDB = "world";

    try {

    $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);

    $conn->exec("set names utf8");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   

    //process

    $conn->beginTransaction();

        $sql = "INSERT INTO city (Name, CountryCode, Population) VALUES ('Parderrubias', 'ESP', 11)";

        $conn->exec($sql);



        $sql = "INSERT INTO city (Name, CountryCode, Population) VALUES ('Baños de Molgas', 'ESP', 2001 )"; //change between ESP and XXX to force the error

        $conn->exec($sql);

        //$conn->rollBack();

    $conn->commit();



    

    echo "<br>Records inserted";    

    }

catch(PDOException $e)

    {

    echo $sql . "<br>" . $e->getMessage();

    }



$conn = null;

/*
1. If both cities insert: Both records are saved.
2. If only the first inserts: None are saved (transaction rolls back).
3. If second fails and no transaction: Only the first record is saved.
4. BEGIN, COMMIT, ROLLBACK: Start, save, and undo a transaction.
5. Automatic vs manual rollback: Automatic happens on error; manual is triggered by the programmer.
6. Engines: InnoDB supports transactions; MyISAM and others do not.
*/

?>