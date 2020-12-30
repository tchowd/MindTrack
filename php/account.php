<?php
session_start();

// if not logged in, sends user back to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="dashboard.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato&family=Noto+Sans+JP&family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300&display=swap" rel="stylesheet">
        <!-- <link rel="stylesheet" type="text/css" href="todolist.css"> -->
        <title>Account Info</title> 
        <link rel="icon" 
     type="image/png" 
     href="logo3.png">
    </head>

<!-- This page was inspired by the video: Responsive Admin Dashboard Layout With Html Css Grid by the YouTube channel CodersBite -->
    <body>
        <div class="container">
            <!-- Navigation bar that holds links to the site's contact and about us pages -->
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
                        <div class="main__greeting">
                            <h1>My Account Information</h1>
                        </div>
                    </div>
                    <br><br>
                    <div class="main__panel">
                        <div class="cardPanel">
                            <div class="card__inner">
                                <!-- Displays registeration information about the user -->
                                <table class="format">
                                    <tr>
                                        <td>Name: </td><td>&nbsp; &nbsp; &nbsp;<?php echo htmlspecialchars($_SESSION["name"]); ?></td>  
                                    </tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr>
                                        <td>DOB: </td><td>&nbsp; &nbsp; &nbsp;<?php echo htmlspecialchars($_SESSION["birthdate"]); ?></td>
                                    </tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr>
                                        <td>Email: </td><td>&nbsp; &nbsp; &nbsp;<?php echo htmlspecialchars($_SESSION["email"]); ?></td>
                                    </tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr>
                                        <td>Username: </td><td>&nbsp; &nbsp; &nbsp;<?php echo htmlspecialchars($_SESSION["username"]); ?></td> 
                                    </tr>
                                </table>
                            </div>
                        </div>
                        </a>
                    </div>
                    <br>
                    <!-- Deletes account if pressed -->
                    <button class="btn-delete" href="#">
                        <i class="fa fa-trash"></i>
                        <a href="deleteacc.php" style="color: white;">Delete Account</a>
                    </button>
                    <br>
                    <br>
                    <br>  
                </div>
            </main>

           <!-- Same menu bar as seen on the dashboard, stats, and resources pages -->
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

                <div class="sidebar__link">
                    <i class="fa fa-files-o"></i>
                    <a href="resource.php">Resources</a>
                </div>

                <div class="sidebar__link">
                    <i class="fa fa-question"></i>
                    <a href="map.php">Find a Clinic</a>
                </div>

                <br>

                <div class="sidebar__link active_menu_link">
                    <i class="fa fa-user" style="color: var(--heading-color);"></i>
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