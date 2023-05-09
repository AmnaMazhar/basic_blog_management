<?php
    session_start();

    if(isset($_SESSION['user_info']) && $_SESSION['user_info']['role_id'] == 1)
    {
        header("location: admin/index.php");
    }
    elseif(isset($_SESSION['user_info']) && $_SESSION['user_info']['role_id'] == 2)
    {
        header("location: author/index.php");
    }    
    elseif(isset($_SESSION['user_info']) && $_SESSION['user_info']['role_id'] == 3)
    {
        header("location: user/index.php");
    }
?>