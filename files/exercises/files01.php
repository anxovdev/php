<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Files 01</title>
</head>

<body>
    <?php
    include "./menu/menu.php";
    echo "<h1>Hello Welcome my page</h1>";

    $date = date("Y-m-d H:i:s");

    $ip_User = $_SERVER['REMOTE_ADDR'];

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    if(strpos($user_agent, "Chrome") != false){
        $browser = "Chrome";
    }
    else if (strpos($user_agent, "Firefox") != false){
        $browser = "Firefox";
    }
    else if(strpos($user_agent, "Edge") != false){
        $browser = "Microsoft Edge";
    }
    else {
        $browser = "Other";
    }
    

    /*File creation*/
    $file = fopen("./data/files01.log", "a") or die("File is not found");
    fwrite($file, "$date | $ip_User | Browser: $browser \n");
    fclose($file);
    ?>
</body>

</html>