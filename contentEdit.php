<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['COO_id'])) {

    $content_id = $_GET['editContent'];
    // content details 
    $sql = "SELECT * FROM content WHERE content_id= '$content_id' ";
    $result = mysqli_query($conn, $sql);
    $content =  mysqli_fetch_array($result);
    $content_id = $content["content_id"];
    $content_name = $content['content_name'];
    $content_title = $content['content_title'];
    $content_link = $content['content_link'];
    $content_serial_no = $content['content_serial_no'];
    $content_description = $content['content_description'];
    $content_detail_text = $content['content_detail_text'];
    $content_week = $content['week_id'];

    //content type 
    $myQuery = "SELECT content_type FROM content_content_type WHERE content_id = '$content_id' ";
    $myQueryResult = mysqli_query($conn, $myQuery);
    $content_type =  mysqli_fetch_array($myQueryResult);
    $content_type = $content_type['content_type'];

    //week details 
    $sq = "SELECT * FROM week WHERE week_id= '$content_week' ";
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


    <!--- if update button clicked --->
    <?php
    if (isset($_POST['update'])) {
        $content_name = $_POST['content_name'];
        $content_title = $_POST['content_title'];
        $content_link = $_POST['content_link'];
        $content_type = $_POST['content_type'];
        $content_serial_no = $_POST['content_serial_no'];
        $content_description = $_POST['content_description'];
        $content_detail_text = $_POST['content_detail_text'];

        // update content in content table query
        $sq = "UPDATE content SET content_name = '$content_name', content_title = '$content_title',
        content_link = '$content_link',
        content_serial_no = '$content_serial_no',
        content_description = '$content_description',
        content_detail_text = '$content_detail_text' WHERE content_id = '$content_id'";
        mysqli_query($conn, $sq);

        // update content_type in content_content_type table query
        $sqry = "UPDATE content_content_type SET content_type = '$content_type' WHERE content_id = '$content_id'";
        mysqli_query($conn, $sqry);

        //catching subject name of a week_id for showing in contents page
        //$ql = "SELECT * FROM subject WHERE subject_id=(SELECT subject_id FROM week WHERE week_id = '$week_id')";
        //$rlt = mysqli_query($conn, $ql);
        //$subject =  mysqli_fetch_array($rlt);
        $_SESSION['subject_id'] = $subject_id;
        $_SESSION['subject_name'] = $subject_name;
        $_SESSION['week_id'] = $week_id;
        $_SESSION['week_title'] = $week_title;
        $_SESSION['week_number'] = $week_number;

        header("Location: contents.php");
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>contentEdit</title>
    </head>

    <body>
        <div><?php echo "<h1>Update " . $subject_name . "'s week number : " . $week_number . " ==> " . $week_title . "</h1>" ?></div>
        <div>
            <form action="" method="POST">
                <h2>content title : </h2>
                <input type="text" placeholder="content_title" name="content_title" value="<?php echo $content_title; ?>">
                <h2>content serial no : </h2>
                <input type="number" min="01" max="9999" placeholder="content_serial_no" name="content_serial_no" value="<?php echo $content_serial_no; ?>">
                <h2>content name : </h2>
                <input type="text" placeholder="content_name" name="content_name" value="<?php echo $content_name; ?>">
                <h2>content type : </h2>
                <input type="text" placeholder="content_type" name="content_type" value="<?php echo $content_type; ?>">
                <h2>content link : </h2>
                <input type="text" placeholder="content_link" name="content_link" value="<?php echo $content_link; ?>">
                <h2>content description : </h2>
                <textarea id="content_description" name="content_description" rows="15" cols="70">
            <?php echo $content_description; ?>
            </textarea>
                <h2>content detail_text : </h2>
                <textarea id="content_detail_text" name="content_detail_text" rows="15" cols="70">
            <?php echo $content_detail_text; ?>
            </textarea>
                <button type="submit" name="update">UPDATE</button>
            </form>
        </div>
    </body>

    </html>
<?php } else {
    header("Location: teacherLogin.php");
} ?>