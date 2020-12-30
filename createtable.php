<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id15518894_aamt');
define('DB_PASSWORD', 'Cps530-project');
define('DB_NAME', 'id15518894_ourwebsite');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "INSERT INTO testing VALUES('2020-11-29', 7)";

if (mysqli_query($link, $sql)) {
	echo "Record inserted successfully.";
} else {
	echo "Error: Could not execute " . $sql . mysqli_error($link);
}

?>