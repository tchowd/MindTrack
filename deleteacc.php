<?php
// Initialize the session
session_start();

// Get the username
$username = $_SESSION["username"];
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();

// Database details
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id15518894_aamt');
define('DB_PASSWORD', 'Cps530-project');
define('DB_NAME', 'id15518894_ourwebsite');
 

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// deletes user from the table holding all users
$dacc = "DELETE FROM userinfo WHERE username='$username'";

mysqli_query($link, $dacc);

// also deletes the user's table holding their test scores
$dinfo = "DROP TABLE '$username'";

mysqli_query($link, $dinfo);

// Redirect to login page after done
header("location: index.html");
exit;
?>