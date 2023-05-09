<?php
    session_start();
    require_once("require/connection.php");
    require("session_maintenance.php");
    date_default_timezone_set('asia/karachi');

    if(isset($_POST['login']))
    {
        /* echo "<pre>";
        print_r($_POST);
        echo "</pre>"; */
        extract($_POST);

        ################## check if user exist in Database or not with that particular role ##################
        $select_query = "SELECT * FROM `user` U, `user_role` UR WHERE U.`user_email`= ? 
                         AND U.`user_password`= ? AND UR.`role_id` = ? AND U.`user_id` = UR.`user_id`";
        $stmt = mysqli_prepare($connect, $select_query);
		mysqli_stmt_bind_param($stmt, "ssi", $email, $password, $role);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

        if($result->num_rows > 0)
        {
            $user_info   = mysqli_fetch_assoc($result);

            ################## get that particular role's data for creating session ##################
            $role_query  = "SELECT * FROM `role` R WHERE R.role_id = ".$user_info['role_id'];
            $role_result = mysqli_query($connect, $role_query);

            $role                      = mysqli_fetch_assoc($role_result);
            $user_info['role_id']      =  $role['role_id'];
            $user_info['role_type']    = $role['role_type'];

            /* echo "<pre>";
            var_dump($user_info);
            echo "</pre>";
            die; */

            $_SESSION['user_info'] = $user_info;

            function login_time()
            {
                global $connect;

                $update_query = "UPDATE user_role SET login_time = '".time()."', logout_time = 'Not Logged Out'
                                 WHERE user_id = ".$_SESSION['user_info']['user_id']." AND role_id = ".$_SESSION['user_info']['role_id'];
                /*$result       = */mysqli_query($connect, $update_query);

                /* if($result) echo "done";
                else echo "not";
                die(); */
            }

            if($user_info['role_id'] == 1)
            {
                login_time();
                header("location: admin/index.php");
            }
            else if($user_info['role_id'] == 2)
            {
                login_time();
                header("location: author/index.php");
            }
            else if($user_info['role_id'] == 3)
            {
                login_time();
                header("location: user/index.php");
            }
        }
        else
        {
            header("location:index.php?msg=User Not Found With This Role!&color=red");
        }
    }
?>