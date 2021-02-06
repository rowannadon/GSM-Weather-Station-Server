<?php
//This PHP script is designed to take GET requests from the GPRS module and pass the data into a MySQL database

$server = "localhost"; // MySQL server name
$username = "rowan";
$password = "rowan123";
$dbname = "data";

// Get the current date and time
date_default_timezone_set("America/Denver");
$curtime = new DateTime();

// Start connection
$conn = new mysqli($server, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Unable to connect to the database" . $conn->connect_error);
} 

if (empty($_GET)) { // The get request is empty
    echo "No data...";
} else {
	//Insert the get request data into the mysql database
	$sql = "INSERT INTO log (time, temperature, humidity, pressure)
	VALUES ('" .$curtime->format('Y-m-d H:i:s'). "', '" .$_GET['temp']. "', '" .$_GET['humidity']. "', '" .$_GET['pressure']. "')";

	// If the query is successful display success message
	if ($conn->query($sql) === TRUE) {
		echo "Successfully updated database at " .$curtime->format('Y-m-d H:i:s'). " ";
	} else {
		echo "error: " .$sql. "<br>" . $conn->error;
	}
}

//close the connection
$conn->close();
?>
