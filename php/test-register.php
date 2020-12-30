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
    <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan+2&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="registerform.css">
</head>
<body>
    <div class="container-flex">
    <nav class="navbar navbar-expand-sm navbar-dark" style="height:80px; background-color:rgba(14,42,71,0.8);">
        <div class="navbar-header">
        <a class="navbar-brand" href="index.html" style="color:rgb(72,255,213,0.8)">MINDTRACK</a>
        </div>
        <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" style="color:rgb(72,255,213,0.8)" href="contactus.html">
                        <b>CONTACT</b>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" style="color:rgb(72,255,213,0.8)" href="faq.html">
                        <b>FAQ</b>
                    </a>
                </li>
                                <li class="nav-item active">
                    <a class="nav-link" style="color:rgb(72,255,213,0.8)" href="pricing.html">
                        <b>PRICING</b>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" style="color:rgb(72,255,213,0.8)" href="login.php">
                        <b>LOGIN</b>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" style="color:rgb(72,255,213,0.8)" href="register.php">
                        <b>REGISTER</b>
                    </a>
                </li>
            </ul>
    </nav>
    <div class="row">
        <div class="col-md-8">
        </div>
        <div class="col-md-4">
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
                <button type="submit" class="btn btn-custom">Register</button>
                <button type="reset" class="btn btn-custom">Reset</button>
            </div>
            <div style="margin-top:30px;">
                <label>Already a User?
                <a href="login.php">Login here!</a>
                </label>
            </div>
        </form>
    </div>    
</body>
</html>