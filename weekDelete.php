<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['COO_id'])) {

    $week_id = $_GET['deleteWeek'];
    $sql = "SELECT * FROM week WHERE week_id= '$week_id' ";
    $result = mysqli_query($conn, $sql);
    $week =  mysqli_fetch_array($result);
    $week_id = $week["week_id"];
    $week_title = $week['week_title'];
    $week_number = $week['week_number'];

    //catching subject name of a week_id
    $ql = "SELECT * FROM subject WHERE subject_id=(SELECT subject_id FROM week WHERE week_id = '$week_id')";
    $rlt = mysqli_query($conn, $ql);
    $subject =  mysqli_fetch_array($rlt);
    $subject_id = $subject["subject_id"];
    $subject_name = $subject["subject_name"];
?>
    <?php
    //if yesDeleteWeek button clicked 
    if (isset($_POST['yesDeleteWeek'])) {

        $sq = "DELETE FROM week WHERE week_id = '$week_id'";
        mysqli_query($conn, $sq);

        $_SESSION['subject_id'] = $subject_id;
        $_SESSION['subject_name'] = $subject_name;
        header("Location: weeks.php");
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styleOthers.css">
        <title>weekDelete</title>
    </head>

    <body>
        <div>
            <h1 class="fw-bold"> Are you sure you want to delete </br>
                <?php
                echo $week_title . " from <br>" . $subject_name . " " ?> and all it's contents?</h1>
        </div>
        <div class="section">
            <form action="" method="POST">
                <button class="btn btn-primary" type="submit" name="yesDeleteWeek">YES</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    </body>

    </html>
<?php } else {
    header("Location: teacherLogin.php");
} ?>