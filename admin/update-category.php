<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <?php 

            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    $_SESSION["no-category-found"] = "<div class='error'>No Category Found</div>";
                    header("location:".SITEURL."admin/add-category.php");
                }
            }
            else
            {
                header("location:".SITEURL."admin/add-category.php");
            }
        ?>        
        <form action="" method="POST" enctype="multipart/form-data">
            <table class='tbl-30'>
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name='title' value="<?php echo $title?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td> 
                        <?php 
                            if($current_image!="")
                            {
                                //display image
                                ?>
                                <img src="<?php echo SITEURL;?>/images/category/<?php echo $current_image;?>" width=100px>
                                <?php
                            }
                            else
                            {
                                echo "<div class='error'>Image Not Added</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo 'checked';}?> type="radio" name='featured' value='Yes'>Yes
                        <input <?php if($featured=="No"){echo 'checked';}?> type="radio" name='featured' value='No'>No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo 'checked';}?> type="radio" name='active' value='Yes'>Yes
                        <input <?php if($active=="No"){echo 'checked';}?> type="radio" name='active' value='No'>No
                    </td>
                </tr>
                <tr>
                    <td colspan="2" >
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">

                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        
        <?php
            if(isset($_POST['submit']))
            {
                $title=$_POST['title'];
                $id=$_POST['id'];
                $current_image=$_POST['current_image'];
                $featured=$_POST['featured']; 
                $active=$_POST['active']; 
                
                // A. upload new image if selected
                
                // check if image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    if($image_name !="")
                    {
                        // upload new image
                        
                        $ext = end(explode('.',$image_name));
                        // rename image
                        $image_name = "Food_Category_".rand(000,999).'.'.$ext;
                        // u
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path="../images/category/".$image_name;
                        //upload image
                        $upload = move_uploaded_file($source_path,$destination_path);
                        
                        if($upload==FALSE)
                        {
                            $_SESSION['upload'] = "<div class='error '>Image Upload Unsuccessful</div> ";
                            header("location:".SITEURL."admin/manage-category.php");
                            // stop the process 
                            die();
                        }
                        //B  delete the current image
                        if($current_image !='')
                        {
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);
                            // if failed to delete image
                            if($remove==FALSE)
                            {
                                // set the session message
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to Delete Current Image.</div>";
                                // redirect to manage-category page
                                header('location:'.SITEURL.'admin/manage-Category.php');
                                die();
                            }
                        }
                        
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                // update the database
                $sql2 = "UPDATE tbl_category SET 
                title='$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id=$id";

                $res= mysqli_query($conn,$sql2);
                // redirect
                if($res==TRUE)
                {
                    $_SESSION['update']="<div class='success'>Category Updated Successfully<?div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Failed to Update Category</div> ";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        ?>

        
    </div>  
</div>


<?php include('partials/footer.php')?>