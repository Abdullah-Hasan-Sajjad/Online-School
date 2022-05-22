<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['COO_id'])) {


    $subject_id = $_GET['grading'];
    // subject details
    $sql = "SELECT * FROM subject WHERE subject_id= '$subject_id' ";
    $result = mysqli_query($conn, $sql);
    $subject =  mysqli_fetch_array($result);
    $subject_id = $subject["subject_id"];
    $subject_name = $subject["subject_name"];


    //catching values from Form
    if (isset($_POST['resultSubmit'])) {
        $exam_name = $_POST['exam_name'];
        $student_id = $_POST['student_id'];
        $marks_obtained = $_POST['marks_obtained'];

        // getting exam_id from exam
        $myQuery = "SELECT * FROM exam WHERE exam_name ='$exam_name' AND subject_id = '$subject_id' ";
        $myQueryResult = mysqli_query($conn, $myQuery);
        $exam =  mysqli_fetch_array($myQueryResult);
        $exam_id = $exam['exam_id'];

        // checking if the exam_id and student_id exists or not if exists then update otherwise insert 
        $sql = "SELECT * FROM result WHERE exam_id='$exam_id' AND student_id = '$student_id' ";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {

            //inserting into result
            $sql = "INSERT INTO result (exam_id, student_id, mark) VALUES ('$exam_id', '$student_id', '$marks_obtained')";
            $rlt = mysqli_query($conn, $sql);

            // UPDATING OR INSERTING STUDENT GRADE 
            //SECTION => GRADE_UPDATE_INSERT starting

            // check if the student has grade 
            $a = "SELECT * FROM grading WHERE subject_id='$subject_id' AND student_id = '$student_id' ";
            $b = mysqli_query($conn, $a);

            // if has grade
            if ($b->num_rows > 0) {
                // update grade 
                $gradeMark = 0;
                // getting student's result 
                $grdSql = "SELECT * FROM result WHERE exam_id IN (SELECT exam_id FROM exam WHERE subject_id = '$subject_id') AND student_id = '$student_id'";
                $grdSqlResult = mysqli_query($conn, $grdSql);
                // if student has result
                if (!$grdSqlResult->num_rows < 1) {

                    // catching all results and calculating full mark
                    while ($row = mysqli_fetch_array($grdSqlResult)) {
                        $obtainedMark = $row["mark"];
                        $exam_id = $row["exam_id"];

                        // taking exam mark 
                        $lq = "SELECT * FROM exam WHERE exam_id = '$exam_id'";
                        $rResult = mysqli_query($conn, $lq);
                        $exam =  mysqli_fetch_array($rResult);
                        $exam_mark = $exam["exam_mark"];
                        $exam_name = $exam["exam_name"];

                        // getting exam_percentage
                        if ($exam_name === 'Mid') {
                            $sq = "SELECT * FROM mid WHERE exam_id= '$exam_id'";
                            $res = mysqli_query($conn, $sq);
                            $exam_percent =  mysqli_fetch_array($res);
                            $exam_percentage = $exam_percent["mid_percentage"];
                        } else {
                            $sq = "SELECT * FROM final WHERE exam_id= '$exam_id'";
                            $res = mysqli_query($conn, $sq);
                            $exam_percent =  mysqli_fetch_array($res);
                            $exam_percentage = $exam_percent["final_percentage"];
                        }
                        $gradeMark = $gradeMark + (($obtainedMark * $exam_percentage) / $exam_mark);
                    }
                }

                // if mark is lees than 51 then B other wise grade A
                $grade="NULL";
                if ($gradeMark < 51) {
                    $grade = "B";
                } else {
                    $grade = "A";
                }
                //updating grade 
                $c = "UPDATE grading SET grade = '$grade' WHERE subject_id='$subject_id' AND student_id = '$student_id' ";
                mysqli_query($conn, $c);
            } else {

                // if mark is lees than 51 then B other wise grade A
                $grade="NULL";
                if ($gradeMark < 51) {
                    $grade = "B";
                } else {
                    $grade = "A";
                }

                //insert grade
                $c = "INSERT INTO grading (subject_id, student_id, grade) VALUES ('$subject_id', '$student_id', '$grade')";
                mysqli_query($conn, $c);
            }

            //SECTION => GRADE_UPDATE_INSERT end

            if ($rlt) {
                header("Location: teacherDashboard.php");
            } else {
                echo "<script>alert('Something Wrong Went.')</script>";
            }
        } else {

            // updating marks 
            $sq = "UPDATE result SET mark = '$marks_obtained' WHERE exam_id='$exam_id' AND student_id = '$student_id' ";
            mysqli_query($conn, $sq);

            // UPDATING OR INSERTING STUDENT GRADE 
            //SECTION => GRADE_UPDATE_INSERT starting

            // check if the student has grade 
            $a = "SELECT * FROM grading WHERE subject_id='$subject_id' AND student_id = '$student_id' ";
            $b = mysqli_query($conn, $a);

            // if has grade
            if ($b->num_rows > 0) {
                // update grade 
                $gradeMark = 0;
                // getting student's result 
                $grdSql = "SELECT * FROM result WHERE exam_id IN (SELECT exam_id FROM exam WHERE subject_id = '$subject_id') AND student_id= '$student_id'";
                $grdSqlResult = mysqli_query($conn, $grdSql);
                // if student has result
                if (!$grdSqlResult->num_rows < 1) {

                    // catching all results and calculating full mark
                    while ($row = mysqli_fetch_array($grdSqlResult)) {
                        $obtainedMark = $row["mark"];
                        $exam_id = $row["exam_id"];

                        // taking exam mark 
                        $lq = "SELECT * FROM exam WHERE exam_id = '$exam_id'";
                        $rResult = mysqli_query($conn, $lq);
                        $exam =  mysqli_fetch_array($rResult);
                        $exam_mark = $exam["exam_mark"];
                        $exam_name = $exam["exam_name"];

                        // getting exam_percentage
                        if ($exam_name === 'Mid') {
                            $sq = "SELECT * FROM mid WHERE exam_id= '$exam_id'";
                            $res = mysqli_query($conn, $sq);
                            $exam_percent =  mysqli_fetch_array($res);
                            $exam_percentage = $exam_percent["mid_percentage"];
                        } else {
                            $sq = "SELECT * FROM final WHERE exam_id= '$exam_id'";
                            $res = mysqli_query($conn, $sq);
                            $exam_percent =  mysqli_fetch_array($res);
                            $exam_percentage = $exam_percent["final_percentage"];
                        }
                        $gradeMark = $gradeMark + (($obtainedMark * $exam_percentage) / $exam_mark);
                    }
                }

                // if mark is lees than 51 then B other wise grade A
                $grade="NULL";
                if ($gradeMark < 51) {
                    $grade = "B";
                } else {
                    $grade = "A";
                }
                //updating grade 
                $c = "UPDATE grading SET grade = '$grade' WHERE subject_id='$subject_id' AND student_id = '$student_id' ";
                mysqli_query($conn, $c);
            } else {
                
                // if mark is lees than 51 then B other wise grade A
                $grade="NULL";
                if ($gradeMark < 51) {
                    $grade = "B";
                } else {
                    $grade = "A";
                }

                //insert grade
                $c = "INSERT INTO grading (subject_id, student_id, grade) VALUES ('$subject_id', '$student_id', '$grade')";
                mysqli_query($conn, $c);
            }

            //SECTION => GRADE_UPDATE_INSERT end

            header("Location: teacherDashboard.php");
        }
    }




?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>weeks</title>
    </head>

    <body>

        <div>
            <h1>Grading in
                <?php
                echo " " . $subject_name; ?> </h1>
        </div>
        <div class="container">
            <form action="" method="POST">
                <h2>Exam name : </h2>
                <input type="radio" id="mid" name="exam_name" value="Mid" required>
                <label for="mid">Mid</label><br>
                <input type="radio" id="final" name="exam_name" value="Final" required>
                <label for="final">Final</label><br>
                <h2>Student ID :</h2>
                <input type="text" placeholder="student_id" name="student_id" required>
                <h2>Marks obtained : </h2>
                <input type="number" min="0" max="10000" placeholder="marks_obtained" name="marks_obtained" required>
                <button type="submit" name="resultSubmit">Submit result</button>
            </form>
        </div>


    </body>

    </html>
<?php } else {
    header("Location: teacherLogin.php");
} ?>