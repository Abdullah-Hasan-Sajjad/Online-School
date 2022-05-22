<?php

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['user_name'])) {
    header("Location: studentDashboard.php");
}

if (isset($_POST['submit'])) {
    $user_name = $_POST['username'];
    $First_name = $_POST['First_name'];
    $Last_name = $_POST['Last_name'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $Class_number = $_POST['Class_number'];
    $student_id  = $_POST['student_id'];
    $password = $_POST['password'];
    $checkPassword = $_POST['checkPassword'];

    if ($password == $checkPassword) {
        // if the student exists or not 
        $sql = "SELECT * FROM student WHERE student_id='$student_id'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO student (First_name , Last_name , user_name , 
            contact_no , password , email , student_id , Class_number)
			VALUES ('$First_name', '$Last_name', '$user_name', '$contact_no', 
            '$password', '$email', '$student_id', '$Class_number')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<script>alert('Student Signup Done.')</script>";
                $user_name = "";
                $First_name = "";
                $Last_name = "";
                $email = "";
                $contact_no = "";
                $Class_number = "";
                $student_id  = "";
                $_POST['password'] = "";
                $_POST['checkPassword'] = "";
            } else {
                echo "<script>alert('Something Went Wrong.')</script>";
            }
        } else {
            echo "<script>alert('This Student Already Exists.')</script>";
        }
    } else {
        echo "<script>alert('Password Not Matched.')</script>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="style.css">

    <title>studentSignUp</title>
</head>

<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <div class="input-group">
                <input type="text" placeholder="Student ID" name="student_id" value="<?php echo $student_id; ?>" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="First name" name="First_name" value="<?php echo $First_name; ?>" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Last name" name="Last_name" value="<?php echo $Last_name; ?>" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="User name" name="user_name" value="<?php echo $user_name; ?>" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Class number" name="Class_number" value="<?php echo $Class_number; ?>" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="contact no" name="contact_no" value="<?php echo $contact_no; ?>" required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" name="checkPassword" value="<?php echo $_POST['checkPassword']; ?>" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Have an account? <a href="studentLogin.php">Login Here</a>.</p>
        </form>
    </div>
</body>

</html>