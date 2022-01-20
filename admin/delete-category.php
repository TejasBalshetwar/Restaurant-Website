<?php

    include('../config/constants.php');
    // check whether the id or image name are set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
    // 1 get id of category to be deleted
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // remove physical image file if available
    
    if($image_name != "")
    {
        // image available
        $path = "../images/category/".$image_name;
        // remove image
        $remove = unlink($path);
        // if failed to delete image
        if($remove==FALSE)
        {
            // set the session message
            $_SESSION['remove'] = "<div class='error'>Failed to Delete Category Image.</div>";
            // redirect to manage-category page
            header('location:'.SITEURL.'admin/manage-Category.php');
            die();
        }
    }
   
   
   
    //  create sql query to delete category
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    // execute the query
    $res = mysqli_query($conn,$sql);

    //check whether query executed or not
    if($res==TRUE)
    {
        //query executed succcessfully and category deleted
        // create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div> ";
    // 3 redirect to manage category with messaage successful or not
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        // failed to delete category
        // create session variable to display message
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div> ";
        header('location:'.SITEURL.'admin/manage-Category.php');
    }
    }
    else
    {
        //redirect 
        $_SESSION['delete'] = "<div class='error'>Unauthorized Access</div> ";
        header('location:'.SITEURL.'admin/manage-Category.php');
    }



?>