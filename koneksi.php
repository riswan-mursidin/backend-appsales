<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $db = "u1438856_salesapp";

$servername = "localhost";
$username = "u1438856_salesapp";
$password = "riswanboss9999";
$db = "u1438856_salesapp";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>