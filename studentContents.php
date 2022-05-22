<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['student_id'])) {


    $week_id = $_GET['week'];
    //week details 
    $sq = "SELECT * FROM week WHERE week_id= '$week_id' ";
    $rlt = mysqli_query($conn, $sq);
    $week =  mysqli_fetch_array($rlt);
    $week_id = $week["week_id"];
    $week_title = $week["week_title"];
    $week_number = $week["week_number"];
    $subject_id = $week["subject_id"];

    // subject details
    $sql = "SELECT * FROM subject WHERE subject_id= '$subject_id' ";
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styleOthers.css">
        <title>studentContents</title>
    </head>

    <body>

        <div>
        <h1 class="fw-bold">
                <?php
                echo $subject_name; ?> </h1>
            <h1 class="fs-2 fw-bold">
                <?php
                echo "week no. " . $week_number . "<br>" . $week_title; ?> </h1>
        </div>

        <!-- showing contents -->
        <div>
            <?php

            $query = "SELECT * FROM content WHERE week_id = '$week_id' ORDER BY content_serial_no";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $temp = $row["content_id"]; ?>
                    <div class="section">
                    <h1 class="font-weight-bold"><?php echo  $row["content_title"] ?></h1>
                    <?php echo "<h4>" . $row["content_name"] . "</h4>" ?>
                    <?php echo $row["content_link"] ?>
                    <?php echo "<p>" . $row["content_description"] . "</p>" ?>
                    <?php echo "<p>" . $row["content_detail_text"] . "</p>" ?>
        </div>
            <?php }
            } else {
                echo "<h2>" . $subject_name . "'s week : " . $week_number . " have no content </h2>";
            }
            ?>
        </div>
        <!-- end content showing-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    </body>

    </html>
<?php } else {
    header("Location: studentLogin.php");
} ?>