<?php include('partials/menu.php')?>
<?php 

        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
            $res2 = mysqli_query($conn,$sql2);
            $count = mysqli_num_rows($res2);
            if($count==1)
            {
                $row2 = mysqli_fetch_assoc($res2);
                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $current_image = $row2['image_name'];
                $current_category = $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];
            }
            else
            {
                $_SESSION["no-food-found"] = "<div class='error'>No Food Found</div>";
                header("location:".SITEURL."admin/add-food.php");
            }
            }
            else
            {
                header("location:".SITEURL."admin/manage-food.php");
            }
        ?> 
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
               
        <form action="" method="POST" enctype="multipart/form-data">
            <table class='tbl-30'>
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name='title' value="<?php echo $title?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea cols='30' rows='5' name="description" ><?php echo $description;?></textarea>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" value="<?php echo $price;?>"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td> 
                        <?php 
                            if($current_image!="")
                            {
                                //display image
                                ?>
                                <img src="<?php echo SITEURL;?>/images/food/<?php echo $current_image;?>" width=100px>
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
                    <td>Select New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" value="<?php echo $current_category;?>">
                            <?php
                            // create php code to display categories from database
                            // 1. create sql query to get all active catgories from database

                            // 2. Display on dropdown menu

                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            // if count is greater than 0 then we have data in database else we dont have any catgories
                            if ($count > 0) 
                            {
                                // we have categories
                                while ($row = mysqli_fetch_assoc($res)) 
                                {
                                    // get the details of catgories
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                                ?>
                                    <option <?php if($category_id==$current_category){echo 'selected';}?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                <?php
                                }
                            }
                             else 
                            {
                                // we dont have categories
                                ?>
                                <option value="0">No Category Found</option>

                            <?php
                            }

                            ?>
                        </select>
                    </td>
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
                $description=$_POST['description'];
                $price=$_POST['price'];
                $current_image=$_POST['current_image'];
                $category_id=$_POST['category'];
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
                        $destination_path="../images/food/".$image_name;
                        //upload image
                        $upload = move_uploaded_file($source_path,$destination_path);
                        
                        if($upload==FALSE)
                        {
                            $_SESSION['upload'] = "<div class='error '>Image Upload Unsuccessful</div> ";
                            header("location:".SITEURL."admin/manage-food.php");
                            // stop the process 
                            die();
                        }
                        //B  delete the current image
                        if($current_image !='')
                        {
                            $remove_path = "../images/food/".$current_image;
                            $remove = unlink($remove_path);
                            // if failed to delete image
                            if($remove==FALSE)
                            {
                                // set the session message
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to Delete Current Image.</div>";
                                // redirect to manage-category page
                                header('location:'.SITEURL.'admin/manage-food.php');
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
                $sql3 = "UPDATE tbl_food SET title='$title',description ='$description',price = $price,image_name = '$image_name',category_id=$category_id,featured='$featured',active = '$active'";

                $res3= mysqli_query($conn,$sql3);
                // redirect
                if($res3==TRUE)
                {
                    $_SESSION['update']="<div class='success'>Food Updated Successfully<?div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food</div> ";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
        ?>

        
    </div>  
</div>


<?php include('partials/footer.php')?>