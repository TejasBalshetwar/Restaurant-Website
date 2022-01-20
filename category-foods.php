<?php include('partials-front/menu.php');?>

<?php 
    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];

        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        $res = mysqli_query($conn,$sql);

        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    }
    else
    {
        // id not passed
        header('location:'.SITEURL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql = "SELECT * FROM tbl_food WHERE category_id=$category_id ";
                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);
                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'>Image Not Found</div>";
                                    }
                                    else
                                    {
                                        ?>
                                         <img src="<?php echo SITEURL;?>/images/food/<?php echo $image_name?>" style="width:180px; height:180px; " class="img-curve">
                                        <?php
                                    }
                                ?>
                               
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">₹ <?php echo $price;?></p>
                                <p class="food-detail">
                                    <?php echo $description;?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Food Not Available</div>";
                }
            ?>

            
            <div class="clearfix"></div>

            

        </div>

    </section>
    <?php include('partials-front/footer.php');?>

