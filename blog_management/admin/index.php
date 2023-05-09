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
        <h1>Admin Dashboard</h1>
        <p>Welcome
            <?php
            echo $_SESSION['user_info']['full_name'];
            ?>
        </p>
        <div>
            <a href="all_users.php">All Users</a>
            ||
            <a href="../logout.php">Logout</a>
        </div>
        <div>
            <?php
            if (isset($_REQUEST['msg'])) {
            ?>
                <p style="color: <?php echo $_REQUEST['color']; ?>;">
                    <?php echo $_REQUEST['msg']; ?>
                </p>
            <?php
            }
            ?>
        </div>
        <?php
        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') {
            editPost("process_post.php", "POST", $_REQUEST['post_id']);
        } elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete') {
            header('location:process_post.php?action=delete&post_id=' . $_REQUEST['post_id']);
        } else {
            AddPostForm("process_post.php", "POST");
        }
        ShowAllPosts();
        ?>
    </center>
</body>

</html>