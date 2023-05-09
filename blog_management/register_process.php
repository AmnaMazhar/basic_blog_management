<?php
    require_once("require/connection.php");
    require("session_maintenance.php");
    // print_r($_POST);

    if(isset($_POST['register']))
    {
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        extract($_POST);
        $active = 1;

        ############### INSERT DATA INTO user TABLE ###############
        $insert_user_query  = "INSERT INTO `user`(full_name, user_email,  user_password, is_active) VALUES(?,?,?,?)";
        $stmt_insert        = mysqli_prepare($connect, $insert_user_query);
        mysqli_stmt_bind_param($stmt_insert, 'sssi', $full_name, $email, $password, $active);

        if(mysqli_stmt_execute($stmt_insert))
        {
            ############### INSERT DATA INTO user_role TABLE ###############
            $user_id                = mysqli_insert_id($connect);
            $insert_userrole_query  = "INSERT INTO user_role(user_id, role_id, is_active) VALUES(?,?,?)";
            $stmt                   = mysqli_prepare($connect, $insert_userrole_query);
            mysqli_stmt_bind_param($stmt, 'iii', $user_id, $role, $active);
            mysqli_stmt_execute($stmt);

            header("location:register.php?msg=Successfully Registered with User Id ".$user_id."!&color=green");
        }
        else
        {
            header("location:register.php?msg=Something Went Wrong!&color=red");
        }
    }

?>