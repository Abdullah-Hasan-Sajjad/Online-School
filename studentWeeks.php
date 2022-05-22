<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['student_id'])) {


    $subject_id = $_GET['data'];
    $sq = "SELECT * FROM subject WHERE subject_id= '$subject_id' ";
    $rlt = mysqli_query($conn, $sq);
    $subject =  mysqli_fetch_array($rlt);
    $subject_id = $subject["subject_id"];
    $subject_name = $subject["subject_name"];

?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styleOthers.css">
        <title>studentWeeks</title>
    </head>

    <body>

        <div>
            <h1 class="fw-bold">
                <?php
                echo $subject_name; ?> </h1>
        </div>

        <!-- showing weeks -->
        <div id="weeksShowing">
            <?php
            $query = "SELECT * FROM week WHERE subject_id = '$subject_id' ORDER BY week_number";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $temp = $row["week_id"]; ?>
                    <div class="section">
                        <a href="studentContents.php?week=<?= $temp ?>"> <?php echo "<h3> WEEK " . $row["week_number"] . "</h3>" ?></a>
                        <a href="studentContents.php?week=<?= $temp ?>"> <?php echo "<h3>" . $row["week_title"] . "</h3>" ?></a>
                    </div>
            <?php }
            } else {
                echo "<h2>" . $subject_name . " have no week </h2>";
            }
            ?>
        </div>
        <!-- end week showing-->


        <h1 class="fw-bold">EXAMS </h1>
        <!-- showing exams -->
        <div id="examsShowing">
            <?php
            $query = "SELECT * FROM exam WHERE subject_id = '$subject_id' ORDER BY exam_name DESC ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $examTemp = $row["exam_id"]; ?>
                    <div class="section">
                        <a href="studentExam.php?exam=<?= $examTemp ?>"> <?php echo "<h3>" . $row["exam_name"] . "</h3>" ?></a>
                    </div>
            <?php }
            } else {
                echo "<h2>" . $subject_name . " have no exam </h2>";
            } ?>
        </div>
        <!-- end exams showing-->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>

    </html>
<?php } else {
    header("Location: studentLogin.php");
} ?>