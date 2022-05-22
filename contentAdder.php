<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['COO_id'])) {

    $week_id = $_GET['addContent'];
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

    //catching values from Form
    if (isset($_POST['addContent'])) {
        $content_name = $_POST['content_name'];
        $content_title = $_POST['content_title'];
        $content_link = $_POST['content_link'];
        $content_type = $_POST['content_type'];
        $content_serial_no = $_POST['content_serial_no'];
        $content_description = $_POST['content_description'];
        $content_detail_text = $_POST['content_detail_text'];
        // creating content_id from week_id
        if ($content_serial_no < 10) {
            $content_id = $week_id . "000" . strval($content_serial_no);
        } elseif ($content_serial_no > 9 && $content_serial_no <= 99) {
            $content_id = $week_id . "00" . strval($content_serial_no);
        } elseif ($content_serial_no > 99 && $content_serial_no <= 999) {
            $content_id = $week_id . "0" . strval($content_serial_no);
        } else {
            $content_id = $week_id . strval($content_serial_no);
        }

        // checking if the week_id exists or not if not then insert
        $sql = "SELECT * FROM content WHERE content_id='$content_id'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            //inserting into content
            $sql = "INSERT INTO content 
        (content_name, content_title, content_link, content_serial_no, 
        content_description, content_detail_text, content_id, week_id)
        VALUES 
        ('$content_name', '$content_title', '$content_link' ,'$content_serial_no','
        $content_description','$content_detail_text','$content_id','$week_id')";
            mysqli_query($conn, $sql);
            //inserting content type 
            $slq = "INSERT INTO content_content_type (content_type,content_id) VALUES ('$content_type','$content_id')";
            $result = mysqli_query($conn, $slq);
            if ($result) {
                $_SESSION['subject_id'] = $subject_id;
                $_SESSION['subject_name'] = $subject_name;
                $_SESSION['week_id'] = $week_id;
                $_SESSION['week_title'] = $week_title;
                $_SESSION['week_number'] = $week_number;
                header("Location: contents.php");
            } else {
                echo "<script>alert('Something Wrong Went.')</script>";
            }
        } else {
            echo "<script>alert('This Content Already Exists.')</script>";
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
            <h1>Add content in <?php echo $subject_id . "'s week number : " . $week_number . " ==> " . $week_title; ?></h1>
        </div>
        <div class="container">
            <form action="" method="POST">
                <h2>content title : </h2>
                <input type="text" placeholder="content_title" name="content_title" required>
                <h2>content serial no : </h2>
                <input type="number" min="01" max="9999" placeholder="content_serial_no" name="content_serial_no" required>
                <h2>content name : </h2>
                <input type="text" placeholder="content_name" name="content_name" required>
                <h2>content type : </h2>
                <input type="text" placeholder="content_type" name="content_type" required>
                <h2>content link : </h2>
                <input type="text" placeholder="content_link" name="content_link" required>
                <h2>content description : </h2>
                <textarea id="content_description" name="content_description" rows="15" cols="70"> </textarea>
                <h2>content detail_text : </h2>
                <textarea id="content_detail_text" name="content_detail_text" rows="15" cols="70"> </textarea>
                <button type="submit" name="addContent">Add</button>
            </form>

        </div>
    </body>

    </html>
<?php } else {
    header("Location: teacherLogin.php");
} ?>