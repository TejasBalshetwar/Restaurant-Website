<?php include('../config/constants.php')?>
<?php 
    // destroy session
    session_destroy();// unsets $_SESSION['user']
    // redirect to login
    header('location:'.SITEURL.'admin/login.php');
?>