<!DOCTYPE html>
<?php
session_start();
include './admin/include/dbconnect.php';
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
                        <form method="post" action="customer_register.php" enctype="multipart/form-data">
                            <table align="center" width="670" bgcolor="green">
                                <tr align="center">
                                    <td colspan="2"><h2>Create your Account</h2></td>
                                </tr>
                                <tr>
                                    <td align="right"><b>Name:</b></td>
                                    <td align="left"><input type="text" name="c_name" size="30"/></td>
                                </tr>
                                <tr>
                                    <td align="right"><b>Email:</b></td>
                                    <td align="left"><input type="text" name="c_email" size="30"/></td>
                                </tr>
                                <tr>
                                    <td align="right"><b>Password:</b></td>
                                    <td align="left"><input type="password" name="c_pass" size="30"/></td>
                                </tr>
                                <tr>
                                    <td align="right"><b>Picture:</b></td>
                                    <td align="left"><input type="file" name="c_image" size="30"/></td>
                                </tr>
                                <tr>
                                    <td align="right"><b>Country:</b></td>
                                    <td align="left">
                                        <select name="c_country">
                                            <option>Select a Country</option>
                                            <option>Burundi</option>
                                            <option>Djibouti</option>
                                            <option>Eritrea</option>
                                            <option>Ethiopia</option>
                                            <option>Kenya</option>
                                            <option>Rwanda</option>
                                            <option>Somalia</option>
                                            <option>South Sudan</option>
                                            <option>Sudan</option>
                                            <option>Tanzania</option>
                                            <option>Uganda</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><b>City:</b></td>
                                    <td align="left"><input type="text" name="c_city" size="30"/></td>
                                </tr>
                                <tr>
                                    <td align="right"><b>Contacts:</b></td>
                                    <td align="left"><input type="text" name="c_contact" size="30"/></td>
                                </tr>
                                <tr>
                                    <td align="right"><b>Address:</b></td>
                                    <td align="left"><textarea cols="30" rows="5" name="c_address"></textarea></td>
                                </tr>
                                
                                <tr align="center">
                                    <td align="right"><input type="submit" name="register" value="Create Account"/></td>
                                    <td align="right"><button><a href="customer_login.php">Go Back</a></button></td>
                                </tr>
                            </table>
                        </form>
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
    </body>
</html>
<?php
global $conn;
if (isset($_POST['register'])) {
    $ip=  getIp();
    
    $c_name=$_POST['c_name'];
    $c_email=$_POST['c_email'];
    $c_pass=$_POST['c_pass'];
    $c_image=$_FILES['c_image']['name'];
    $c_image_temp=$_POST['c_image']['temp_image'];
    $c_country=$_POST['c_country'];
    $c_city=$_POST['c_city'];
    $c_contact=$_POST['c_contact'];
    $c_address=$_POST['c_address'];
    
    move_uploaded_file($c_image_temp, "customer_images/$c_image");
    
    $insert_customer="insert into customers (customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";
    $run_customer=  mysqli_query($conn, $insert_customer);
    
    $sel_cart="select * from cart where ip_add='$ip'";
    $run_cart=  mysqli_query($conn, $sel_cart);
    $check_cart=  mysqli_num_rows($run_cart);
    
    if ($check_cart==0) {
        
        $_SESSION['customer_email']=$c_email;
        
        echo "<script>alert('Registration Successful, Thanks!')</script>";
        echo "<script>window.open('customers/myaccount.php','_self')</script>";
    }  else {
        
        $_SESSION['customer_email']=$c_email;
        
        echo "<script>alert('Registration Successful, Thanks!')</script>";
        echo "<script>window.open('payments.php','_self')</script>";
    }
    
    
}
?>