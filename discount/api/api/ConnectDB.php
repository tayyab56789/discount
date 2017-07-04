<?php

/*
* ConnectDB connect to database
*	-> connectionWithDB
*/
class ConnectDB

{
	public

	function connectionWithDB($servername, $username, $password, $dbname)
	{
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		else {
			return $conn;
		}
	}
};

?>