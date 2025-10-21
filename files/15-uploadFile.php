<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename ($_FILES["fileToUpload"]["name"]);
$uploadOK = true;

echo "Destination: " . $target_file . "<br>";

echo "name: ". $_FILES["fileToUpload"]["name"] . "<br>";
echo "type: ". $_FILES["fileToUpload"]["type"] . "<br>";
echo "size: ". $_FILES["fileToUpload"]["size"] . "<br>";
echo "tmp_name: ". $_FILES["fileToUpload"]["tmp_name"] . "<br>";
echo "error: ". $_FILES["fileToUpload"]["error"] . "<br>";

// check if the file already exists
if (file_exists($target_file)){
    echo "I'm sorry, the file already exists";
    $uploadOK = false;
}

// check if $uploadOK is set to 0 by an error
if ($uploadOK) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file)){
        echo "The file ". basename($_FILES["fileToUpload"]["name"]) . " has been uploaded";
    }
    else {
        echo "General error ";
    }
}
