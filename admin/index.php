<?php include('partials/menu.php')?>
        <!-- main content section -->
        <div class='main-content'>
            <div class='wrapper'>
                <h1>Dashboard</h1>

                <br>    
                <?php
                if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br>
                
                <div class="col-4 text-center">
                    <?php 
                        $sql = "SELECT * FROM tbl_category";
                        $res = mysqli_query($conn,$sql);
                        $count = mysqli_num_rows($res);

                    ?>
                    <h1><?php echo $count;?></h1> <br>
                    Categories
                </div>

                <div class="col-4 text-center">
                <?php 
                        $sql = "SELECT * FROM tbl_food";
                        $res = mysqli_query($conn,$sql);
                        $count = mysqli_num_rows($res);

                    ?>
                    <h1><?php echo $count;?></h1> <br>
                    Foods
                </div>

                <div class="col-4 text-center">
                    <?php 
                        $sql = "SELECT * FROM tbl_order";
                        $res = mysqli_query($conn,$sql);
                        $count = mysqli_num_rows($res);

                    ?>
                    <h1><?php echo $count;?></h1> <br>
                    Orders
                </div>
                <div class="col-4 text-center">
                    <?php 
                    // get total revenue using aggregate function in SQL
                        $sql = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
                        $res = mysqli_query($conn,$sql);
                        $row =mysqli_fetch_assoc($res);

                        // get total
                        $revenue_generated = $row['Total'];
                    ?>
                    <h1>₹ <?php echo $revenue_generated;?></h1> <br>
                    Revenue Generated
                </div>
                <div class="clearfix"></div>
            </div>

        </div>
<?php include('partials/footer.php')?>