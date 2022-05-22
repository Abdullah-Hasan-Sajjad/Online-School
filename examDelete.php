<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['COO_id'])) {

    $exam_id = $_GET['deleteExam'];
    // content details 
    $sql = "SELECT * FROM exam WHERE exam_id= '$exam_id' ";
    $result = mysqli_query($conn, $sql);
    $exam =  mysqli_fetch_array($result);
    $exam_id = $exam["exam_id"];
    $exam_name = $exam["exam_name"];
    $examSubject_id = $exam["subject_id"];


    // subject details
    $sql = "SELECT * FROM subject WHERE subject_id= '$examSubject_id' ";
    $result = mysqli_query($conn, $sql);
    $subject =  mysqli_fetch_array($result);
    $subject_id = $subject["subject_id"];
    $subject_name = $subject["subject_name"];
?>



    <?php
    //if yesDeleteWeek button clicked 
    if (isset($_POST['yesDeleteExam'])) {

        $sq = "DELETE FROM exam WHERE exam_id = '$exam_id'";
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
        <title>examDelete</title>
    </head>

    <body>
        <div>
            <h1 class="fw-bold"> Are you sure you want to delete </br>
                <?php
                echo  $subject_name . "'s " . $exam_name . " exam"; ?></h1>
        </div>
        <div class="section">
            <form action="" method="POST">
                <button class="btn btn-primary" type="submit" name="yesDeleteExam">YES</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    </body>

    </html>
<?php } else {
    header("Location: teacherLogin.php");
} ?>