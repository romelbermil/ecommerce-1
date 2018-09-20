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
                    <div id="shopping_cart">
                        <span style="float: right; font-size: 15px; padding: 5px; line-height: 40px;">
                            <?php
                            if (!isset($_SESSION['customer_email'])) {
                                echo "<i>Welcome Guest! </i>";
                            }  else {
                                echo "<i>Welcome: </i>".$_SESSION['customer_email']."<i style='color:yellow;'> Your </i>";
                            }
                            ?>
                            <i style="color: yellow">Cart-</i> Total Items:<?php totalItems();?> Total Price:<?php totalPrice();?> <a href="cart.php" style="color: yellow;">Go to Cart</a>
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
                        <?php
                        global $conn;

                        $get_pro = "select * from products";
                        $run_pro = mysqli_query($conn, $get_pro);

                        while ($row_pro = mysqli_fetch_array($run_pro)) {
                        $pro_id = $row_pro['product_id'];
                        $pro_cat = $row_pro['product_cat'];
                        $pro_brand = $row_pro['product_brand'];
                        $pro_title = $row_pro['product_title'];
                        $pro_price = $row_pro['product_price'];
                        $pro_image = $row_pro['product_image'];

                        echo "
                        <div id='single_product'> 
                            <h4>$pro_title</h4><img src='images/$pro_image' width='180' height='160'></img>
                            <p><b>$pro_price ksh</b></p>
                            <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                
                            <a href='index.php?pro_id=$pro_id'><button style='float:right;'>Add to Cart</button></a>
                        </div>";
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
