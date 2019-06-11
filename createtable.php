<html>
<head>
	<title>Creating a database</title>
</head>

<body>
	<?php

	$servername = "localhost";
	$username = "slimudoh";
	$password ="3783";
	$dbname = "guesslist";

	$conn = new mysqli ($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("connection failed: " . $connect_error);

	}

	$sql = "CREATE TABLE guess (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		fname VARCHAR(50) NOT NULL,
		lname VARCHAR(50) NOT NULL,
		tnumber VARCHAR(20) NOT NULL,
		invited VARCHAR(50) NOT NULL,
		status INT(5) NOT NULL)";
	
	if ($conn->query($sql) === TRUE) {
		echo "Table guess created successfully";
	} else {
		echo "Error creating table: ". $conn->error;

		$conn->close();
	}


	?>
</body>
</html>