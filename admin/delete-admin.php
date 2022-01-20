<?php

    include('../config/constants.php');
    // 1 get id of admin to be deleted
    $id = $_GET['id'];

    // 2 create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // execute the query
    $res = mysqli_query($conn,$sql);

    //check whether query executed or not
    if($res==TRUE)
    {
        //query executed succcessfullya and admin deleted
        // create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div> ";
        //redirect to manage admin
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // failed to delete admin
        // create session variable to display message
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin.</div> ";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    // 3 redirect to manage admin with messaage successful or not

?>