<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_name']) && isset($_SESSION['COO_id'])) {

    $week_id = $_GET['editWeek'];
    $sql = "SELECT * FROM week WHERE week_id= '$week_id' ";
    $result = mysqli_query($conn, $sql);
    $week =  mysqli_fetch_array($result);
    $week_id = $week["week_id"];
    $week_title = $week['week_title'];
    $week_number = $week['week_number'];
    $subject_id = $week['subject_id'];

?>
    <?php
    //if update button clicked 
    if (isset($_POST['update'])) {
        $week_title = $_POST['week_title'];
        $week_number = $_POST['week_number'];

        $sq = "UPDATE week SET week_title = '$week_title', week_number = '$week_number' WHERE week_id = '$week_id'";
        mysqli_query($conn, $sq);

        //catching subject name of a week_id
        $ql = "SELECT * FROM subject WHERE subject_id=(SELECT subject_id FROM week WHERE week_id = '$week_id')";
        $rlt = mysqli_query($conn, $ql);
        $subject =  mysqli_fetch_array($rlt);
        $_SESSION['subject_id'] = $subject["subject_id"];
        $_SESSION['subject_name'] = $subject["subject_name"];
        header("Location: weeks.php");
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styleOthers.css">
        <title>weekEdit</title>
    </head>

    <body>
        <h1 class="fw-bold">
            <?php
            echo $subject_id; ?> </h1>
        <div class="section">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="weekTitle">Week title : </label>
                    <input class="form-control" type="text" placeholder="week_title" name="week_title" value="<?php echo $week['week_title']; ?>">
                </div>
                <div class="form-group">
                    <label for="weekNumber">Week number : </label>
                    <input class="form-control" type="number" min="01" max="99" placeholder="week_number" name="week_number" value="<?php echo $week['week_number']; ?>">
                </div><br>
                <button class="btn btn-primary" type="submit" name="update">UPDATE</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>

    </html>
<?php } else {
    header("Location: teacherLogin.php");
} ?>