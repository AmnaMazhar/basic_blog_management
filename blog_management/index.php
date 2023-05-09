<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <center>
        <h1>Login Form</h1>
        <?php
            require_once("require/connection.php");
            require("session_maintenance.php");
            $select_query = "SELECT * FROM `role` WHERE `role`.`role_id` ORDER BY `role`.`role_id` DESC";
            $result       = mysqli_query($connect, $select_query);
        ?>
        <div>
            <?php
                if(isset($_REQUEST['msg']))
                {
                    ?>
                        <p style="color: <?php echo $_REQUEST['color']; ?>;">
                            <?php echo $_REQUEST['msg']; ?>
                        </p>
                    <?php
                }
            ?>
        </div>
        <fieldset>
            <legend>Login Here...!</legend>
            <form action="login_process.php" method="POST">
                <table>
                    <tr>
                        <td>Email: </td>
                        <td><input type="email" name="email" placeholder="Enter Email" required/></td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td><input type="text" name="password" placeholder="Enter Password" required/></td>
                    </tr>
                    <tr>
                        <td>Login as: </td>
                        <td>
                            <select name="role" required>
                                <?php
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        ?>
                                            <option value="<?php echo $row['role_id']; ?>">
                                                <?php echo $row['role_type']; ?>
                                            </option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" name="login" value="Login"/></td>
                    </tr>
                    <tr>
                        <td colspan="2">Don't have an Account? Register <a href="register.php">Here</a></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </center>
</body>
</html>