<?php
echo "<h3>Server and Client Info</h3>";

echo "Remote IP: " . $_SERVER['REMOTE_ADDR'] . "<br>";
echo "Browser (User Agent): " . $_SERVER['HTTP_USER_AGENT'] . "<br>";
echo "Server Name: " . $_SERVER['SERVER_NAME'] . "<br>";
echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
echo "Request Method: " . $_SERVER['REQUEST_METHOD'] . "<br>";
