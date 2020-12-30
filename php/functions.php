<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'id15518894_aamt', 'Cps530-project', 'id15518894_ourwebsite');

// variable declaration
$name     = "";
$username = "";
$email    = "";
$errors   = array(); 

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}

// REGISTER USER
function register() {
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$name        =  e($_POST['name']);
	$email       =  e($_POST['email']);
	$username    =  e($_POST['username']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($name)) { 
	    print("hello");
		array_push($errors, "Name is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}
	if (userExists() == true) {
	    array_push($errors, "Username is taken");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database

		$query = "INSERT INTO users (name, email, username, password) 
		            VALUES('$name', '$email', '$username', '$password')";
			mysqli_query($db, $query);

	}
}

// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}

function userExists() {
    global $db, $username;
    
    $query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
	$results = mysqli_query($db, $query);

	if (mysqli_num_rows($results) == 1) {
	    return true;
	} else {
	    return false;
	}
}

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}


// call the login() function if register_btn is clicked
//if (isset($_POST['login_btn'])) {
//	login();
//}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
		
		    $logged_in_user = mysqli_fetch_assoc($results);
			$_SESSION['user'] = $logged_in_user;
			$_SESSION['success']  = "You are now logged in";
            header('location: index.php');
		} else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}