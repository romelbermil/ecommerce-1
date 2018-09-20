<!DOCTYPE html>
<?php
session_start();
include '../functions/functions.php';
include '../admin/include/dbconnect.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css" media="all">
        <title>My Online Shop</title>
    </head>
    <body>
        <!--Main container starts here-->
        <div class="main_wrapper">
            <!--header starts here-->
            <div class="header_wrapper">
                <a href="../index.php"><img id="logo" src="../images/logo.png" /></a>
                <img id="banner" src="../images/qwerty.jpg"/>
            </div>
            <!--header ends here-->
            <!--menu starts here-->
            <div class="menubar">
                <ul id="menu">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../allproducts.php">All Products</a></li>
                    <li><a href="../customers/myaccount.php">My Account</a></li>
                    <li><a href="../cart.php">Shopping Cart</a></li>
                    <li><a href="../customer_register.php">Sign Up</a></li>
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
                <!--side bar starts here-->
                <div id="sidebar">
                    <div id="sidebar_title">My Account</div>
                    <ul id="cats">
                        <?php
                        $user=$_SESSION['customer_email'];
                        
                        $get_img="select * from customers where customer_email='$user'";
                        $run_img=  mysqli_query($conn, $get_img);
                        $row_img=  mysqli_fetch_array($run_img);
                        
                        $c_image=$row_img['customer_image'];
                        $c_name=$row_img['customer_name'];
                        
                        echo "<p style='text-align:center;'><img src='customer_images/$c_image' width='150' height='150'/></p>";
                        ?>
                        <li><a href="myaccount.php?my_orders">My Orders</a></li>
                        <li><a href="myaccount.php?edit_account">Edit Account</a></li>
                        <li><a href="myaccount.php?change_pass">Change Password</a></li>
                        <li><a href="myaccount.php?delete_account">Delete Account</a></li>
                        <li><a href="../logout.php">Logout</a></li>
                    </ul>
                </div>
                <!--side bar ends here-->
                <!--content area starts here-->
                <div id="content_area">
                    <?php cart(); ?>
                    <div id="shopping_cart">
                        <span style="float: right; font-size: 15px; padding: 5px; line-height: 40px;">
                            <?php
                            if (isset($_SESSION['customer_email'])) {
                                echo "<i>Welcome: </i>".$_SESSION['customer_email'];
                            }
                            ?>                            
                            <?php
                            if (!isset($_SESSION['customer_email'])) {
                                echo "<a href='../customer_login.php' style='color:yellow;'>Login</a>";
                            }  else {
                                echo "<a href='../logout.php' style='color:yellow;'>Logout</a>";
                            }
                            ?>
                        </span>
                    </div>
                    
                    <div id="products_box">
                        
                        <?php
                        if (!isset($_GET['my_orders'])) {
                            if (!isset($_GET['edit_account'])) {
                                if (!isset($_GET['change_pass'])) {
                                    if (!isset($_GET['delete_account'])) {
                                        echo "<h2 padding='10'>Welcome: $c_name</h2>
                                        <b>You can see your orders progress by clicking this <a href='myaccount.php?my_orders'>link</a></b>";
                                    }
                                }
                            }
                        }
                        ?>
                        <?php
                        if (isset($_GET['edit_account'])) {
                            include './edit_account.php';
                        }
                        ?>
                        <?php
                        if (isset($_GET['change_pass'])) {
                            include './change_pass.php';
                        }
                        ?>
                        <?php
                        if (isset($_GET['delete_account'])) {
                            include './delete_account.php';
                        }
                        ?>
                    </div>
                </div>
                <!--content area ends here-->     
            </div>
            <!--content ends here-->
            <!--footer starts here-->
            <div id="footer">
                <h3 style="text-align: center; padding-top: 45px;">&copy; 2016 by www.aleosinc.com </h3>
            </div>
            <!--footer ends here-->
        </div>
        <!--Main container ends here-->
    </body>
</html>


