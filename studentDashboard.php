<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['student_id'])) {

    // getting student information
    $student_id = $_SESSION['student_id'];
    $query = "SELECT * FROM student WHERE student_id= '$student_id' ";
    $rlt = mysqli_query($conn, $query);
    $student =  mysqli_fetch_array($rlt);
    $student_id = $student["student_id"];
    $student_user_name = $student["user_name"];
    $Class_number  = $student["Class_number"];
?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="styleOthers.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

        <title>studentDashboard</title>
    </head>

    <body>

        <div class="section ">
            <h1 class="fs-5"><?php echo "User Name: " . $student_user_name . " <br>Student id :" . $student_id; ?></h1>
            <a href="logout.php">Logout</a>
        </div>
        <h1 class="fw-bold"><?php  echo "Class ". $Class_number ."'s "; ?> Subjects</h1>

        <!-- show subjects -->
        <?php
        $myQuery = "SELECT * FROM subject WHERE class_number = '$Class_number' ";
        $result = mysqli_query($conn, $myQuery);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $temp = $row["subject_id"]; ?>
                <div class="section">
                <h3 class="fs-2"><a href="studentWeeks.php?data=<?= $temp ?>"> <?php echo  $row["subject_id"] ?></a></h3>
                <h3 class="h3"><a href="studentWeeks.php?data=<?= $temp ?>"> <?php echo  $row["subject_name"] ?></a></h3>
                </div>
        <?php }
        } else {
            echo "<h2>" . $Class_number . " have no subjects </h2>";
        }
        ?>
        <!-- end subject showing-->


        <a href="studentResult.php?studentResult=<?= $student_id ?>">
        <h1 class="fw-bold">Results</h1>
        </a>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    </body>

    </html>
<?php } else {
    header("Location: studentLogin.php");
} ?>