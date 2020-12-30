<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
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
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato&family=Noto+Sans+JP&family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <!-- <link rel="stylesheet" type="text/css" href="todolist.css"> -->
        <title>Dashboard</title>
    </head>

    <body>
        <div class="container">
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
                            <h1>Hello <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
                            <p>Welcome to your personal dashboard.</p><br>
                        </div>
                    </div>

                    <div class="main__cards">
                        <a href="https://www.torontocentralhealthline.ca/listservices.aspx?id=10237" target='_blank' style="text-decoration: none;">
                            <div class="card">
                                <i class="fa fa-users fa-2x text-red"></i>
                                <div class="card__inner">
                                    <p>Community Mental Health Programs</p>
                                </div>
                            </div>
                            </a>

                        <a href="https://calendar.google.com/calendar/" target='_blank' style="text-decoration: none;">
                        <div class="cardTwo">
                            <i class="fa fa-calendar fa-2x text-yellow"></i>
                            <div class="card__inner">
                                <p>Schedule Appointment</p>
                            </div>
                        </div>
                        </a>

                        <a href="https://www.mentalhealth.gov/get-help/clinical-trial#:~:text=The%20National%20Institute%20of%20Mental,Learn%20more%20about%20clinical%20trials." target='_blank' style="text-decoration: none;">
                            <div class="cardThree">
                                <i class="fa fa-building fa-2x text-blue"></i>
                                <div class="card__inner">
                                    <p>Participate in a Clincal Trial</p>
                                </div>
                            </div>
                            </a>

                            <a href="https://info.mindbeacon.com/btn542?utm_campaign=Ontario&utm_source=google&utm_medium=sem&utm_content=performance&gclid=CjwKCAiAwrf-BRA9EiwAUWwKXhO683KEid51xw8cOy4fU7j8AREn8SHJLgmHkRjgNtf9N0eQ7LgeDhoCTYwQAvD_BwE" target='_blank' style="text-decoration: none;">
                                <div class="cardFour">
                                    <i class="fa fa-user-o fa-2x text-lightblue"></i>
                                    <div class="card__inner">
                                        <p>Free Therapy</p>
                                    </div>
                                </div>
                                </a>
                    </div>
                    <br>
                    <div class="recipe">

                            <h1> <span class='recipe-content'>Todo List</span></h1>
                            <div class='pizza-box'>
                                <input class='input pizza-box' type='text' placeholder='What do you want to do?'>
                                <button class='addButton'><i class="fa fa-plus"></i></button>
                            </div>
                            <div class='todocontainer'>
                               
                            </div>
                        
                    </div>
                    <br>
                    <br>
                    
                    <div class="flex-container">
                        <div class="flex-item-left">
                            <!-- <i class="fa fa-building fa-2x text-lightblue" ></i> -->
                            <div id="apex1">
                                <h1> <span class='todostyling'>Personal Calendar</span></h1>
                                <br>
                                <br>
                                <div class="panel">
                                    <div class="calendar">
                              
                                      <div class="month">
                                        <i class="fa fa-arrow-left prev"></i>
                                   
                                        <div class="date">
                                          <h1></h1>
                                          <p></p>
                                        </div>
                              
                                        <i class="fa fa-arrow-right next"></i>
                                      </div>
                                      
                                      <div class="weekdays">
                                        <div>Sun</div>
                                        <div>Mon</div>
                                        <div>Tue</div>
                                        <div>Wed</div>
                                        <div>Thu</div>
                                        <div>Fri</div>
                                        <div>Sat</div>
                                      </div>
                                      
                                      <div class="days"></div>
                                    </div>
                                  </div>

                            </div>
                            
                        </div>

    <div class="flex-item-right">
    <div class="wrapper">
        <!-- <div class="title">MindTrack Chatbot</div> -->
        <h1> <span class='todostyling'>MindTrack Chatbot</span></h1>
        
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="msg-header">
                    <p>Hello! Welcome to MindTrack! Would you like to today's mental health quiz? Type y to continue. :)</p>
                </div>
            </div>
        </div>
        <div class="typing-field">
            <div class="input-data">
                <input id="data" type="text" placeholder="Type something here.." required>
                <button id="send-btn">Send</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $name = "<?php echo htmlspecialchars($_SESSION["username"]); ?>";
            $qNum = 0;
            $total = 0;
            $("#send-btn").on("click", function(){
                $qNum = $qNum + 1;
                $value = $("#data").val();
                if (!isNaN($value)) {
                    $total = $total + parseInt($value);
                }
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                
                // start ajax code
                $.ajax({
                    url: 'testmessage.php',
                    type: 'POST',
                    data: {'text':$value,'name':$name, 'qNum':$qNum, 'total':$total},
                    success: function(result){
                        $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                        $(".form").append($replay);
                        // when chat goes down the scroll bar automatically comes to the bottom
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                        if (result == "Invalid response." && $qNum > 0) {
                            $qNum = $qNum - 1;
                        }
                    }
                });
            });
        });
    </script>
                    </div>
                </div>
                    <br>
                    <br>
                    <div class="recipe">
                            <h1> <span class='recipe-content'>Motivation Of The Day</span></h1>
                            <div id="pizza-box">
                
                                <h2 id='output' style="color: #fff">Looking for motivation?</h2>
                                <button class='button3' id='btn'> Press for a quote </button>
                            </div>
                        </div>
                </div>
            </main>

            <div id="sidebar">
                <div class="sidebar__title">
                    <h1>Menu Bar</h1>
                    <i class="fa fa-times" id="sidebarIcon" onclick=closeSidebar()></i>
                </div>
            
            <div class="sidebar__menu ">
                <div class="sidebar__link active_menu_link">
                    <i class="fa fa-home"></i>
                    <a href="dashboard.php">Dashboard</a>
                </div>
            
                <div class="sidebar__link">
                    <i class="fa fa-bar-chart" ></i>
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

                <div class="sidebar__link">
                    <div class="theme-switch-wrapper">
                        <h4>Theme &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</h4>
                        <label class="theme-switch" for="checkbox">
                            <input type="checkbox" id="checkbox" />
                            <div class="slider round"></div>
                      </label>
                      
                    </div>                    
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


