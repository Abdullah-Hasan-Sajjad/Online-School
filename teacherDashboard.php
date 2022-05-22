<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['COO_id'])) {
?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="styleOthers.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

        <title>teacherDashboard</title>
    </head>

    <body>
        <div class="section ">
            <h1 class="fs-5"><?php echo "User Name : " . $_SESSION['user_name'] . " <br>COO id : " . $_SESSION['COO_id']; ?></h1>
            <a href="logout.php">Logout</a>
        </div>
        <h1 class="fw-bold">Subjects</h1>

        <!-- show subjects -->
        <?php
        $COO_id = $_SESSION['COO_id'];
        $query = "SELECT * FROM subject WHERE (subject_id) IN (SELECT subject_id FROM subject WHERE (subject_id) IN (select subject_id from subject_manager WHERE COO_id=(SELECT COO_id FROM co_ordinator_co_ordinator_type WHERE co_ordinator_type='Subject_Co_Ordinator' AND COO_id='$COO_id'))) OR  (subject_id) IN ( SELECT subject_id FROM subject WHERE (subject_id) IN (SELECT subject_id FROM subject WHERE class_number=(SELECT class_number FROM class WHERE COO_id=(SELECT COO_id FROM co_ordinator_co_ordinator_type WHERE co_ordinator_type='Class_Co_Ordinator'AND COO_id= '$COO_id' )))) ORDER BY class_number;";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $temp = $row["subject_id"]; ?>
                <div class="section">
                    <h3 class="fs-2"><a href="weeks.php?data=<?= $temp ?>"> <?php echo  $row["subject_id"] ?></a></h3>
                    <h3 class="h3"><a href="weeks.php?data=<?= $temp ?>"> <?php echo  $row["subject_name"] ?></a></h3>
                </div>
        <?php }
        } else {
            echo "<h2> you have no allocated subject </h2>";
        }
        ?>
        <!-- end subject showing-->

        <h1 class="fw-bold">GRADING</h1>
        <!-- show subjects for grading -->
        <?php
        $COO_id = $_SESSION['COO_id'];
        $query = "SELECT * FROM subject WHERE (subject_id) IN (SELECT subject_id FROM subject WHERE (subject_id) IN (select subject_id from subject_manager WHERE COO_id=(SELECT COO_id FROM co_ordinator_co_ordinator_type WHERE co_ordinator_type='Subject_Co_Ordinator' AND COO_id='$COO_id'))) OR  (subject_id) IN ( SELECT subject_id FROM subject WHERE (subject_id) IN (SELECT subject_id FROM subject WHERE class_number=(SELECT class_number FROM class WHERE COO_id=(SELECT COO_id FROM co_ordinator_co_ordinator_type WHERE co_ordinator_type='Class_Co_Ordinator'AND COO_id= '$COO_id' )))) ORDER BY class_number;";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $temp = $row["subject_id"]; ?>
                <div class="section">
                    <h3 class="h3"><a href="grading.php?grading=<?= $temp ?>"> <?php echo $row["subject_id"] ?></a></h3>
                </div>
        <?php }
        } else {
            echo "<h2> you have no allocated subject </h2>";
        }
        ?>
        <!-- end subject showing for grading -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>

    </html>
<?php } else {
    header("Location: teacherLogin.php");
} ?>