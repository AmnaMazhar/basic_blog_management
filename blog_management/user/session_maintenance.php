<?php
    session_start();
    
    if(isset($_SESSION['user_info']) && $_SESSION['user_info']['role_id'] != 3)
    {
        header("location: ../index.php");
    }
    elseif(!isset($_SESSION['user_info']))
    {
        header("location: ../index.php?msg=Please Login First&color=red");
    }
?>