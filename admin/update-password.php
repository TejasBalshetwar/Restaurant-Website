<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        // get id of selected admin
            $id=$_GET['id'];

        ?>
        <form action="" method="POST">
            
            <table class="tbl-30">

                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Passowrd">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Passowrd">
                    </td>
                </tr>
                <tr>
                    <td>Confirm New Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm New Passowrd">
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                    
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    // check whether the submit button is clicked or not
   if(isset($_POST['submit'])) 
   {
       // get data from form
        
       $id = $_POST['id'];
       $current_password = md5($_POST['current_password']);
       $new_password = md5($_POST['new_password']);
       $confirm_password = md5($_POST['confirm_password']);
       
       // check whether user with current id and password exist
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        //execute query
        $res = mysqli_query($conn,$sql);

        if($res==TRUE)
        {
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                // user exists and password can be changed
                // check whether new password and confirm new password match or not
                if($new_password==$confirm_password)
                {
                    //change password
                    $sql2 = "UPDATE tbl_admin SET password ='$new_password' WHERE id=$id";
                    //execute query
                    $res = mysqli_query($conn,$sql2);
                    if($res==TRUE)
                    {
                        $_SESSION['change-pwd'] = "<div class='success'> Password Changed Successfully</div> ";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password </div> ";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    // redirect ot manage admin
                    $_SESSION['pwd-not-match']="<div class='error'> Password Did Not Match</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                // user does not exist set message and redirect
                $_SESSION['user-not-found']="<div class='error'> User Not Found</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');

            }
        }
       
       

       
       // change password
   }

?> 
<?php include('partials/footer.php')?>