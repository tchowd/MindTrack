<?php
session_start();

// if user isn't logged in, redirects them over to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Database details
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id15518894_aamt');
define('DB_PASSWORD', 'Cps530-project');
define('DB_NAME', 'id15518894_ourwebsite');
 

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// current user's username
$username = $_SESSION["username"];

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
        <title>Personal Stats</title>
    </head>

<!-- The basic layout of this page (navbar, sidebar, etc.) was also inspired by the video: Responsive Admin Dashboard Layout With Html Css Grid by YouTube channel CodersBite-->
    <body>
        <div class="container">
            <!-- Navigation bar that holds links to the contact and about us page -->
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
                            <h1>Personal Statistics & Summary</h1>
                        </div>
                    </div>
                    <br>
                    <div class="main__panel">
                        <!-- Displays the user's scores over the past week from the database -->
                        <div class="cardPanel">
                                <h3 style="color: white; text-align: left; font-size: 25px;">Weekly Summary</h3>
                                <br>
                                <?php
                                    $currDate = date('Y-m-d');
                                    $day = date('w', strtotime($currDate));

                                    if ($day == 2) {
                                        $s = 0;
                                        $e = 6;
                                    } elseif ($day == 3) {
                                        $s = -6;
                                        $e = 0;
                                    } elseif ($day == 4) {
                                        $s = -5;
                                        $e = 1;
                                    } elseif ($day == 5) {
                                        $s = -4;
                                        $e = 2;
                                    } elseif ($day == 6) {
                                        $s = -3;
                                        $e = 3;
                                    } elseif ($day == 7) {
                                        $s = -2;
                                        $e = 4;
                                    } elseif ($day == 1) {
                                        $s = -1;
                                        $e = 5;
                                    }
                                    
                                    echo "<table>";
                                    echo "<tr>";
                                        echo "<td style=\"text-align:center; border: 2px solid white;\">Sunday</t>";
                                        echo "<td style=\"text-align:center; border: 2px solid white;\">Monday</t>";
                                        echo "<td style=\"text-align:center; border: 2px solid white;\">Tuesday</t>";
                                        echo "<td style=\"text-align:center; border: 2px solid white;\">Wednesday</t>";
                                        echo "<td style=\"text-align:center; border: 2px solid white;\">Thursday</t>";
                                        echo "<td style=\"text-align:center; border: 2px solid white;\">Friday</t>";
                                        echo "<td style=\"text-align:center; border: 2px solid white;\">Saturday</t>";
                                    echo "</tr>";
                                    
                                    echo "<tr>";
                                    for($i=$s; $i<=$e; $i=$i+1) {
                                        $the_date = date('Y-m-d', strtotime("$i day"));
                                        echo "<td style=\"text-align:center;\">$the_date</td>";
                                    }
                                    echo "</tr>";
                                    
                                    $total = 0;
                                    $score_amnt = 0;
                                    
                                    echo "<tr>";
                                    for($i=$s; $i<=$e; $i=$i+1) {
                                        $the_date = date('Y-m-d', strtotime("$i day"));
                                        $weekScores = "SELECT score FROM $username WHERE score_date='$the_date'";
                                        $weekly = mysqli_query($conn, $weekScores) or die('Error');
                                        
                                        if (mysqli_num_rows($weekly) > 0) {
                                            $fetch_data = mysqli_fetch_assoc($weekly);
                                            $day_score = $fetch_data['score'];
                                            $total = $total + $day_score;
                                            $score_amnt = $score_amnt + 1;
                                            echo "<td><p style=\"text-align:center;\">$day_score</p></td>";
                                        } else {
                                            echo "<td><p style=\"text-align:center;\">N/A</p></td>";
                                        }
                                    }
                                    
                                    echo "</tr></table><br>";
                                    if ($score_amnt > 0) {
                                        $ave = round($total/$score_amnt, 1);
                                        echo "<h3>Your average weekly score is $ave.</h3>";
                                    } else {
                                        echo "<h3>You don't have any weekly score data.</h3>";
                                    }

                                ?>
                        </div>
                    </div>
                    
                    <br>
                    
                    <div class="main__panel">
                        <!-- Displays the user's scores over the past month from the database -->
                        <div class="cardPanel2">
                            <br>
                                <h3 style="color: white; text-align: left; font-size: 25px;">Monthly Summary</h3>
                                <br>
                                <?php

                                    $currDate = date('Y-m-d');
                                    $day = date('w', strtotime($currDate));

                                    if ($day == 2) {
                                        $s = 0;
                                        $e = 6;
                                    } elseif ($day == 3) {
                                        $s = -6;
                                        $e = 0;
                                    } elseif ($day == 4) {
                                        $s = -5;
                                        $e = 1;
                                    } elseif ($day == 5) {
                                        $s = -4;
                                        $e = 2;
                                    } elseif ($day == 6) {
                                        $s = -3;
                                        $e = 3;
                                    } elseif ($day == 7) {
                                        $s = -2;
                                        $e = 4;
                                    } elseif ($day == 1) {
                                        $s = -1;
                                        $e = 5;
                                    }
                                    
                                    $s1 = $s - (7*3);
                                    $e1 = $e - (7*3);
                                    
                                    // Week 1 of Month
                                    echo "<table>";
                                    
                                    echo "<tr>";
                                        echo "<td style=\"text-align:center; border: 2px solid white;\">Sunday</t>";
                                        echo "<td style=\"text-align:center; border: 2px solid white;\">Monday</t>";
                                        echo "<td style=\"text-align:center; border: 2px solid white;\">Tuesday</t>";
                                        echo "<td style=\"text-align:center; border: 2px solid white;\">Wednesday</t>";
                                        echo "<td style=\"text-align:center; border: 2px solid white;\">Thursday</t>";
                                        echo "<td style=\"text-align:center; border: 2px solid white;\">Friday</t>";
                                        echo "<td style=\"text-align:center; border: 2px solid white;\">Saturday</t>";
                                    echo "</tr>";
                                
                                    echo "<tr>";
                                    for($i=$s1; $i<=$e1; $i=$i+1) {
                                        $the_date = date('Y-m-d', strtotime("$i day"));
                                        echo "<td style=\"text-align:center\">$the_date</td>";
                                    }
                                    echo "</tr>";
                                    
                                    $total = 0;
                                    $score_amnt = 0;
                                    
                                    echo "<tr>";
                                    
                                    for($i=$s1; $i<=$e1; $i=$i+1) {
                                        $the_date = date('Y-m-d', strtotime("$i day"));
                                        $monthScores = "SELECT score FROM $username WHERE score_date='$the_date'";
                                        $monthly = mysqli_query($conn, $monthScores) or die('Error');
                                        
                                        if (mysqli_num_rows($monthly) > 0) {
                                            $fetch_data = mysqli_fetch_assoc($monthly);
                                            $day_score = $fetch_data['score'];
                                            $total = $total + $day_score;
                                            $score_amnt = $score_amnt + 1;
                                            echo "<td><p style=\"text-align:center\">$day_score</p></td>";
                                        } else {
                                            echo "<td><p style=\"text-align:center\">N/A</p></td>";
                                        }
                                    }
                                    
                                    echo "</tr></table><br>";

                                    $s2 = $s - (7*2);
                                    $e2 = $e - (7*2);

                                    echo "<table>";
                                    // Week 2 of Month
                                    echo "<tr>";
                                    for($i=$s2; $i<=$e2; $i=$i+1) {
                                        $the_date = date('Y-m-d', strtotime("$i day"));
                                        echo "<td style=\"text-align:center\">$the_date</td>";
                                    }
                                    echo "</tr>";
                                    
                                    echo "<tr>";    
                                    for($i=$s2; $i<=$e2; $i=$i+1) {
                                        $the_date = date('Y-m-d', strtotime("$i day"));
                                        $monthScores = "SELECT score FROM $username WHERE score_date='$the_date'";
                                        $monthly = mysqli_query($conn, $monthScores) or die('Error');
                                        
                                        if (mysqli_num_rows($monthly) > 0) {
                                            $fetch_data = mysqli_fetch_assoc($monthly);
                                            $day_score = $fetch_data['score'];
                                            $total = $total + $day_score;
                                            $score_amnt = $score_amnt + 1;
                                            echo "<td><p style=\"text-align:center\">$day_score</p></td>";
                                        } else {
                                            echo "<td><p style=\"text-align:center\">N/A</p></td>";
                                        }
                                    }
                                    
                                    echo "</tr></table><br>";
                                  
                                    echo "<table>";
                                    
                                    $s3 = $s - 7;
                                    $e3 = $e - 7;

                                    // Week 3 of Month
                                    echo "<tr>";
                                    for($i=$s3; $i<=$e3; $i=$i+1) {
                                        $the_date = date('Y-m-d', strtotime("$i day"));
                                        echo "<td style=\"text-align:center\">$the_date</td>";
                                    }
                                    echo "</tr>";
                                    
                                    echo "<tr>";
                                    for($i=$s3; $i<=$e3; $i=$i+1) {
                                        $the_date = date('Y-m-d', strtotime("$i day"));
                                        $monthScores = "SELECT score FROM $username WHERE score_date='$the_date'";
                                        $monthly = mysqli_query($conn, $monthScores) or die('Error');
                                        
                                        if (mysqli_num_rows($monthly) > 0) {
                                            $fetch_data = mysqli_fetch_assoc($monthly);
                                            $day_score = $fetch_data['score'];
                                            $total = $total + $day_score;
                                            $score_amnt = $score_amnt + 1;
                                            echo "<td><p style=\"text-align:center\">$day_score</p></td>";
                                        } else {
                                            echo "<td><p style=\"text-align:center\">N/A</p></td>";
                                        }
                                    }
                                    
                                    echo "</tr></table><br>";
                                    
                                    echo "<table>";
                                    
                                    // Week 4 of Month
                                    echo "<tr>";
                                    for($i=$s; $i<=$e; $i=$i+1) {
                                        $the_date = date('Y-m-d', strtotime("$i day"));
                                        echo "<td style=\"text-align:center\">$the_date</td>";
                                    }
                                    echo "</tr>";
                                    
                                    echo "<tr>";
                                    for($i=$s; $i<=$e; $i=$i+1) {
                                        $the_date = date('Y-m-d', strtotime("$i day"));
                                        $monthScores = "SELECT score FROM $username WHERE score_date='$the_date'";
                                        $monthly = mysqli_query($conn, $monthScores) or die('Error');
                                        
                                        if (mysqli_num_rows($monthly) > 0) {
                                            $fetch_data = mysqli_fetch_assoc($monthly);
                                            $day_score = $fetch_data['score'];
                                            $total = $total + $day_score;
                                            $score_amnt = $score_amnt + 1;
                                            echo "<td><p style=\"text-align:center\">$day_score</p></td>";
                                        } else {
                                            echo "<td><p style=\"text-align:center\">N/A</p></td>";
                                        }
                                    }
                                    
                                    echo "</tr></table><br>";
                                    if ($score_amnt > 0) {
                                        $ave = round($total/$score_amnt, 1);
                                        echo "<h3>Your average monthly score is $ave.</h3>";
                                    } else {
                                        echo "<h3>You don't have any monthly score data.</h3>";
                                    }
                                    echo "<br>";
                                ?>
                        </div>
                    </div>
                    
                    <br>
                    
                    <div class="main__panel">
                        <!-- Information to help the user interpret what their scores mean -->
                        <div class="cardPanel2">
                            <div>
                                <br>
                                <h3 style="color: white; text-align: left; font-size: 25px;">What does my score mean?</h3>
                                <br>
                                <h3 style="color: white; text-align: left; font-size: 16px;">
                                    1-4: Having a score between 1-4 means that you are suffering from poor mental health. Your ability to enjoy life and its experiences is diminished which is often as a result of either internal or external factors, or both. In order to improve your score, please take a look at our resources page. If you need help, please reach out to one of the listed emergency resources.
                                </h3>
                                <br>
                                <h3 style="color: white; text-align: left; font-size: 16px;">
                                    5-7: Having a score between 5-7 means that you're doing okay on the mental health front. You're able to enjoy life albeit a little moderately. Some of the your days are good, maybe even great, but there's definitely some that are bad. However, if you're looking to improve your score, you can take a look at our resources page to reach out for any help you feel like you might need.
                                </h3>
                                <br>
                                <h3 style="color: white; text-align: left; font-size: 16px;">
                                    8-10: Having a score between 8-10 means that mentally, you're doing great! You're in a great place in life, and can enjoy all that it has to offer. Howeve, don't feel pressured to always have good days since the occasional bad day is to be expected. You might already have a list of supportive resources to turn to during those days, but if you don't, feel free to check out the resources page. 
                                </h3>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

<!-- Menu bar to help the user navigate between various pages that are personalized for the most part -->
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

                <div class="sidebar__link active_menu_link">
                    <i class="fa fa-bar-chart" style="color: var(--heading-color);"></i>
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