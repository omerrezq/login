<?php


include('config.php');
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) { // Redirect if user is not logged in
    header('location: login.php');
    exit;
}
if (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header('location: login.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Home</title>
</head>

<body>
    <div class="container">
        <div class="profile">
            <?php
            $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
            $fetch = null;

            if (mysqli_num_rows($select) > 0) {
                $fetch = mysqli_fetch_assoc($select);
            }
            if ($fetch['image'] == '') {
                echo '<img src="images/user.png">';
            } else {
                echo '<img src="uploaded_img/' . $fetch['image'] . '">';
            }
            ?>
            <?php if ($fetch): ?>
                <h3><?php echo $fetch['name']; ?></h3>
                <a href="update_profile.php" class="btn">update profile</a>
                <a href="home.php?logout=<?php echo $user_id; ?>" class="delete-btn">logout</a>
            <?php else: ?>
                <p>User not found</p>
                <p><a href="login.php">Login</a> or <a href="register.php">Register</a></p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>