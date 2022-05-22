<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['COO_id'])) {

    $exam_id = $_GET['editExam'];
    $sql = "SELECT * FROM exam WHERE exam_id= '$exam_id' ";
    $result = mysqli_query($conn, $sql);
    $exam =  mysqli_fetch_array($result);
    $exam_id = $exam["exam_id"];
    $exam_name = $exam["exam_name"];
    $submission_link = $exam["submission_link"];
    $question_link = $exam["question_link"];
    $exam_mark = $exam["exam_mark"];
    $examSubject_id = $exam["subject_id"];

    // getting exam percentage
    if ($exam_name === 'Mid') {
        $slq = "SELECT * FROM mid WHERE exam_id= '$exam_id' ";
        $rtl = mysqli_query($conn, $slq);
        $exam_percent =  mysqli_fetch_array($rtl);
        $exam_percentage = $exam_percent["mid_percentage"];
    } else {
        $slq = "SELECT * FROM final WHERE exam_id= '$exam_id' ";
        $rtl = mysqli_query($conn, $slq);
        $exam_percent =  mysqli_fetch_array($rtl);
        $exam_percentage = $exam_percent["final_percentage"];
    }

?>
    <?php
    //if update button clicked 
    if (isset($_POST['update'])) {
        //$exam_name = $_POST['exam_name'];
        $question_link = $_POST['question_link'];
        $submission_link = $_POST['submission_link'];
        $exam_mark = $_POST['exam_mark'];
        $exam_percentage = $_POST["exam_percentage"];

        /*  //in this query exam name can be changed 
            /but if it's possible to change exam name then it will occur problem
            
        $sq = "UPDATE exam SET exam_name = '$exam_name', question_link = '$question_link', 
        submission_link = '$submission_link', exam_mark = '$exam_mark' WHERE exam_id = '$exam_id'";
        mysqli_query($conn, $sq);
        */

        $sq = "UPDATE exam SET question_link = '$question_link', 
        submission_link = '$submission_link', exam_mark = '$exam_mark' WHERE exam_id = '$exam_id'";
        mysqli_query($conn, $sq);

        // updating in mid or final 
        if ($exam_name === 'Mid') {
            $sq = "UPDATE mid SET mid_percentage = '$exam_percentage' WHERE exam_id = '$exam_id'";
            mysqli_query($conn, $sq);
        } else {
            $sq = "UPDATE final SET final_percentage = '$exam_percentage' WHERE exam_id = '$exam_id'";
            mysqli_query($conn, $sq);
        }


        //catching subject name of a exam_id
        $ql = "SELECT * FROM subject WHERE subject_id=(SELECT subject_id FROM exam WHERE exam_id = '$exam_id')";
        $rlt = mysqli_query($conn, $ql);
        $subject =  mysqli_fetch_array($rlt);
        $_SESSION['subject_id'] = $subject["subject_id"];
        $_SESSION['subject_name'] = $subject["subject_name"];
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
        
        <title>examEdit</title>
    </head>

    <body>
    <div class="section">
            <form action="" method="POST">
                <h2>Exam name : <?php echo " " . $exam_name; ?></h2>
                <!-- exam name change option

                <input type="radio" id="mid" name="exam_name" value="Mid" required>
                <label for="mid">Mid</label><br>
                <input type="radio" id="final" name="exam_name" value="Final" required>
                <label for="final">Final</label> 
                -->
                <br>

                <h2>Exam question link :</h2>
                <input type="text" placeholder="question_link" name="question_link" value="<?php echo $exam['question_link']; ?>">
                <h2>Exam submission link :</h2>
                <input type="text" placeholder="submission_link" name="submission_link" value="<?php echo $exam['submission_link']; ?>">
                <h2>Exam marks : </h2>
                <input type="number" min="0" max="10000" placeholder="exam_mark" name="exam_mark" value="<?php echo $exam['exam_mark']; ?>">
                <h2>Exam Percentage : </h2>
                <input type="number" min="0" max="100" placeholder="exam_percentage" name="exam_percentage" value="<?php echo $exam_percentage; ?>">
                </br>
                <button class="btn btn-primary" type="submit" name="update">UPDATE</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
    </body>

    </html>
<?php } else {
    header("Location: teacherLogin.php");
} ?>