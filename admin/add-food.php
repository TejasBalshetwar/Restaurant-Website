<?php include('partials/menu.php') ?>

<div class='main-content'>
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
        if (isset($_SESSION['add'])) // checking whether SESSION is set or not
        {
            echo $_SESSION['add']; //Display the message if set
            unset($_SESSION['add']); //Remove Session message
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']); //we need to reset session variable so that the message is dislayed only once
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Enter Food Title"></td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td><textarea cols='30' rows='5' name="description" placeholder="Enter Description"></textarea>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price"></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            // create php code to display categories from database
                            // 1. create sql query to get all active catgories from database

                            // 2. Display on dropdown menu

                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            // if count is greater than 0 then we have data in database else we dont have any catgories
                            if ($count > 0) {
                                // we have categories
                                while ($row = mysqli_fetch_assoc($res)) {
                                    // get the details of catgories
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                <?php
                                }
                            } else {
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
                        <input type="radio" name='featured' value='Yes'>Yes
                        <input type="radio" name='featured' value='No'>No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name='active' value='Yes'>Yes
                        <input type="radio" name='active' value='No'>No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>

                </tr>

            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>
<?php

    if (isset($_POST['submit']))
    {
        // 1. get data
        $title = $_POST['title'];
        $description = $_POST['description']; 
        $price = $_POST['price']; 
        $category_id = $_POST['category'];

        
        // for radio input type we need to check of button is selected or not
        if (isset($_POST['featured'])) 
        {
        $featured = $_POST['featured'];
        } 
        else 
        {
        $featured = "No";
        }
        if (isset($_POST['active'])) 
        {
        $active = $_POST['active'];
        } 
        else 
        {
            $active = "No";
        }
        
        // 2. upload image if selected

        if(isset($_FILES['image']['name']))
        {
            $image_name = $_FILES['image']['name'];

            if($image_name!="")
            {
                // image is selected
                // rename image
                // upload image
                $ext = end(explode('.',$image_name));

                // create new name

                $image_name = "Food_Name_".rand(000,999).'.'.$ext;

                // upload image

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/food/" . $image_name;

                $upload = move_uploaded_file($source_path, $destination_path);


                if($upload==FALSE)
                {
                    $_SESSION['upload']="<div class='error'>Failed to upload Image</div>";
                    header('location:'.SITEURL.'admin/add-food.php');
                    die();
                }
            }

        }
        else
        {
            $image_name = "";
        }

        // 3. insert into database
        $sql3 = "INSERT INTO tbl_food SET title='$title',description ='$description',price = $price,image_name = '$image_name',category_id=$category_id,featured='$featured',active = '$active'";

        $res3 = mysqli_query($conn,$sql3);
        // 4. Redirect
        if($res3==TRUE)
        {
            // data inserted 
            $_SESSION['add']="<div class='success'>Food Added Successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            // data not inserted
            $_SESSION['add']="<div class='error'>Failed to Add Food</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        
    }
?>