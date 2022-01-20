<?php include('partials-front/menu.php'); ?>

<?php
if (isset($_GET['food_id'])) {

    $food_id = $_GET['food_id'];
    // get details of food

    $sql = "SELECT * FROM tbl_food WHERE id =$food_id ";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        // print_r($row);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        // redirect to homepage
        header('location:' . SITEURL);
    }
} else {
    header('location:' . SITEURL);
}

?>
<?php

if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}

?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" class="order" method="POST">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    if ($image_name == "") {
                        //image not available
                        echo "<div class='error'>Image Not found</div>";
                    } else {
                    ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" style="width:120px; height:120px;" class="img-curve">
                    <?php
                    }
                    ?>

                </div>


                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value=<?php echo $title; ?>>
                    <p class="food-price">₹ <?php echo $price ?></p>
                    <input type="hidden" name="price" value=<?php echo $price; ?>>


                    <div class="order-label">Quantity</div>
                    <input type="number" name="quantity" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Chandler Bing" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9988998899" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. xyz@gmail.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>
        <?php 
        
            // check whether submit clicked

            if(isset($_POST['submit']))
            {
                // get all details
                $food=$_POST['food'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];
                $total= $price * $quantity;
                $order_date = date('Y-m-d h:i:sa');

                $status= "Ordered";// Ordered, On Delivery, Delivered, Cancelled

                $customer_name=$_POST['full-name'];
                $customer_contact=$_POST['contact'];
                $customer_email=$_POST['email'];
                $customer_address=$_POST['address'];


                // save order in database

                $sql2 = "INSERT INTO tbl_order SET
                    food = '$food',
                    price = '$price',
                    quantity = $quantity,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                ";

                

                $res2 = mysqli_query($conn,$sql2);
                if($res2==TRUE)
                {
                    // query executed
                    $_SESSION['order'] = "<div class='success text-center' >Order Placed Successfully</div>";
                    header('location:' . SITEURL);
                }
                else{
                    // failed to save order
                    $_SESSION['order'] = "<div class='error text-center'>Failed to place Order</div>";
                    header('location:' . SITEURL);
                }
            }
        ?>


    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<?php include('partials-front/footer.php'); ?>

