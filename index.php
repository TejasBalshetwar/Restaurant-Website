<?php include('partials-front/menu.php');?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>/food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <br><br>
    <?php 
    
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }

    ?>
    <br>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                // create sql query to display categories
                $sql = "SELECT * FROM tbl_category WHERE active='yes' AND featured ='yes' LIMIT 3";
                $res = mysqli_query($conn,$sql);
                
                $count = mysqli_num_rows($res);
                if($count>0)
                {
                    // categories available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $title = $row['title'];
                        $id = $row['id'];
                        $image_name= $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id?>">
                        <div class="box-3 float-container">
                            <?php 
                                if($image_name=="")
                                {
                                    echo "<div class='error'>Image Not Available</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL;?>/images/category/<?php echo $image_name?>" style="width:300px; height:300px; " class="img-curve">
                                    <?php
                                }
                            ?>
                            

                            <h3 class="float-text text-white"><?php echo $title?></h3>
                        </div>
                        </a>

                        <?php
                    }
                }  
                else
                {
                    echo "<div class='error'>Categories Not Added</div>";
                }
            ?>
            


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php
                
                $sql ="SELECT * FROM tbl_food WHERE featured='Yes' AND active='Yes' LIMIT 6";
                $res = mysqli_query($conn,$sql);
                $count= mysqli_num_rows($res);  
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

        <p class="text-center">
            <a href="<?php echo SITEURL;?>/foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>    

