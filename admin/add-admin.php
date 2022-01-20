<?php include('partials/menu.php')?>

    <div class='main-content'>
        <div class="wrapper">
            <h1>Add Admin</h1>
                <br><br>
                <?php 
                    if(isset($_SESSION['add']))// checking whether SESSION is set or not
                    {
                        echo $_SESSION['add'];//Display the message if set
                        unset($_SESSION['add']);//Remove Session message
                    }
                ?>
            <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter Your Username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter Password"></td>
                </tr>

                <tr>
                    <td colspan="2" >
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>



<?php include('partials/footer.php')?>

<?php
// Process value from form and save it in database

// check whether the submit button is clicked or not
   if(isset($_POST['submit'])) 
    {
        // button clicked
        // 1.Getting data from form
        $fullname=$_POST['full_name'];
        $username=$_POST['username'];
        $password=md5($_POST['password']);   // password encrytpion using MD5

        // 2.SQL query to save data into database
        $sql = "INSERT INTO tbl_admin SET
        full_name = '$fullname', 
        username = '$username', 
        password = '$password' ";

        // 3. execute query and store data into database

        $res = mysqli_query($conn,$sql); //tells if operation was successful or not
        
        // check whether data is inserted or not and display appropriate message

        if($res==TRUE)
        {
            // echo'Data inserted';
            //create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
            //redirect page
            header('location:'.SITEURL.'admin/manage-admin.php');

        }
        else
        {
            // echo 'Data not inserted';
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
            //redirect page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
    
?>