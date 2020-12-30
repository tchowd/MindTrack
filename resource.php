<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$username = $_SESSION["username"];

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

// gets the current day's score
$today_date = date('Y-m-d');
$sql_query = "SELECT score FROM $username WHERE score_date='$today_date'";
$today_score = mysqli_query($link, $sql_query) or die('Error');

// prepares appropriate output depending on if score exists
if (mysqli_num_rows($today_score) > 0) {
    $fetch_data = mysqli_fetch_assoc($today_score);
    $scoring = "You scored a ".$fetch_data['score']." on today's quiz.";
} else {
    $scoring = "You did not take the quiz today.";
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="dashboard.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato&family=Noto+Sans+JP&family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300&display=swap" rel="stylesheet">
        <!-- <link rel="stylesheet" type="text/css" href="todolist.css"> -->
        <title>Resources</title>
        <link rel="icon" 
     type="image/png" 
     href="logo3.png">
    </head>

    <body>
        <div class="container">
            <!-- Navbar at the top of the page -->
            <nav class="navbar">
                <div class="nav_icon" onclick="toggleSidebar()">
                    <i class="fa fa-bars"></i>
                </div>
                <div class="navbar__left">
                    <a href="contact.html">Contact Us</a>
                    <a href="aboutus.html">About Us</a>
                </div>
                <div class="navbar__right">
                    
                </div>
            </nav>

            <main>
                <div class="main__container">
                    <div class="main__title">
                        <!-- Main greeting & Score Display -->
                        <div class="main__greeting">
                            <h1>Resources</h1>
                            <p>Hi <?php echo htmlspecialchars($_SESSION["username"]); echo "! ".$scoring; ?></p>
                            <p>Here are some resources you might find helpful.</p><br>
                        </div>
                    </div>

                    <!-- List of Uni Resources -->
                    <div class="recipe">
                        <div class="recipe-content">
                            
                            <div class="pizza-box" id="remove__space">
                                <i class="fa fa-university fa-2x text-white" ></i>
                                <h1> <span class='todostyling'>Ryerson University</span></h1>
                            </div>
                            <div style="margin-bottom: -20px; padding: 30px;"></div>
                            <div >
                                <ul id="list" style="color: #fff;">
                                    <li> Academic Accommodation Support (AAS)</li>
                                    <li> Centre for Student Development and Counselling</li>
                                    <li> Health Promotion Programs</li>
                                    <li> Ryerson Medical Centre</li>
                                    <li> Test Centre</li>
                                    <li> ThriveRU</li>
                                  </ul>
                            </div>
                            
                        </div>
                    </div>
                    <br>
                    <!-- City of Toronto Resources -->
                    
                        <!--<div class="col-xs-1 col-md-4">-->
                            <!-- <i class="fa fa-building fa-2x text-lightblue" ></i> -->
                        <!--    <div class="card__inner">-->
                        <!--        <i class="fa fa-building fa-2x text-lightblue" ></i>-->
                        <!--        <h1> <span class='todostyling'>City Of Toronto</span></h1>-->
                        <!--    </div>-->
                        <!--    <div>-->
                        <!--        <ul id="list">-->
                                    
                        <!--            <li> Strides Toronto</li>-->
                        <!--            <li> Family Services Toronto</li>-->
                        <!--            <li> Across Boundaries</li>-->
                        <!--            <li> Ontario Psychological Association</li>-->
                        <!--          </ul>-->
                        <!--    </div>-->
                            
                        <!--</div>-->
                        
                        <!-- Resources for Young Adults -->  
                        <div class="recipe">
                        <div class="recipe-content">
                            <div class="pizza-box">
                                <i class="fa fa-users fa-2x text-white" > </i>
                                <h1> <span class='todostyling'>Young Adults</span></h1>
                            </div>
                                <div style="margin-bottom: -70px; padding: 70px;"></div>
                                <div>
                                  <ul id="list"  style="color: #fff;">
                                    
                                    <li> Kelty Mental Health Resource Centre</li>
                                    <li> Jack.org</li>
                                    <li> Canadian Mental Halth Assoication</li>
                                    <li> Mental Health Commision of Canada</li>
                                    <li> Healthy Minds Canada</li>
                                    <li> Centre for Suicide Prevention</li>
                                  </ul>
                            </div>
                        </div>
                       
                    
                    <br>
                    <br>
                    
                    <!-- Emergency Resources -->
                    <!--<div class="recipe" style="padding: 60px;">-->
                    <!--    <div class="recipe-content">-->
                    <!--        <div class="pizza-box">-->
                    <!--            <i class="fa fa-exclamation-triangle fa-2x text-white" ></i>-->

                    <!--            <h1 style="padding-bottom: 10px;"> <span class='todostyling'>Emergency Resources</span></h1>-->
                    <!--        </div>-->
                    <!--        <div style="margin-bottom: -70px; padding: 70px;"></div>-->
                    <!--        <div>-->
                    <!--            <ul id="list" style="color: #fff;">-->
                                    
                    <!--                <li> Kids Help Phone</li>-->
                    <!--                <li> Crisis Text  Line</li>-->
                    <!--                <li> 211 Central</li>-->
                    <!--                <li> Gerstein Crisis Centre</li>-->
                    <!--              </ul>-->
                    <!--        </div>-->
                            
                    <!--    </div>-->
                    <!--</div>-->
                    
                    

                </div>
            </main>

            <!-- Sidebar -->
            <div id="sidebar">
                <div class="sidebar__title">
                    <h1>Menu Bar</h1>
                    <i class="fa fa-times" id="sidebarIcon" onclick=closeSidebar()></i>
                </div>

            <div class="sidebar__menu">
                <div class="sidebar__link">
                    <i class="fa fa-home"></i>
                    <a href="dashboard.php">Dashboard</a>
                </div>

                <div class="sidebar__link">
                    <i class="fa fa-bar-chart"></i>
                    <a href="stats.php">Personal Stats</a>
                </div>

                <div class="sidebar__link active_menu_link">
                    <i class="fa fa-files-o" style="color: var(--heading-color);"></i>
                    <a href="resource.php">Resources</a>
                </div>

                <div class="sidebar__link">
                    <i class="fa fa-question"></i>
                    <a href="map.php">Find a Clinic</a>
                </div>

                <br>

                <div class="sidebar__link">
                    <i class="fa fa-user"></i>
                    <a href="account.php">Account</a>
                </div>

                <div class="sidebar__logout">
                    <i class="fa fa-power-off"></i>
                    <a href="logout.php">Log out</a>
                </div>
            </div>
        </div>
    </div>
        <script src="dashboard.js"></script>
    </body>
</html>