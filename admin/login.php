<?php include('../config/constants.php')?>
<html>
    <head>
        <title>Login- Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>

        <div class="login">
            <h1 class='text-center'>Login</h1>
            <br><br>    
            <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
            ?>
            <br><br>
            <form action="" method="POST" class='text-center'>

                Username: <br> 
                <input type="text" name='username' placeholder='Enter Username'>
                <br> <br>
                Password:<br>
                <input type="password" name='password' placeholder='Enter Password'>
                <br> <br>
                <input type="submit" name='submit' value='login' class='btn-primary'>
            </form>
            <br><br>
            <p class='text-center'>Created by- <a href="" >Tejas Balshetwar</a> </p>
        </div>

    </body>
</html>

<?php
    // check whether the submit button is clicked or not
   if(isset($_POST['submit'])) 
   {
       // process for login
       // 1 get data from login form
       $username = $_POST['username'];
       $password = md5($_POST['password']);

    //    2. sql query to check whether user with username and passwords exist or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' ";

        //execute query
        $res = mysqli_query($conn,$sql);
        
        //if count=1 then user exists
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            // user available and login success
            $_SESSION['login'] = "<div class='success'> Login Successful </div>";
            $_SESSION['user'] = $username;// to check whether user is logged in nor not and logout will unset it

            header('location:'.SITEURL.'admin/');
        }
        else
        {
            // user not available
            $_SESSION['login'] = "<div class='error text-center'> Login Failed </div>";
            header('location:'.SITEURL.'admin/login.php');
        }
        
   }
?>