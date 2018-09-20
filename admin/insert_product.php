<!DOCTYPE html>
<?php
include './include/dbconnect.php';
?>
<html>
    <head>
        <title>Inserting Product</title>
        <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
        <script>
            tinymce.init({selector:'textarea'});
        </script>
    </head>
    <body bgcolor="skyblue">
        <form action="insert_product.php" method="post" enctype="multipart/form-data">
            
            <table width="670" bgcolor="green">
                <tr align="center">
                    <td colspan="8"><h2>Insert New Product Here</h2></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Title:</b></td>
                    <td><input type="text" name="product_title" size="30"/></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Category:</b></td>
                    <td>
                        <select name="product_cat">
                            <option>Select a Category</option>
                            <?php
                            $get_cats="select * from categories";
                            $run_cats= mysqli_query($conn, $get_cats);
    
                            while ($row_cats = mysqli_fetch_array($run_cats)) {
                            $cat_id=$row_cats['cat_id'];
                            $cat_title=$row_cats['cat_title'];
        
                            echo "<option value='$cat_id'>$cat_title</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right"><b>Product Brand:</b></td>
                    <td>
                        <select name="product_brand">
                            <option>Select a Brand</option>
                            <?php
                            $get_brands="select * from brands";
                            $run_brands= mysqli_query($conn, $get_brands);
    
                            while ($row_brands = mysqli_fetch_array($run_brands)) {
                            $brand_id=$row_brands['brand_id'];
                            $brand_title=$row_brands['brand_title'];
        
                            echo "<option value='$brand_id'>$brand_title</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right"><b>Product Image:</b></td>
                    <td><input type="file" name="product_image"/></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Price:</b></td>
                    <td><input type="text" name="product_price"/></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Description:</b></td>
                    <td><textarea name="product_desc" cols="20" rows="5"></textarea></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Keywords:</b></td>
                    <td><input type="text" name="product_keywords" size="30"/></td>
                </tr>
                <tr align="center">
                    <td colspan="8"><input type="submit" name="insert_post" value="Insert Product Now"/></td>
                </tr>
            </table>
            
        </form>
               
    </body>
</html>
<?php
    if (isset($_POST['insert_post'])) {
        //getting text data from form
        $product_title=$_POST['product_title'];
        $product_cat=$_POST['product_cat'];
        $product_brand=$_POST['product_brand'];
        $product_price=$_POST['product_price'];
        $product_desc = $_POST['product_desc'];
        $product_keywords=$_POST['product_keywords'];
        //getting image data from form
        $product_image=$_FILES['product_image']['name'];
        $product_image_tmp=$_FILES['product_image']['temp_name'];
        move_uploaded_file($product_image_tmp, "product_images/$product_image");
        
        //sql insert statement
        $insert_product="INSERT INTO products (product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords) VALUES ('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keywords')";
        
        $insert_pro=  mysqli_query($conn, $insert_product);
        if ($insert_pro) {
            echo "<script>alert('Product has been inserted...')</script>";
            echo "<script>window.open('insert_product.php','_self')</script>";
        }
        
    }


