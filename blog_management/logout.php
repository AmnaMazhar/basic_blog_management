<?php
	// session_start();
	require_once 'require/connection.php';
    require_once 'session_maintenance.php';
	date_default_timezone_set('asia/karachi');

    if(isset($_SESSION['user_info']) && $_SESSION['user_info']['user_id'])
    {
		$id =  $_SESSION['user_info']['user_id'];

		$time_logged_out = time();

		$update_query = "UPDATE user_role SET logout_time = ? WHERE user_id = ?";
		$stmt         = mysqli_prepare($connect, $update_query);
		mysqli_stmt_bind_param($stmt,'si', $time_logged_out, $id);
        if(mysqli_stmt_execute($stmt))
        {
            session_destroy();
            header("location: index.php?msg=Logout Successfully!&color=green");
        }
        else
        {
            header("location: index.php?msg=Something Went Wrong!&color=red");
        }
	}
?>