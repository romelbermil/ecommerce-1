<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    echo "<script>window.open('login.php?no logged in=You are logged in!','_self')</script>";
}  else {
?>
<!DOCTYPE>
<?php
include './include/dbconnect.php';
?>
<html>
    <head>
        <title>Admin Panel</title>
        <link rel="stylesheet" type="text/css" href="style/adminstyle.css"/>
    </head>
    <body>
        <div class="main_wrapper">
            <div id="header">
                <img src="adminimgs/adminlogo.png" width="500" height="100" style="float: left;"/>
                <img src="adminimgs/qwerty.jpg" width="500" height="100" style="float: right;"/>     
            </div>
            <div id="left_content">
                <div id="sidebar_title">Manage Content</div>
                <ul id="cats">
                    <li><a href="index.php?insert_product">Insert a Product</a></li>
                    <li><a href="index.php?view_products">View all Products</a></li>
                    <li><a href="index.php?insert_cat">Insert a Category</a></li>
                    <li><a href="index.php?view_cats">View all Categories</a></li>
                    <li><a href="index.php?insert_brand">Insert a Brand</a></li>
                    <li><a href="index.php?view_brands">View all Brands</a></li>
                    <li><a href="index.php?view_customers">View all Customers</a></li>
                    <li><a href="index.php?view_orders">View all Orders</a></li>
                    <li><a href="index.php?view_payments">View all Payments</a></li>
                    <li><a href="adminlogout.php">Admin Logout</a></li>
                </ul>
            </div>
            <div id="right_content">
                <div id="shopping_cart">
                    <span style="float: right; font-size: 15px; padding: 5px; line-height: 40px;"><i>Do some Administrator stuff here!!!</i></span>
                </div>
                <div id="main_thing">
                    <h2 style="text-align: center;"><?php echo @$_GET['logged_in'];?></h2>
                    <?php
                    if (isset($_GET['insert_product'])) {
                        include './insert_product.php';
                    }
                    ?>
                    <?php
                    if (isset($_GET['view_products'])) {
                        include './view_products.php';
                    }
                    ?>
                    <?php
                    if (isset($_GET['edit_pro'])) {
                        include './edit_pro.php';
                    }
                    ?>
                    <?php
                    if (isset($_GET['delete_pro'])) {
                        include './delete_pro.php';
                    }
                    ?>
                    <?php
                    if (isset($_GET['insert_cat'])) {
                        include './insert_cat.php';
                    }
                    ?>
                    <?php
                    if (isset($_GET['view_cats'])) {
                        include './view_cats.php';
                    }
                    ?>
                    <?php
                    if (isset($_GET['insert_brand'])) {
                        include './insert_brand.php';
                    }
                    ?>
                    <?php
                    if (isset($_GET['view_brands'])) {
                        include './view_brands.php';
                    }
                    ?>
                    <?php
                    if (isset($_GET['edit_cat'])) {
                        include './edit_cat.php';
                    }
                    ?>
                    <?php
                    if (isset($_GET['delete_cat'])) {
                        include './delete_cat.php';
                    }
                    ?>
                    <?php
                    if (isset($_GET['edit_brand'])) {
                        include './edit_brand.php';
                    }
                    ?>
                    <?php
                    if (isset($_GET['delete_brand'])) {
                        include './delete_brand.php';
                    }
                    ?>
                    <?php
                    if (isset($_GET['view_customers'])) {
                        include './view_customers.php';
                    }
                    ?>
                    <?php
                    if ($_GET['delete_c']) {
                        include './delete_c.php';
                    }
                    ?>
                </div>
                
            </div>
            <div id="footer">
                <h3 style="text-align: center; padding-top: 40px;">&copy; 2016 by www.aleosinc.com</h3>
            </div>
        </div>
    </body>
</html>
<?php } ?>

