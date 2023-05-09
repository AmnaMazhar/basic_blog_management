<?php
    mysqli_report(MYSQLI_REPORT_OFF);
    $connect = mysqli_connect("localhost", "root", "", "blog_management");
    
    if(mysqli_connect_errno())
    {
        echo "Connection failed due to Error msg: ".mysqli_connect_error()." and Error No ".mysqli_connect_errno();
        die();
    } 
    // echo "connected";   
?>