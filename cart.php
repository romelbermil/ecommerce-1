<!DOCTYPE html>
<?php
session_start();
include './functions/functions.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="styles/style.css" media="all">
        <title>My Online Shop</title>
    </head>
    <body>
        <!--Main container starts here-->
        <div class="main_wrapper">
            <!--header starts here-->
            <div class="header_wrapper">
                <a href="index.php"><img id="logo" src="images/logo.png" /></a>
                <img id="banner" src="images/qwerty.jpg"/>
            </div>
            <!--header ends here-->
            <!--menu starts here-->
            <div class="menubar">
                <ul id="menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="allproducts.php">All Products</a></li>
                    <li><a href="customers/myaccount.php">My Account</a></li>
                    <li><a href="cart.php">Shopping Cart</a></li>
                    <li><a href="customer_register.php">Sign Up</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
                <div id="form">
                    <form method="get" action="results.php" enctype="multipart/form-data">
                        <input type="text" name="user_query" placeholder="Search for a product"/>
                        <input type="submit" name="search" value="Search"/>
                    </form>
                </div>
            </div>
            <!--menu ends here-->
            <!--content starts here-->
            <div class="content_wrapper">
                <!--content area starts here-->
                <div id="content_area">
                    <?php cart(); ?>
                    <div id="shopping_cart">
                        <span style="float: right; font-size: 15px; padding: 5px; line-height: 40px;">
                            <?php
                            if (!isset($_SESSION['customer_email'])) {
                                echo "<i>Welcome Guest! </i>";
                            }  else {
                                echo "<i>Welcome: </i>".$_SESSION['customer_email']."<i style='color:yellow;'> Your </i>";
                            }
                            ?>
                            <i style="color: yellow">Cart-</i> Total Items:<?php totalItems();?> Total Price:<?php totalPrice();?> <a href="index.php" style="color: yellow;">Back to Shop</a>
                            <?php
                            if (!isset($_SESSION['customer_email'])) {
                                echo "<a href='customer_login.php' style='color:yellow;'>Login</a>";
                            }  else {
                                echo "<a href='logout.php' style='color:yellow;'>Logout</a>";
                            }
                            ?>
                        </span>
                    </div>
                    
                    <div id="products_box">
                        <form action="" method="post" enctype="multipart/form-data">
                            <table align="center" width="700" bgcolor="green">
                                <tr align="center" bgcolor="skyblue" style="text-align: center;">
                                    <th>Select</th>
                                    <th>Product(s)</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                                <?php
                                global $conn;
    
                                $total=0;
    
                                $ip=  getIp();
                                $sel_price="select * from cart where ip_add='$ip'";
                                $run_price=  mysqli_query($conn, $sel_price);
    
                                while ($p_price = mysqli_fetch_array($run_price)) {
                                    $pro_id=$p_price['p_id'];
        
                                    $pro_price="select * from products where product_id='$pro_id'";
                                    $run_pro_price=  mysqli_query($conn, $pro_price);
        
                                    while ($pp_price = mysqli_fetch_array($run_pro_price)) {
                                        $product_price=array($pp_price['product_price']);
                                        $product_title=$pp_price['product_title'];
                                        $product_image=$pp_price['product_image'];
                                        $single_price=$pp_price['product_price'];
                                        $values=  array_sum($product_price);
                                        $total+=$values;

                                ?>
                                <tr align="center" bgcolor="wheat">
                                    <td><input type="checkbox" name="select[]" value="<?php echo $pro_id; ?>"/></td>
                                    <td><?php echo $product_title; ?><br>
                                        <img src="images/<?php echo $product_image; ?>" width="60" height="60"/></td>
                                    <td><input type="text" size="4" name="qty" value="<?php $_SESSION['qty']; ?>"/></td>
                                    <?php
                                    if (isset($_POST['update_cart'])) {
                                        $qty=$_POST['qty'];
                                        if(!$qty==0){
                                        $update_qty="update cart set qty='$qty'";
                                        $run_qty=  mysqli_query($conn, $update_qty);
                                        
                                        $_SESSION['qty']=$qty;
                                        $single_price=$single_price*$qty;
                                        $values=  array_sum($product_price);
                                        $total+=$values;
                                        }
                                    }
                                    ?>
                                    <td><?php echo $single_price." ksh"; ?></td>
                                </tr>
                                
                                <?php } } ?>
                                <tr align="right">
                                    <td colspan="4"><b>Sub Total:</b></td>
                                    <td colspan="4"><?php echo $total."ksh"; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><input type="submit" name="update_cart" value="Update Cart"/></td>
                                    <td><input type="submit" name="remove" value="Remove Item"/></td>
                                    <td><input type="submit" name="continue" value="Continue Shopping"/></td>
                                    <td><button><a href="customer_login.php" style="text-decoration: none; color: black;">Check Out</a></button></td>
                                </tr>
                            </table>
                        </form>
                        <?php
                            global $conn;
                            $ip=  getIp();
                            if (isset($_POST['remove'])) {
                                foreach ($_POST['select'] as $remove_id) {
                                    $delete_product="delete from cart where p_id='$remove_id' AND ip_add='$ip'";
                                    $run_delete=  mysqli_query($conn, $delete_product);
                                
                                    if ($run_delete) {
                                        echo "<script>window.open('cart.php','_self')</script>";
                                    }
                                }
                            }
                            if (isset($_POST['continue'])) {
                                echo "<script>window.open('index.php','_self')</script>";
                            }
                        ?>
                    </div>
                </div>
                <!--content area ends here-->
                <!--side bar starts here-->
                <div id="sidebar">
                    <div id="sidebar_title">Categories</div>
                    <ul id="cats">
                        <?php getCats(); ?>
                    </ul>
                    <div id="sidebar_title">Brands</div>
                    <ul id="cats">
                        <?php getBrands(); ?>
                    </ul>
                </div>
                <!--side bar ends here-->
            </div>
            <!--content ends here-->
            <!--footer starts here-->
            <div id="footer">
                <h3 style="text-align: center; padding-top: 45px;">&copy; 2016 by www.aleosinc.com </h3>
            </div>
            <!--footer ends here-->
        </div>
        <!--Main container ends here-->
        <?php
        // put your code here
        ?>
    </body>
</html>
