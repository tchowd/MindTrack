<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: dashboard.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$name = $birthdate = $email = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, name, email, birthdate, username, password FROM userinfo WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $name, $email, $birthdate, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["name"] = $name;
                            $_SESSION["birthdate"] = $birthdate;
                            $_SESSION["email"] = $email;
                            
                            // Redirect user to welcome page
                            header("location: dashboard.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>MindTrack - Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <div class="container-flex">
        <!-- Navbar at the top of the page -->
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-blue border-bottom shadow-sm" style="background-color: #0e2a47";>
            <a class="mr-md-auto logo" href="index.html">
            <img src="logo5.png" alt="logo" class="mr-md-auto logo">
            </a>
            <nav class="my-2 my-md-0 mr-md-3" >
              <a class="p-2 text-light" href="index.html">Home</a>
              <a class="p-2 text-light" href="pricing.html">Pricing</a>
              <a class="p-2 text-light" href="contact.html">Contact Us</a>
                <a class=" p-2 text-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">About</a>
                <div class="dropdown-menu p-2 text-dark">
                    <a class="dropdown-item " href="faq.html">FAQ</a>
                    <a class="dropdown-item" href="aboutus.html">Meet Our Team</a>
                </div>
                <a class="p-2 text-light" href="login.php">Login</a>
            </nav>
            <a class="btn btn-primary" href="register.php">Sign up</a>
          </div>

        <!-- Page Title -->
          <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" style="margin-bottom: 60px;">
            <h1 class="display-4">Login</h1>
            <p class="lead" style="margin-left: 100px; margin-right: 100px; margin-bottom: -100px;">Login to access your account and use all of the features that MindTrack has to over.</p>
          </div>
          <!-- Login Form -->
    <div class="row justify-content-center" >
        <div class="row text-center align-items-center justify-content-center col-xl-8" style="margin-top: 50px;">          
            <div class="col-xl-12 bg-white p-5 rounded-lg shadow">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter username" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $username_err; ?></span>
                    </div>    
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div style="margin-top:40px;">
                      <!-- <button type="submit" class="btn btn-custom">Login</button> -->
                      <button type="submit" class="btn btn-primary btn-block p-2 shadow rounded-pill">Login</button>
                      <button type="reset" class="btn btn-primary btn-block p-2 shadow rounded-pill">Reset</button>
                      <!-- <button type="reset" class="btn btn-custom">Reset</button> -->
                    </div>
                    <div style="margin-top:30px;">
                      <label>Not a User?
                        <a href="register.php">Register!</a>
                      </label>
                    </div>
                </form>
                </div>
          </div>
       
    <!-- Footer -->
    <footer class="container py-5 footer" style="margin-top: 100px;" >
        <div class="row">
            <div class="col-6 col-md">
              <h5>Features</h5>
              <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="register.php">Personalized Stats</a></li>
                <li><a class="text-muted" href="register.php">Personalized Calendar</a></li>
                <li><a class="text-muted" href="register.php">Personalized Resources</a></li>
              </ul>
            </div>
            <div class="col-6 col-md">
              <h5>Pricing</h5>
              <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="pricing.html">Basic Option</a></li>
                <li><a class="text-muted" href="pricing.html">Pro Option</a></li>
                <li><a class="text-muted" href="pricing.html">Enterprise Option</a></li>
              </ul>
            </div>
            <div class="col-6 col-md">
              <h5>Resources</h5>
              <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="#">Business</a></li>
                <li><a class="text-muted" href="#">Education</a></li>
                <li><a class="text-muted" href="#">Government</a></li>
                <li><a class="text-muted" href="#">Gaming</a></li>
              </ul>
            </div>
            <div class="col-6 col-md">
              <h5>About</h5>
              <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="team.html">Team</a></li>
                <li><a class="text-muted" href="faq.html">FAQ</a></li>
              </ul>
            </div>
          </div>
        </footer>
</body>
</html>