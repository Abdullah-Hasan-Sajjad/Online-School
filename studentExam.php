<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['student_id'])) {


    $exam_id = $_GET['exam'];
    //exam details 
    $sq = "SELECT * FROM exam WHERE exam_id= '$exam_id' ";
    $rlt = mysqli_query($conn, $sq);
    $exam =  mysqli_fetch_array($rlt);
    $exam_id = $exam["exam_id"];
    $exam_name = $exam["exam_name"];
    $submission_link = $exam["submission_link"];
    $question_link = $exam["question_link"];
    $exam_mark = $exam["exam_mark"];
    $examSubject_id = $exam["subject_id"];

    // getting exam_percentage
    if ($exam_name === 'Mid') {
        $sq = "SELECT * FROM mid WHERE exam_id= '$exam_id'";
        $res =mysqli_query($conn, $sq);
        $exam_percent =  mysqli_fetch_array($res);
        $exam_percentage = $exam_percent["mid_percentage"];
    } else {
        $sq = "SELECT * FROM final WHERE exam_id= '$exam_id'";
        $res = mysqli_query($conn, $sq);
        $exam_percent =  mysqli_fetch_array($res);
        $exam_percentage = $exam_percent["final_percentage"];
    }

    // subject details
    $sql = "SELECT * FROM subject WHERE subject_id= '$examSubject_id' ";
    $result = mysqli_query($conn, $sql);
    $subject =  mysqli_fetch_array($result);
    $subject_id = $subject["subject_id"];
    $subject_name = $subject["subject_name"];

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="styleOthers.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

        <title>studentExam</title>
    </head>

    <body>

        <div>
        <h1 class="fw-bold">
                <?php
                echo $subject_name; ?> </h1>
            <div class="section">
                <?php
                echo "Exam name :  " . $exam_name . "<br>";
                echo "Exam mark :  " . $exam_mark . "<br>";
                echo "Exam percentage :  " . $exam_percentage . "%<br>";
                echo "Question link :  " . $question_link . "<br>";
                echo "Submission link :  " . $submission_link;
                ?> </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
    </body>

    </html>
<?php } else {
   header("Location: studentLogin.php");
} ?>