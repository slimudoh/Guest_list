<html>
<head>
	<title>Creating a database</title>
</head>

<body>
	<?php
	$servername = "localhost";
	$username = "slimudoh";
	$password ="3783";


	$conn = new mysqli($servername, $username, $password);
	if ($conn->connect_error) {
		die("Connection Failed: ". $conn->connect_error);		
	}

	$sql = "CREATE DATABASE guesslist";
	if ($conn->query($sql) === TRUE) {
		echo "Database created successfully";
	} else {
		echo "Error creating database: ". $conn->error;
	}

	$conn->close();
	?>
</body>
</html>