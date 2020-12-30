<!DOCTYPE html>
<html lang="en">
  <head>
    <title>MindTrack - Contact Us</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="loginform.css">
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
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
        <form name="info" formaction="contactform.php" onsubmit="return(validateInfo())" method="post">
            <label>
                <h2>CONTACT US</h2>
                <br>
                <p>Fill out the information below with your concern and we will get back to via email!</p>
            </label>
        <br>
        <label>Name: </label>
        <input type="text" required name="first" placeholder=" ex. Bob">
        <br>
        <br>
        <label>Member login (if applicable): </label>
        <input type="text" name="last" placeholder=" ex. Bob123">
        <br>
        <br>
        <label>Email: </label>
        <input type="text" style="width:300px;" required name="address" placeholder=" ex. Bob@gmail.com">
        <br>
        <br>
        <label>Your concern: </label>
        <input type="text" style="width:300px;" required name="phone" placeholder="Please write your concern here">
        <br>
        <br>
        <br>
        <input class="btn btn-custom" type="submit" name="submit" value="submit">
        <br>
        <br>
        <label>Thank you, we will be in touch!</label>
        <br>
        <br>
        </form>
        </div>
        <script type="text/javascript">
        function validateInfo() {
        	var first = document.info.first;
        	var last = document.info.last;
        	var phone = document.info.phone;
        	var regexName = new RegExp(/^[a-zA-Z]+$/);
        	var regexPhone = new RegExp(/^[0-9]{3}[-]{1}[0-9]{3}[-]{1}[0-9]{4}$/);
        	
        	if (!regexName.test(first.value)) {
        		alert("ERROR: First name must only contain letters!");
        		first.focus();
        		return false;
        	}
        }
        </script>


</body>
</html>