<?php
$server = "localhost"; // MySQL server name
$username = "rowan";
$password = "rowan123";
$dbname = "data";

echo "Deleting records...";

// Start connection
$conn = new mysqli($server, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Unable to connect to the database" . $conn->connect_error);
}

$sql = "DELETE FROM log";
$result = $conn->query($sql);

header("Location:index.php")
?>
