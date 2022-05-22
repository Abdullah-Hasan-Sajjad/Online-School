<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['student_id'])) {


    $student_id = $_GET['studentResult'];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styleOthers.css">
        <title>studentResult</title>

    </head>

    <body>
        <div>
            <h1 class="fw-bold">MARKS</h1>
        </div>

        <div class="resultSection">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Subject</th>
                        <th scope="col">Exam Name</th>
                        <th scope="col">Marks</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- showing results of each subject -->
                    <?php
                    $myQuery = "SELECT * FROM result WHERE student_id = '$student_id' ORDER BY exam_id DESC ";
                    $result = mysqli_query($conn, $myQuery);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            $temp = $row["exam_id"];

                            // getting exam's information 
                            $sql = "SELECT * FROM exam WHERE exam_id= '$temp' ";
                            $rlt = mysqli_query($conn, $sql);
                            $exam =  mysqli_fetch_array($rlt);
                            $exam_id = $exam["exam_id"];
                            $exam_name = $exam["exam_name"];
                            $examSubject_id = $exam["subject_id"]; ?>
                            <tr>
                                <?php echo "<td>" . $examSubject_id . "</td>" ?>
                                <?php echo "<td>" . $exam_name . "</td>" ?>
                                <?php echo "<td>" . $row["mark"] . "</td>" ?>
                            </tr>

                    <?php }
                    } else {
                        echo "<h2> You have no result </h2>";
                    }
                    ?>
                    <!-- end showing results of each subject-->
                </tbody>
            </table>
        </div>


        

        <h1 class="fw-bold">GRADES : </h1>
        <div class="GradeShow">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Subject</th>
                    <th scope="col">Grade</th>
                </tr>
            </thead>
            <tbody>
                <!-- showing grade of each subject -->
                <?php
                $myQuery = "SELECT * FROM grading WHERE student_id = '$student_id' ORDER BY subject_id ";
                $result = mysqli_query($conn, $myQuery);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <?php echo "<td>" . $row["subject_id"] . "</td>" ?>
                            <?php echo "<td>" . $row["grade"] . "</td>" ?>
                        </tr>

                <?php }
                } else {
                    echo "<h2> You have no grade </h2>";
                }
                ?>
                <!-- end showing grades of each subject-->
            </tbody>
        </table>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>

    </html>
<?php } else {
    header("Location: studentLogin.php");
} ?>