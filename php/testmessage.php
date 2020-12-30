<?php
$servername = "localhost";
$username = "id15518894_aamt";
$password = "Cps530-project";
$database = "id15518894_ourwebsite";
$counter = 1;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// getting user message through ajax
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$qNum = mysqli_real_escape_string($conn, $_POST['qNum']);
$total = mysqli_real_escape_string($conn, $_POST['total']);

$today_date = date('Y-m-d');
$sql_query = "SELECT score FROM $name WHERE score_date='$today_date'";
$repeat = mysqli_query($conn, $sql_query) or die('Error');

if (mysqli_num_rows($repeat) > 0) {
    $reply = "You've already taken the quiz today.";
    echo $reply;
} else {
    if (($qNum == 1) && (($getMesg == 'y') || ($getMesg == 'Y'))) {
        $check_query = "SELECT question FROM questions WHERE qno=$qNum";
        $run_query = mysqli_query($conn, $check_query) or die("Error.");
        $fetch_data = mysqli_fetch_assoc($run_query);
        //storing reply to a variable which we'll send to ajax
        $reply = $fetch_data['question'];
        echo $reply;
    } elseif (($qNum <= 5) && ($getMesg > 0) && ($getMesg < 11)) {
        $check_query = "SELECT question FROM questions WHERE qno=$qNum";
        $run_query = mysqli_query($conn, $check_query) or die("Error.");
        $fetch_data = mysqli_fetch_assoc($run_query);
        //storing reply to a variable which we'll send to ajax
        $reply = $fetch_data['question'];
        echo $reply;
    } elseif (($qNum == 6) && ($getMesg > 0) && ($getMesg < 11)) {
        $total = round($total/5);
        $insert_query = "INSERT INTO $name VALUES('$today_date', '$total')";
        mysqli_query($conn, $insert_query) or die("Error storing score.");
        $reply = "Thank you for taking the quiz.";
        echo $reply;
    } else {
        $reply = "Invalid response.";
        echo $reply;
    }
}

?>
