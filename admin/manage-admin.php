<?php include('partials/menu.php')?>

        <!-- main content section -->
        <div class='main-content'>
            <div class='wrapper'>
                <h1>Manage Admin</h1>
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
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }
                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }
                ?>
                <br><br><br>
                <!-- button to add admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br>    
                <br>
                <table class="tbl-full">
                    <tr>
                        <th>Sr no.</th>
                        <th>Fullname</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    // Query to get all admin
                        $sql = "SELECT * FROM tbl_admin";
                        // Execute query
                        $res = mysqli_query($conn,$sql);
                        // check if query executed or not
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
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];

                                    // display values in table
                                    ?>
                                        <tr>
                                            <td><?php echo $sn++ ?></td>
                                            <td><?php echo $full_name ?></td>
                                            <td><?php echo $username ?></td>
                                            <td>
                                            <a href="<?php echo SITEURL;?>admin/update-password.php? id=<?php echo $id;?>" class="btn-primary">Change Passowrd</a>
                                            <a href="<?php echo SITEURL;?>admin/update-admin.php? id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL;?>admin/delete-admin.php? id=<?php echo $id;?>" class="btn-danger">Delete Admin</a> <!--obtaining value of id using get method instead of POST which was used in form-->

                                            </td>
                                         </tr>

                                    <?php
                                }
                            }
                            else{
                                // we dont have data in database
                            }
                        }
                    ?>
    
                </table>
                
            </div>

        </div>
<?php include('partials/footer.php')?>