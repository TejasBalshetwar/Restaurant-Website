<?php include('partials/menu.php') ?>

<!-- main content section -->
<div class='main-content'>
    <div class='wrapper'>
        <h1>Manage Category</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);//we need to reset session variable so that the message is dislayed only once
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        ?><br><br>
        <!-- button to add Category -->
        <a href="add-category.php" class="btn-primary">Add Category</a>
        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>Sr no.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php 
                $sql = "SELECT * FROM tbl_category";

                $res = mysqli_query($conn,$sql);
                if($res==TRUE)
                {

                    $sn = 1;//declare variable and assing value 1

                    $count = mysqli_num_rows($res);
                    
                    if($count>0)
                    {
                        // we have data in database
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $image_name = $rows['image_name'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];

                            ?> 
                            <tr>
                                <td><?php echo $sn++?></td>
                                <td><?php echo $title?></td>
                                    <td>
                                        <?php 
                                            // check if image_name is present or not
                                            if(!$image_name=="")
                                            {
                                                // display image
                                                ?>
                                                <img src="<?php echo SITEURL;?>/images/category/<?php echo $image_name;?>" width=100px>
                                                <?php
                                            }
                                            else
                                            {
                                                // display message
                                                echo "<div class='error'>Image Not found</div>";
                                            }
                                        ?>
                                    </td>
                                    

                                    <td><?php echo $featured?></td>
                                    <td><?php echo $active?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-category.php? id=<?php echo $id;?>" class="btn-secondary">Update Category</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-category.php? id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                    else
                    {
                        // we dont have data in database

                        // we will display message in table
                        ?>
                        <tr>
                            <td colspan="6">
                                <div class="error">
                                    No Categories Present.
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
            }
            ?>
            
            
        </table>
    </div>
</div>
<?php include('partials/footer.php') ?>