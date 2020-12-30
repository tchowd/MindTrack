<?php
session_start();

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
                    <br><br>
                    <div class="main__panel">
                        <!-- Displays the user's scores over the past week from the database -->
                        <div class="cardPanel">
                                <h3 style="color: white; text-align: left; font-size: 25px;">Weekly Summary</h3>

                                <?php
                                    $conn = new mysqli("localhost", "id15518894_aamt", "Cps530-project", "id15518894_ourwebsite");

                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }
                                    
                                    $name = htmlspecialchars($_SESSION["username"]);

                                    $sql1 = "SELECT score_date, score FROM $name WHERE score_date >= DATE_SUB(CURDATE(), INTERVAL 6 DAY) ORDER BY score_date";
                                        $result1 = $conn->query($sql1);

                                        if ($result1->num_rows > 0) {

                                            echo "<table>";
                                            echo "<tr>
                                                <td>Date: </td>
                                                <td>Score: </td>
                                                
                                            </tr>";
                                    
                                            while($rowOne = $result1->fetch_assoc()) {
                                                echo "<br><tr><td> " . $rowOne["score_date"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td> " . $rowOne["score"] . "</td><br><br></tr>";
                                            }
                                    
                                            echo "</table><br><br>";
                                    
                                        } else {
                                            echo "Nothing to show. Use the chatbot to track your daily scores here.";
                                        }

                                    $conn->close(); 
                                ?>
                        </div>
                    </div>

                    <br>
                    <br>
                    
                    <div class="main__panel">
                        <!-- Displays the user's scores over the past month from the database -->
                        <div class="cardPanel2">
                                <h3 style="color: white; text-align: left; font-size: 25px;">Monthly Summary</h3>

                                <?php
                                    $conn = new mysqli("localhost", "id15518894_aamt", "Cps530-project", "id15518894_ourwebsite");

                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }
                                    
                                    $name2 = htmlspecialchars($_SESSION["username"]);

                                    $sql1 = "SELECT score_date, score FROM $name2 WHERE score_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY score_date";
                                        $result1 = $conn->query($sql1);

                                        if ($result1->num_rows > 0) {

                                            echo "<table>";
                                            echo "<tr>
                                                <td><br>Date: </td>
                                                <td><br>Score: </td>
                                            </tr>";
                                    
                                            while($rowOne = $result1->fetch_assoc()) {
                                                echo "<br><tr><td> " . $rowOne["score_date"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td> " . $rowOne["score"] . "</td><br><br></tr>";
                                            }
                                    
                                            echo "</table><br><br>";
                                    
                                        } else {
                                            echo "Nothing to show. Use the chatbot to track your daily scores here.";
                                        }

                                    $conn->close(); 
                                ?>
                        </div>
                    </div>
                    
                    
                    <br> 
                    <br>
                    
                    <div class="main__panel">
                        <!-- Information to help the user interpret what their scores mean -->
                        <div class="cardPanel2">
                            <div>
                                <h3 style="color: white; text-align: left; font-size: 25px;">What does my score mean?</h3>
                                <br>
                                <h3 style="color: white; text-align: left; font-size: 16px;">
                                    1-4: Having a score between 1-4 means that you are suffering from poor mental health. Your ability to enjoy life and its experiences is diminished which is often as a result of either internal or external factors, or both. In order to improve your score, please take a look at our resources page. If you need help, please reach out to one of the listed emergency resources.
                                </h3>
                                <br>
                                <h3 style="color: white; text-align: left; font-size: 16px;">
                                    5-7: Having a score between 5-7 means that you're doing okay on the mental health front. You're able to enjoy life albeit a little moderately, which isn't a bad place to be in at all. Some of the your days are good, maybe even great, but there's definitely some that are bad. However, if you're looking to improve your score, you can take a look at our resources page to reach out for any help you feel like you might need.
                                </h3>
                                <br>
                                <h3 style="color: white; text-align: left; font-size: 16px;">
                                    8-10: Having a score between 8-10 means that mentally, you're doing great! You're in a great place in life, and can enjoy all that it has to offer. Howeve, don't feel pressured to always have good days. A little bit of variation in your daily score and the occasional bad day are to be expected. You might already have a list of supportive resources to turn to during those days, but if you don't, feel free to check out the resources page. 
                                </h3>
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
                    <a href="resource.html">Resources</a>
                </div>

                <div class="sidebar__link">
                    <i class="fa fa-question"></i>
                    <a href="map.html">Find a Clinic</a>
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