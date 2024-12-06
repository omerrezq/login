<?php
include('config.php');
session_start();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$email'");
    if ($row = mysqli_fetch_assoc($select)) {
        if ($row['password'] === $pass) { // Validate password
            $_SESSION['user_id'] = $row['id'];
            header('location: home.php');
            exit;
        } else {
            $message[] = 'incorrect email or password';
        }
    } else {
        $message[] = 'incorrect email or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>login now</h3>
            <?php
            if (!empty($message)) {
                foreach ($message as $msg) {
                    echo '<div class="message">' . $msg . '</div>';
                }
            }
            ?>
            <input type="email" name="email" placeholder="enter email" required class="box">
            <input type="password" name="password" placeholder="enter password" required class="box">
            <input type="submit" name="submit" value="login now" class="btn">
            <p>don't have an account? <a href="register.php">register now</a></p>
        </form>
    </div>
</body>

</html>