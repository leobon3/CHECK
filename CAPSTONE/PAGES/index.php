<?php
@include 'config.php';

session_start();

$login_error = '';    // Initialize the login error message
$success_message = '';

if (isset($_POST['login'])) {
    // Login form is submitted
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $pass = $_POST['password'];

    $select = "SELECT * FROM user_form WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $stored_password = $row['password'];

        if (password_verify($pass, $stored_password)) {
            $user_type = $row['user_type'];
            $_SESSION['user_type'] = $user_type;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_department'] = $row['department'];

            if ($user_type == 'Admin') {
                header('location: calendar_admin.php');
            } elseif ($user_type == 'Implementor') {
                header('location: calendar_implementor.php');
            } elseif ($user_type == 'Attendee') {
                header('location: calendar_user.php');
            } else {
                header('location: unauthorized.php');
            }
        } else {
            $login_error = 'Incorrect email or password!';
        }
    } else {
        $login_error = 'Incorrect email or password!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form Design</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="image_box">
            <img src="icon/2.jpg">
        </div>
        <div class="box">
            <img class="pic" src="icon/cvsu.png">
            <h2>Event Scheduler</h2>
            <form action="" method="post">
                <?php
                if (!empty($login_error)):
                ?>
                <div class="alert alert-danger w-75 mx-auto" style="font-size: 14px;">
                    <?php echo $login_error; ?>
                </div>
                <?php
                endif;
                ?>
                <div class="input_box">
                    <input type="text" name="user_email" required>
                    <label>Email</label>
                </div>
                <div class="input_box">
                    <input type="password" name="password" required id="login-password">
                    <label>Password</label>
                </div>
                <label class="checkbox"><input type="checkbox"><p>Show Password</p></label>
                <div class="forgot_password_box">
                    <div class="forgot_password"><a href="forgot-password.php">Forgot Password?</a></div>
                </div>
                <button class="login_button" id="loginButton" type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>