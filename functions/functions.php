<?php

$conn = mysqli_connect("localhost", "root", "", "ecommerce");

//php get visitors ip
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }  elseif (!empty ($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $ip;
}
//the cart function
function cart() {
    global $conn;
    if (isset($_GET['add_cart'])) {
        $ip = getIp();
        
        $pro_id=$_GET['add_cart'];
        $check_pro="select * from cart where ip_add='$ip' AND p_id='$pro_id'";
        $run_check=  mysqli_query($conn, $check_pro);
        
        if (mysqli_num_rows($run_check)>0) {
            echo "";
        }  else {
            $insert_pro="insert into cart (p_id,ip_add) values ('$pro_id','$ip')";
            $run_pro=  mysqli_query($conn, $insert_pro);
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
}
//the total items
function totalItems() {
    global $conn;
    
    if (isset($_GET['add_cart'])) {
        $ip=  getIp();
        
        $get_items = "select * from cart where ip_add='$ip'";
        $run_items =  mysqli_query($conn, $get_items);
        $count_items = mysqli_num_rows($run_items);    
    }  else {
        $ip=  getIp();
        
        $get_items = "select * from cart where ip_add='$ip'";
        $run_items =  mysqli_query($conn, $get_items);
        $count_items = mysqli_num_rows($run_items);
    }
    echo $count_items;
}
//getting the total price
function totalPrice() {
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
            $values=  array_sum($product_price);
            $total+=$values;
        }
    }
    echo $total."ksh";
}
//getting the categories
function getCats() {
    global $conn;

    $get_cats = "select * from categories";
    $run_cats = mysqli_query($conn, $get_cats);

    while ($row_cats = mysqli_fetch_array($run_cats)) {
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];

        echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
    }
}

//getting the brands
function getBrands() {
    global $conn;

    $get_brands = "select * from brands";
    $run_brands = mysqli_query($conn, $get_brands);

    while ($row_brands = mysqli_fetch_array($run_brands)) {
        $brand_id = $row_brands['brand_id'];
        $brand_title = $row_brands['brand_title'];

        echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
    }
}
//getting all products
function getPro() {
    if (!isset($_GET['cat'])) {
    if (!isset($_GET['brand'])) {       
    global $conn;

    $get_pro = "select * from products order by RAND() LIMIT 0,6";
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
            <p><b>Price: $pro_price ksh</b></p>
            <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                
            <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
        </div>";
    }
    }   
    }
}
//getting specific category
function getProCat() {
    
    if (isset($_GET['cat'])) {
    $cat_id=$_GET['cat'];
    
    global $conn;

    $get_pro_cat = "select * from products where product_cat='$cat_id'";
    $run_pro_cat = mysqli_query($conn, $get_pro_cat);
    
    $count_cats = mysqli_num_rows($run_pro_cat);
    if ($count_cats==0) {
        echo "<h2 style='padding:20px;'>No products were found in this category!</h2>";
    }
   
    while ($row_pro_cat = mysqli_fetch_array($run_pro_cat)) {
        $pro_id = $row_pro_cat['product_id'];
        $pro_cat = $row_pro_cat['product_cat'];
        $pro_brand = $row_pro_cat['product_brand'];
        $pro_title = $row_pro_cat['product_title'];
        $pro_price = $row_pro_cat['product_price'];
        $pro_image = $row_pro_cat['product_image'];
        
        echo "
        <div id='single_product'> 
            <h4>$pro_title</h4><img src='images/$pro_image' width='180' height='160'></img>
            <p><b>Price: $pro_price ksh</b></p>
            <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                
            <a href='index.php?pro_id=$pro_id'><button style='float:right;'>Add to Cart</button></a>
        </div>";
        
    }   
    }
    
}
//getting specific brand
function getProBrand() {
 
    if (isset($_GET['brand'])) {
    $brand_id=$_GET['brand'];
    
    global $conn;

    $get_pro_brand = "select * from products where product_brand='$brand_id'";
    $run_pro_brand = mysqli_query($conn, $get_pro_brand);
    
    $count_brands=  mysqli_num_rows($run_pro_brand);
    if ($count_brands==0) {
        echo "<h2 style='padding:20px;'>No products were found in this brand!</h2>";
    }

    while ($row_pro_brand = mysqli_fetch_array($run_pro_brand)) {
        $pro_id = $row_pro_brand['product_id'];
        $pro_cat = $row_pro_brand['product_cat'];
        $pro_brand = $row_pro_brand['product_brand'];
        $pro_title = $row_pro_brand['product_title'];
        $pro_price = $row_pro_brand['product_price'];
        $pro_image = $row_pro_brand['product_image'];

        echo "
        <div id='single_product'> 
            <h4>$pro_title</h4><img src='images/$pro_image' width='180' height='160'></img>
            <p><b>Price: $pro_price ksh</b></p>
            <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                
            <a href='index.php?pro_id=$pro_id'><button style='float:right;'>Add to Cart</button></a>
        </div>";
    }
    }   
    
}