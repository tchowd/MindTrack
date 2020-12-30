
<!DOCTYPE html>
<html lang="en">
  <head>
     <!-- This file is the contact PHP  code for the contact us page and uses JS to validate info and PHP to send an email.-->
    <!-- CPS 530 Section 3-4 Group 11 Project-->
    <title>MindTrack - Contact</title>
    <meta charset="utf-8">
    <!-- Declare all stylesheets and fonts and other links-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- <link href="/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="icon" 
     type="image/png" 
     href="logo3.png">
    <link rel="stylesheet" type="text/css" href="main.css">
    <!-- Javascript function to validate if the name only contains letters-->
    <script type="text/javascript">
        function validateInfo() {
        	var first = document.info.first;
        	var last = document.info.last;
        	var phone = document.info.phone;
        	var regexName = new RegExp(/^[a-zA-Z]+$/);
        	var regexPhone = new RegExp(/^[0-9]{3}[-]{1}[0-9]{3}[-]{1}[0-9]{4}$/);
        	// use regex to test if it only contains lettrs
        	if (!regexName.test(first.value)) {
        		alert("ERROR: First name must only contain letters!");
        		first.focus();
        		return false;
        	}
        }
        </script>
  </head>
  <body>
    <div class="container-flex">
<!--All divs for the header footer and layout of website-->
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-blue border-bottom shadow-sm" style="background-color: #0e2a47";>
            <a class="mr-md-auto logo" href="main.html">
            <img src="logo5.png" alt="logo" class="mr-md-auto logo">
            </a>
            <!-- <h5 class="my-0 mr-md-auto font-weight-normal" style="margin-left: -750px; font-size: 1.5em;">MindTrack</h5> -->
            <nav class="my-2 my-md-0 mr-md-3" >
              <a class="p-2 text-light" href="main.html">Home</a>
              <a class="p-2 text-light" href="pricing.html">Pricing</a>
              <a class="p-2 text-light" href="contact.html">Contact Us</a>
                <a class=" p-2 text-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">About</a>
                <div class="dropdown-menu p-2 text-dark">
                    <a class="dropdown-item " href="faq.html">FAQ</a>
                    <a class="dropdown-item" href="aboutus.html">Meet Our Team</a>
                </div>
        
            </nav>
            <a class="btn btn-primary" href="register.php">Sign up</a>
          </div>

          <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Contact Us</h1>
            <p class="lead" style="margin-left: 100px; margin-right: 100px; margin-bottom: -100px;">Have any questions about MindTrack or its features? If you can't find the answers on our FAQ page, contact us below.</p>
          </div>

          <div class="row text-center align-items-center justify-content-center" style="margin-top: 150px;">          
            <div class="col-lg-8 mb-5 mb-lg-0 bg-white p-5 rounded-lg shadow">
                    <!--<form name="info" action="mailto:cps530project@hotmail.com" onsubmit="return(validateInfo())" method="post" >-->
                    <!-- form which includes an action that sends the mail to our project email, after validating info-->
                        <form name="info" action="mailto:cps530project@hotmail.com" method="POST" enctype="multipart/form-data" onsubmit="return(validateInfo())">
                            <label>
                                <h2 class="h2 text-uppercase font-weight-bold mb-4">Complete the following information:</h2>
                                <br>
                                <p>Fill out the information below with your concern and we will get back to via email!</p>
                            </label>
                        <br>
                        <!-- Labels and inputs for the inputs of the contact page-->
                        <label>Name: </label>
                        <br>
                        <input type="text" required name="name" class="form-control" placeholder="Enter name:" >
                        <br>
                        <br>
                        <label>Member login (if applicable): </label>
                        <br>
                        <!-- <input type="text" name="last" placeholder=" ex. Bob123"> -->
                        <input type="text" name="name" class="form-control" placeholder="Enter member code:" >
                        <br>
                        <br>
                        <label>Email: </label>
                        <br>
                        <!-- <input type="text" style="width:300px;" required name="address" placeholder=" ex. Bob@gmail.com"> -->
                        <input type="text" required name="address" class="form-control" placeholder="Enter email address:" >
                        <br>
                        <br>
                        <label>Please briefly explain your concern: </label>
                        <br>
                        <!-- <input type="text" style="width:300px; height:100px" required name="phone" placeholder="Please write your concern here"> -->
                        <input type="text" required name="concern" class="form-control" placeholder="Describe in full detail your concern:" >
                        <br>
                        <br>
                        <br>
                        <input class="btn btn-primary btn-block p-2 shadow rounded-pill" type="submit" value="Submit">

                        <br>
                        <br>
                    </form>
                </div>
          </div>
          </div>
       
       <!-- Div for the footer-->
<footer class="container py-5 footer" style="margin-top: 80px;">
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
            <li><a class="text-muted" href="#">Basic Option</a></li>
            <li><a class="text-muted" href="#">Pro Option</a></li>
            <li><a class="text-muted" href="#">Enterprise Option</a></li>
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