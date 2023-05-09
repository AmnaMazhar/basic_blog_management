<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
</head>

<body>
    <center>
        <?php
            require_once 'session_maintenance.php';
            require_once('../require/connection.php');
            date_default_timezone_set("asia/karachi");
        ?>
        <h1>Admin Dashboard</h1>
        <hr>
        <p>Welcome
            <?php
                echo $_SESSION['user_info']['full_name'];
            ?>
        </p>
        <div>
            <a href="index.php">Add New Post</a>
            ||
            <a href="../logout.php">Logout</a>
        </div>
        <hr>
        <h3>All Users</h3>
        <table width="90%" cellpadding='2' border="2">
            <tr>
                <th>S.No:</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Role</th>
                <th>Login Time</th>
                <th>Logout Time</th>
            </tr>
            <?php
            $select_query = "SELECT * FROM user U 
                            INNER JOIN user_role UR ON U.`user_id` = UR.`user_id`
                            INNER JOIN role R ON R.`role_id` = UR.`role_id`";
            $result       = mysqli_query($connect, $select_query);

            if ($result->num_rows > 0) {
                $s_no = 1;
                $records = [];

                foreach ($result as $data) {
                    $full_name = $data['full_name'];

                    if (isset($records[$full_name])) {
                        $records[$full_name]['role_type'] .= ", " . $data['role_type'];
                    } else {
                        $records[$full_name] = $data;
                    }
                }

                foreach ($records as $row) {
            ?>
                    <tr>
                        <td><?php echo $s_no++; ?></td>
                        <td><?php echo $row['full_name'] ?></td>
                        <td><?php echo $row['user_email'] ?></td>
                        <td><?php echo $row['user_password'] ?></td>
                        <td><?php echo $row['role_type'] ?></td>
                        <td><?php echo date("j F Y h:i:s A", $row['login_time']); ?></td>
                        <td><?php if ($row['logout_time'] != 'Not Logged Out') echo date("j F Y h:i:s A", $row['logout_time']);
                            else echo $row['logout_time']; ?></td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5" align="center">No Records Available</td>
                </tr>
            <?php
            }
            ?>
        </table>
    </center>
</body>

</html>