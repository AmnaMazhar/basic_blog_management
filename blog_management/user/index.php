<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <center>
        <?php
        require_once 'session_maintenance.php';
        require_once 'manage_post.php';
        ?>
        <h1>User Dashboard</h1>
        <p>Welcome
            <?php
            echo $_SESSION['user_info']['full_name'];
            ?>
        </p>
        <div>
            <a href="../logout.php">Logout</a>
        </div>
        <br>
        <?php
            ShowAllPosts();
        ?>
    </center>
</body>

</html>