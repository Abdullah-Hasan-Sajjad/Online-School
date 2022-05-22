<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['COO_id'])) {


    // if condition for using subject_name and subject_id
    // while returning at weeks.php from weekAdder.php
    if (isset($_SESSION['subject_name'])) {
        $subject_id = $_SESSION['subject_id'];
        $subject_name = $_SESSION['subject_name'];
        $week_id = $_SESSION['week_id'];
        $week_title = $_SESSION['week_title'];
        $week_number = $_SESSION['week_number'];
        unset($_SESSION['subject_name']);
        unset($_SESSION['subject_id']);
        unset($_SESSION['week_id']);
        unset($_SESSION['week_title']);
        unset($_SESSION['week_number']);
    } else {
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
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styleOthers.css">

        <title>contents</title>
    </head>

    <body>

        <div>
            <h1 class="fw-bold">
                <?php
                echo $subject_name; ?> </h1>

            <h1 class="fs-2 fw-bold">
                <?php
                echo "WEEK NO. " . $week_number . " ==> " . $week_title; ?> </h1>
        </div>

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
                        <!-- printing content title ,serial no. ... -->
                        <h1 class="font-weight-bold"><?php echo "Content title : " . $row["content_title"] . " <br> Content serial no. " . $row["content_serial_no"] . " [ hidden for students] " ?></h1>
                        <?php echo "<h4> Content name : " . $row["content_name"] . "</h4>" ?>

                        <!-- printing content type-->
                        <?php

                        $myQuery = "SELECT * FROM content_content_type WHERE content_id = '$temp' ";
                        $myQueryResult = mysqli_query($conn, $myQuery);
                        $contentTYPE =  mysqli_fetch_array($myQueryResult);
                        $content_type = $contentTYPE['content_type'];
                        echo "<h5> Type of the content is: " . $content_type . " [ hidden for students]</h5>" ?>
                        <!-- end printing content type-->

                        <?php echo $row["content_link"] ?>
                        <?php echo "<p> Content description: " . $row["content_description"] . "</p>" ?>
                        <?php echo "<p> Content detail text: " . $row["content_detail_text"] . "</p>" ?>

                        <!-- edit button -->
                        <a href="contentEdit.php?editContent=<?= $temp ?>"><button class="btn btn-primary" type="button" name="editContent">EDIT</button></a>
                        <!-- delete button -->
                        <a href="contentDelete.php?deleteContent=<?= $temp ?>"><button class="btn btn-primary" type="button" name="deleteContent">DELETE</button></a>
                    </div>
            <?php }
            } else {
                echo "<h2>" . $subject_name . "'s week : " . $week_number . " have no content </h2>";
            }
            ?>
        </div>
        <!-- end content showing-->
        <div class="section">
            <a href="contentAdder.php?addContent=<?= $week_id ?>"><button class="btn btn-primary" type="button" name="addContent">+ ADD CONTENT</button></a>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    </body>

    </html>
<?php } else {
    header("Location: teacherLogin.php");
} ?>