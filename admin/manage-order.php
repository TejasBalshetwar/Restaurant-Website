<?php include('partials/menu.php')?>

        <!-- main content section -->
        <div class='main-content'>
            <div class='wrapper'>
                <h1>Manage Order</h1>
                <br>    
                <br>
                <?php
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                ?>
                <br>
                <table class="tbl-full">
                    <tr>
                        <th>Sr.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    <?php

                        // get all order 
                        // display latest order first
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                        $res =mysqli_query($conn,$sql);
                        $count = mysqli_num_rows($res);
                        if($count>0)
                        {
                            $sr=1;
                            // order available
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $quantity = $row['quantity'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name=$row['customer_name'];
                                $customer_contact=$row['customer_contact'];
                                $customer_email=$row['customer_email'];
                                $customer_address=$row['customer_address'];

                                ?>
                                <tr>
                                    <td><?php echo $sr++;?></td>
                                    <td><?php echo $food;?></td>
                                    <td>₹ <?php echo $price;?></td>
                                    <td><?php echo $quantity;?></td>
                                    <td>₹ <?php echo $total;?></td>
                                    <td><?php echo $order_date;?></td>

                                    <td>
                                        <?php
                                        if($status=="Ordered"){
                                            echo "<label> $status</label>";
                                        }
                                        if($status=="On Delivery"){
                                            echo "<label style='color:orange;'> $status</label>";
                                        }
                                        if($status=="Delivered"){
                                            echo "<label style='color:#40F00B;'> $status</label>";
                                        }
                                        if($status=="Cancelled"){
                                            echo "<label style='color:red;'> $status</label>";
                                        }
                                        
                                        ?>
                                    </td>
                                    
                                    <td><?php echo $customer_name;?></td>
                                    <td><?php echo $customer_contact;?></td>
                                    <td><?php echo $customer_email;?></td>
                                    <td><?php echo $customer_address;?></td>
                                    
                                    
                                    <td>
                                    <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id?>" class="btn-secondary">Update</a>
                                    </td>
                                </tr>
                                
                                <?php
                            }

                        }
                        else
                        {
                            // order not available
                            echo "<tr><td colspan='12' class='error' colspan='11'>Orders  Not  Available</td></tr>";
                        }
                    ?>
                    
                    
                </table>
                
            </div>

        </div>
<?php include('partials/footer.php')?>