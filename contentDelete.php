<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['COO_id'])) {

    $content_id = $_GET['deleteContent'];
    // content details 
    $sql = "SELECT * FROM content WHERE content_id= '$content_id' ";
    $result = mysqli_query($conn, $sql);
    $content =  mysqli_fetch_array($result);
    $content_id = $content["content_id"];
    $content_title = $content['content_title'];
    $content_week = $content['week_id'];

    //week details 
    $sq = "SELECT * FROM week WHERE week_id= '$content_week' ";
    $rlt = mysqli_query($conn, $sq);
    $week =  mysqli_fetch_array($rlt);
    $week_id = $week["week_id"];
    $week_title = $week["week_title"];
    $week_number = $week["week_number"];
    $subject_id = $week["subject_id"];

    // subject details
    $sql = "SELECT * FROM subject WHERE subject_id= '$subject_id' ";
    $result = mysqli_query($conn, $sql);
    $subject =  mysqli_fetch_array($result);
    $subject_id = $subject["subject_id"];
    $subject_name = $subject["subject_name"];
?>



    <?php
    //if yesDeleteWeek button clicked 
    if (isset($_POST['yesDeleteContent'])) {

        $sq = "DELETE FROM content WHERE content_id = '$content_id'";
        mysqli_query($conn, $sq);

        $_SESSION['subject_id'] = $subject_id;
        $_SESSION['subject_name'] = $subject_name;
        $_SESSION['week_id'] = $week_id;
        $_SESSION['week_title'] = $week_title;
        $_SESSION['week_number'] = $week_number;
        header("Location: contents.php");
    }
    ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>contentDelete</title>
    </head>

    <body>
        <div>
            <h1> Are you sure you want to delete <br>
                <?php
                echo  $subject_name . "'s Content  : " . $content_title . " from week number " . $week_number . " ( " . $week_title . " )"; ?></h1>
        </div>
        <form action="" method="POST">
            <button type="submit" name="yesDeleteContent">YES</button>
        </form>
    </body>

    </html>
<?php } else {
    header("Location: teacherLogin.php");
} ?>