<?php include('partials/menu.php')?>

        <!-- main content section -->
        <div class='main-content'>
            <div class='wrapper'>
                <h1>Manage Food</h1>
                <br><br>
                <!-- button to add admin -->
                <a href="add-food.php" class="btn-primary">Add Food</a>
                <br><br>
                <?php 
                    if(isset($_SESSION['add']))// checking whether SESSION is set or not
                    {
                        echo $_SESSION['add'];//Display the message if set
                        unset($_SESSION['add']);//Remove Session message
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
                    if(isset($_SESSION['unauthorize']))
                    {
                    echo $_SESSION['unauthorize'];
                    unset($_SESSION['unauthorize']);
                    }
                    if(isset($_SESSION['no-food-found']))
                    {
                        echo $_SESSION['no-food-found'];
                        unset($_SESSION['no-food-found']);
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
                    ?>
                    <br><br>
                    <?php 
                ?>
                
                <table class="tbl-full">
                <tr>
                <th>Sr no.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Price</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
                </tr>
                <?php
                    // sql query to get all data from database
                    $sql = "SELECT * FROM tbl_food";
                    $res = mysqli_query($conn,$sql);
                    if($res==TRUE)
                    {
                        $sn = 1;//declare variable and assing value 1

                        // count number of rows
                        $count = mysqli_num_rows($res); //function to get all rows in database
                        // check number of rows
                        if($count>0)
                        {
                            // we have data in database
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                // using while loop to get data from database
                                // get individual data
                                $id = $rows['id'];
                                $title = $rows['title'];
                                $description = $rows['description'];
                                $price = $rows['price'];
                                $image_name = $rows['image_name'];
                                $category_id = $rows['category_id'];
                                $featured = $rows['featured'];
                                $active = $rows['active'];


                                // display values in table
                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>

                                        <td>
                                        <?php 
                                            // check if image_name is present or not
                                            if(!$image_name=="")
                                            {
                                                // display image
                                                ?>
                                                <img src="<?php echo SITEURL;?>/images/food/<?php echo $image_name;?>" width=100px>
                                                <?php
                                            }
                                            else
                                            {
                                                // display message
                                                echo "<div class='error'>Image Not found</div>";
                                            }
                                        ?>
                                        </td>
                                        <td>₹ <?php echo $price;?></td>
                                        <td><?php echo $featured?></td>
                                        <td><?php echo $active?></td>
                                        <td>
                                        <a href="<?php echo SITEURL;?>admin/update-food.php? id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-food.php? id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
                                    </td>
                                     </tr>

                                <?php
                            }
                        }
                        else{
                            // we dont have data in database
                            ?>
                        <tr>
                            <td colspan="6">
                                <div class="error">
                                Food Not Added Yet.
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
<?php include('partials/footer.php')?>