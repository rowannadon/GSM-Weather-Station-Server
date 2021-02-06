<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/css/style.css">
		<?php
			session_start();
			$server = "localhost"; // MySQL server name
			$username = "rowan";
			$password = "rowan123";
			$dbname = "data";

			date_default_timezone_set("America/Denver");
			$curtime = new DateTime();

			// Start connection
			$conn = new mysqli($server, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Unable to connect to the database" . $conn->connect_error);
			}
			
			if(isset($_POST['delete'])) {
			header("Location:delete.php");
			}
			
			$sql = "SELECT * FROM log ORDER BY time DESC LIMIT 1";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				$lasttime = new DateTime($row["time"]);
				$interval = date_diff($curtime, $lasttime);
			}
		?>
	</head>
	
	<body>
		
		<div class="flex-container">
			<div class="center">
				<h1>Data Collection</h1>
				<div class="buttons">
					<button value="Refresh Page" onClick="window.location.reload()"><b>Refresh</b></button>
					<form action="index.php" method="post">
						<button type='submit' name='delete' value='true'><b>Delete all data records</b></button>
					</form>
					<button onClick="window.location.href='https://google.com';"><b>More information</b></button>
				</div>
				
				<div class="data">
					<div class="desc">
						<b>Information:</b>
					</div>
					<table>
						<tr><th>Current time:</th><th>Time since last update</th></tr>
						<tr><td><?php echo $curtime->format('Y-m-d H:i:s');?></td><td><?php echo $interval->format('%D:%H:%I:%S');?></td></tr>
					</table>
				</div>
				
				<div class="data">
					<div class="desc">
						<b>Most Recent Data Point:</b>
					</div>
					<table>
						<tr><th>Time</th><th>Temperature (°C)</th><th>Humidity (%)</th><th>Pressure</th></tr>
						<tr><td><?php echo $row['time']?></td><td><?php echo $row['temperature']?></td><td><?php echo $row['humidity']?></td><td><?php echo $row['pressure']?></td></tr>
					</table>
				</div>

				<div class="data">
					<div class="desc">
					<b>All data:</b>
					</div>
					<table>
						<tr><th>Time</th><th>Temperature (°C)</th><th>Humidity (%)</th><th>Pressure</th></tr>
						<?php
						$sql = "SELECT time, temperature, humidity, pressure FROM log ORDER BY time DESC";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							// output data of each row
							while($row = $result->fetch_assoc()) {
								echo "<tr><td>" .$row["time"]. "</td><td>" .$row["temperature"]. "</td><td>" .$row["humidity"]. "</td><td>" .$row["pressure"]. "</td></tr>";
							}
						}
						//close the connection
						$conn->close();
						?>
					</table>
				</div>

				<div class="data">
					<p>The purpose of this webpage is to select data from a mySQL database and display it in table form along with the time since the last update of the database. Get requests can be sent to 157.230.183.44/data.php in order to insert data into the mySQL database. <ul><li>The refresh button updates the page.</li> <li>The delete button drops all of the data currently stored in the table.</ul></p>
				</div>

				<div class="data">
					<div class="images">
						<img src="https://www.makerfabs.com/image/cache/makerfabs/SIM800L%20Minimum%20System%20GPRS%20GSM/SIM800L%20Minimum%20System%20GPRS%20GSM-1000x750.JPG" alt="image1">
						<img src="https://images-na.ssl-images-amazon.com/images/I/51I6xd7H6hL._SX425_.jpg" alt="image1">
						<img src="https://img.staticbg.com/thumb/large/oaupload/banggood/images/28/6B/99f1bbb5-ece2-4d6c-b3d3-36903cc2ba44.jpg" alt="image1">
					</div>
				</div>
			</div>
		</div>
	</body>

</html>
