<!DOCTYPE>
<?php
session_start();
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
                    <li><a href="login.php?insert_product">Insert a Product</a></li>
                    <li><a href="login.php?view_products">View all Products</a></li>
                    <li><a href="login.php?insert_cat">Insert a Category</a></li>
                    <li><a href="login.php?view_cats">View all Categories</a></li>
                    <li><a href="login.php?insert_brand">Insert a Brand</a></li>
                    <li><a href="login.php?view_brands">View all Brands</a></li>
                    <li><a href="login.php?view_customers">View all Customers</a></li>
                    <li><a href="login.php?view_orders">View all Orders</a></li>
                    <li><a href="login.php?view_payments">View all Payments</a></li>
                    <li><a href="login.php">Admin Logout</a></li>
                </ul>
            </div>
            <div id="right_content">
                <div id="shopping_cart">
                    <span style="float: right; font-size: 15px; padding: 5px; line-height: 40px;"><i>Do some Administrator stuff here!!!</i></span>
                </div>
                <div id="main_thing">
                    <form method="post" action="">
                        <table width="670"  bgcolor="green">
                            <tr align="center">
                                <td colspan="3"><h2>Admin Login</h2></td>
                            </tr>
                            <tr align="center">
                                <td><input type="text" name="email" placeholder="Email" required="required"/></td>
                            </tr>
                            <tr align="center">
                                <td><input type="password" name="pass" placeholder="Password" required="required"/></td>
                            </tr>
                            <tr align="center">
                                <td colspan="4"><input type="submit" name="login" value="Login"/></td>
                            </tr>
                        </table>
                    </form>
                </div>
                
            </div>
            <div id="footer">
                <h3 style="text-align: center; padding-top: 40px;">&copy; 2016 by www.aleosinc.com</h3>
            </div>
        </div>
    </body>
</html>
<?php
if (isset($_POST['login'])) {
    $u_email=  $_POST['email'];
    $u_pass=  $_POST['pass'];

    $sel_details="select * from admins where user_email='$u_email' AND user_pass='$u_pass'";
    $run_details=  mysqli_query($conn, $sel_details);
    echo $check_details=  mysqli_num_rows($run_details);

    if ($check_details==0) {
        echo "<script>alert('Incorrect Email or Password!')</script>";
        echo "<script>window.open('login.php','_self')</script>";
        exit();
    }  else {
        $_SESSION['user_email']=$u_email;
        echo "<script>window.open('index.php?logged_in=You have successfuly logged in...','_self')</script>";
    }
}
?>



