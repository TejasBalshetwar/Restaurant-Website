<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>
        <?php 
        
        if(isset($_GET['id']))
        {
            // get details
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_order WHERE id=$id";
            $res = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                $row= mysqli_fetch_assoc($res);
                $food= $row['food'];
                $price = $row['price'];
                $quantity= $row['quantity'];
                $status= $row['status'];
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        }
        else
        {
            // redirect to manage order
            header('location:'.SITEURL.'admin/manage-order.php');
        }
        ?>
        <form action="" method="POST">
            <table class='tbl-30'>

            <tr>
                <td>Food Name:</td>
                <td><b><?php echo $food;?></b></td>
            </tr>
            <tr>
            <tr>
                <td>Price:</td>
                <td><b>₹<?php echo $price;?></b></td>
            </tr>
            <tr>
                <td>Quantity:</td>
                <td>
                    <input type="number" name='quantity' value='<?php echo $quantity;?>' style='border-radius:7px;'>
                </td>
            </tr>
            <tr>
                <td>Status:</td>
                <td>
                    <select name="status" >
                        <option <?php if($status=="Ordered"){echo 'selected';} ?> value="Ordered" >Ordered</option>
                        <option <?php if($status=="On Delivery"){echo 'selected';} ?> value="On Delivery">On Delivery</option>
                        <option <?php if($status=="Delivered"){echo 'selected';} ?> value="Delivered">Delivered</option>
                        <option <?php if($status=="Cancelled"){echo 'selected';} ?> value="Cancelled">Cancelled</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan='2'>
                    <input type="hidden" name='id' value="<?php echo $id;?>">
                    <input type="hidden" name='price' value="<?php echo $price;?>">
                    <input type="submit" name='submit' value='Update Order' class='btn-secondary'>
                </td>
            </tr>
            </table>
        </form>
        <?php
        
        if(isset($_POST['submit']))
        {
            // get all values from form
            $id=$_POST['id'];
            $price=$_POST['price'];
            $quantity=$_POST['quantity'];
            $status=$_POST['status'];
            $total = $quantity*$price;
            $sql2 = "UPDATE tbl_order SET
            quantity=$quantity,
            total=$total,
            status='$status'
            WHERE id=$id";
            $res2 = mysqli_query($conn,$sql2);
            if($res==TRUE)
            {
                // order updated successfully
                $_SESSION['update']="<div class='success'>Order Updated Successfully</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }
            else
            {
                // failed to update order
                $_SESSION['update']="<div class='error'>Failed to Update Order</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>
