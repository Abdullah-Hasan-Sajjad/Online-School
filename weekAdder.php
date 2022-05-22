    <?php
    include 'config.php';
    session_start();

    if (isset($_SESSION['user_name']) && isset($_SESSION['COO_id'])) {

        $subject_id = $_GET['addWeek'];
        //echo $subject_id;
        $sq = "SELECT * FROM subject WHERE subject_id= '$subject_id' ";
        $rlt = mysqli_query($conn, $sq);
        $subject =  mysqli_fetch_array($rlt);

        //catching values from Form
        if (isset($_POST['submit'])) {
            $week_title = $_POST['week_title'];
            $week_number = $_POST['week_number'];
            if ($week_number < 10) {
                $week_id = "0" . strval($week_number) . $subject_id;
            } else {
                $week_id = strval($week_number) . $subject_id;
            }

            // checking if the week_id exists or not if not then insert
            $sql = "SELECT * FROM week WHERE week_id='$week_id'";
            $result = mysqli_query($conn, $sql);
            if (!$result->num_rows > 0) {
                $sql = "INSERT INTO week (week_title, week_id, week_number, subject_id)
                        VALUES ('$week_title', '$week_id', '$week_number' ,'$subject_id')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $_SESSION['subject_id'] = $subject["subject_id"];
                    $_SESSION['subject_name'] = $subject["subject_name"];
                    header("Location: weeks.php");
                } else {
                    echo "<script>alert('Something Wrong Went.')</script>";
                }
            } else {
                echo "<script>alert('This Week Already Exists.')</script>";
            }
        }

    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>weekAdder</title>
        </head>

        <body>
            <div>
                <h1>Add week in <?php echo $subject_id; ?></h1>
            </div>
            <div class="container">
                <form action="" method="POST">
                    <h2>week title : </h2>
                    <input type="text" placeholder="week_title" name="week_title" required>
                    <h2>week number : </h2>
                    <input type="number" min="01" max="99" placeholder="week_number" name="week_number" required>
                    <button type="submit" name="submit">Add</button>
                </form>
            </div>
        </body>

        </html>
    <?php } else {
        header("Location: teacherLogin.php");
    } ?>