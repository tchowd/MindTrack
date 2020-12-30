<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $email = $birthdate = "";
$name_err = $email_err = $birthdate_err = "";
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your name.";     
    } else{
        $name = trim($_POST["name"]);
    }
    
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";     
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Validate date of birth
    if(empty(trim($_POST["birthdate"]))){
        $birthdate_err = "Please enter your birthdate.";     
    } else{
        $birthdate = trim($_POST["birthdate"]);
    }
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM userinfo WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($birthdate_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO userinfo (name, email, birthdate, username, password) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_email, $param_birthdate, $param_username, $param_password);
            
            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_birthdate = $birthdate;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $sql2 = "CREATE TABLE $username(
                        score_date DATE NOT NULL,
                        score INT(10) NOT NULL
                )";
                
                mysqli_query($link, $sql2);
                
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
    <title>MindTrack - Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
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
            <h1 class="display-4">Register</h1>
            <p class="lead" style="margin-left: 100px; margin-right: 100px; margin-bottom: -100px;">Create an account with us to be able to access all that MindTrack has to offer.</p>
          </div>
          
          <!-- Registration Form -->
    <div class="row justify-content-center" >
        <div class="row text-center align-items-center justify-content-center col-xl-8" style="margin-top: 50px;">          
            <div class="col-xl-12 bg-white p-5 rounded-lg shadow">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter name" value="<?php echo $name; ?>">
                        <span class="help-block" style="color:white;"><?php echo $name_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email" value="<?php echo $email; ?>">
                        <span class="help-block" style="color:white;"><?php echo $email_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($birthdate_err)) ? 'has-error' : ''; ?>">
                        <label>Birthdate</label>
                        <input type="date" name="birthdate" class="form-control" value="<?php echo $birthdate; ?>">
                        <span class="help-block" style="color:white;"><?php echo $birthdate_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter username" value="<?php echo $username; ?>">
                        <span class="help-block" style="color:white;"><?php echo $username_err; ?></span>
                    </div>    
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password" value="<?php echo $password; ?>">
                        <span class="help-block" style="color:white;"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Re-enter password" value="<?php echo $confirm_password; ?>">
                        <span class="help-block" style="color:white;"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div style="margin-top:40px;">
                        <button type="submit" class="btn btn-primary btn-block p-2 shadow rounded-pill">Register</button>
                        <button type="reset" class="btn btn-primary btn-block p-2 shadow rounded-pill">Reset</button>
                    </div>
                    <div style="margin-top:30px;">
                        <label>Already a User?
                        <a href="login.php">Login here!</a>
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