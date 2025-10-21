<!DOCTYPE HTML>  
<html>
<head>
  <meta charset="UTF-8">
  <title>PHP Auto Validation - Average</title>
</head>
<body>  

<?php
// define variables and set to empty values
$num1 = $num2 = "";
$average = 0;
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $num1 = test_input($_POST["num1"]);
  $num2 = test_input($_POST["num2"]);

  // check if both inputs are numeric
  if (is_numeric($num1) && is_numeric($num2)) {
    $average = ($num1 + $num2) / 2;
    if ($average > 5) {
      $message = "Congratulations!";
    } else {
      $message = "Try again!";
    }
  } else {
    $message = "Please enter valid numeric values.";
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Average Calculator</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Number 1: <input type="text" name="num1" value="<?php echo $num1; ?>">
  <br><br>
  Number 2: <input type="text" name="num2" value="<?php echo $num2; ?>">
  <br><br>
  <input type="submit" name="submit" value="Calculate">  
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "<h2>Result:</h2>";
  echo "Number 1: " . $num1 . "<br>";
  echo "Number 2: " . $num2 . "<br>";
  if (is_numeric($num1) && is_numeric($num2)) {
    echo "Average: " . $average . "<br>";
  }
  echo "<strong>" . $message . "</strong>";
}
?>

</body>
</html>
