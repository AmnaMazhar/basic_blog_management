<?php
    require_once('../require/connection.php');
    require_once 'session_maintenance.php';

    if(isset($_POST['add_post']))
    {   
        extract($_POST);

        $insert_query = "INSERT INTO post(user_role_id, post_title, post_description) VALUES(?,?,?)";
        $stmt         = mysqli_prepare($connect, $insert_query);
        $user_role_id = $_SESSION['user_info']['user_role_id'];
        mysqli_stmt_bind_param($stmt, "iss", $user_role_id, $post_title, $post_description);

        if (mysqli_stmt_execute($stmt)) 
        {
            $last_id = mysqli_insert_id($connect);
            header("location: index.php?msg=Post Added With Id ".$last_id."!&color=green");
        } 
        else 
        {
            header("location: index.php?msg=Something Went Wrong!&color=green");
        }
    }
    elseif(isset($_REQUEST['action']) && ($_REQUEST['action'] == 'delete'))
    {
        extract($_POST);
        $update_query = "UPDATE post SET is_active = 'Inactive' WHERE post_id = ".$_REQUEST['post_id'];
        $result       = mysqli_query($connect, $update_query);

        if($result)
        {
            header('location:index.php?msg=Post Deleted with Post Id ='.$_REQUEST['post_id'].'&color=green');
        }
        else
        {
            header('location:index.php?msg=Something Went Wrong&color=red');
        }
    }
    elseif(isset($_POST['update_post']))
    {
        extract($_POST);
        
        $update_query = "UPDATE post SET post_title = '".$post_title."', post_description = '".$post_description."' WHERE post_id = ".$post_id;
        $result       = mysqli_query($connect, $update_query);

        if($result)
        {
            header('location:index.php?msg=Post Updated with Post Id ='.$post_id.'&color=green');
        }
        else
        {
            header('location:index.php?msg=Something Went Wrong&color=red');
        }
    }
?>