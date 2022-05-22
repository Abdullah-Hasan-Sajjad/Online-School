<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['COO_id'])) {

    $subject_id = $_GET['addExam'];
    // subject details
    $sql = "SELECT * FROM subject WHERE subject_id= '$subject_id' ";
    $result = mysqli_query($conn, $sql);
    $subject =  mysqli_fetch_array($result);
    $subject_id = $subject["subject_id"];
    $subject_name = $subject["subject_name"];

    //catching values from Form
    if (isset($_POST['addExam'])) {
        $exam_name = $_POST['exam_name'];
        $question_link = $_POST['question_link'];
        $submission_link = $_POST['submission_link'];
        $exam_mark = $_POST['exam_mark'];
        $exam_percentage = $_POST["exam_percentage"];

        // creating exam_id from subject_id
        if ($exam_name === 'Mid') {
            $exam_id = "M" . $subject_id;
        } else {
            $exam_id = "F" . $subject_id;
        }

        // checking if the exam_id exists or not if not then insert
        $sql = "SELECT * FROM exam WHERE exam_id='$exam_id'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
        //inserting into exam
        $sql = "INSERT INTO exam 
        (exam_name, question_link, submission_link, 
        exam_mark, exam_id , subject_id)
        VALUES 
        ('$exam_name', '$question_link', '$submission_link' ,'$exam_mark',
        '$exam_id','$subject_id')";
        $rlt = mysqli_query($conn, $sql);

            //inserting into final or mid 
            if ($exam_name === 'Mid') {
                $sq =  "INSERT INTO mid (mid_percentage, exam_id ) VALUES ('$exam_percentage', '$exam_id')";
                $res = mysqli_query($conn, $sq);
            } else {
                $sq =  "INSERT INTO final (final_percentage, exam_id ) VALUES ('$exam_percentage', '$exam_id')";
                $res = mysqli_query($conn, $sq);
            }

            if ($res) {
                $_SESSION['subject_id'] = $subject_id;
                $_SESSION['subject_name'] = $subject_name;
                header("Location: weeks.php");
            } else {
                echo "<script>alert('Something Wrong Went.')</script>";
            }
        } else {
            echo "<script>alert('This Exam Already Exists.')</script>";
        }
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>contentAdder</title>
    </head>

    <body>
        <div>
            <h1>Add exam in <?php echo " " . $subject_id; ?></h1>
        </div>
        <div class="container">
            <form action="" method="POST">
                <h2>Exam name : </h2>
                <input type="radio" id="mid" name="exam_name" value="Mid" required>
                <label for="mid">Mid</label><br>
                <input type="radio" id="final" name="exam_name" value="Final" required>
                <label for="final">Final</label><br>
                <h2>Exam question link :</h2>
                <input type="text" placeholder="question_link" name="question_link" required>
                <h2>Exam submission link :</h2>
                <input type="text" placeholder="submission_link" name="submission_link" required>
                <h2>Exam marks : </h2>
                <input type="number" min="0" max="10000" placeholder="exam_mark" name="exam_mark" required>
                <h2>Exam Percentage : </h2>
                <input type="number" min="0" max="100" placeholder="exam_percentage" name="exam_percentage" required>
                <button type="submit" name="addExam">ADD</button>
            </form>

        </div>
    </body>

    </html>
<?php } else {
    header("Location: teacherLogin.php");
} ?>