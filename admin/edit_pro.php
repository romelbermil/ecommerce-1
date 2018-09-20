<!DOCTYPE html>
<?php
include './include/dbconnect.php';

if (isset($_GET['edit_pro'])) {
    $get_id=$_GET['edit_pro'];
    
    $get_products="select * from products where product_id='$get_id'";
    $run_products=  mysqli_query($conn, $get_products);

    $i=0;

    $row_products = mysqli_fetch_array($run_products);

        $pro_id=$row_products['product_id'];
        $pro_title=$row_products['product_title'];
        $pro_image=$row_products['product_image'];
        $pro_price=$row_products['product_price'];
        $pro_cat=$row_products['product_cat'];
        $pro_brand=$row_products['product_brand'];
        $pro_desc=$row_products['product_desc'];
        $pro_keywrds=$row_products['product_keywords'];
        //for categories show
        $get_cat="select * from categories where cat_id='$pro_cat'";
        $run_cat=  mysqli_query($conn, $get_cat);
        $row_cat=  mysqli_fetch_array($run_cat);
        $category_title=$row_cat['cat_title'];
        //for brands show
        $get_brand="select * from brands where brand_id='$pro_brand'";
        $run_brand=  mysqli_query($conn, $get_brand);
        $row_brand=  mysqli_fetch_array($run_brand);
        $brand_title=$row_brand['brand_title'];
}
?>
<html>
    <head>
        <title>Update Product</title>
        <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
        <script>
            tinymce.init({selector:'textarea'});
        </script>
    </head>
    <body bgcolor="skyblue">
        <form action="" method="post" enctype="multipart/form-data">
            
            <table width="670" bgcolor="green">
                <tr align="center">
                    <td colspan="8"><h2>Edit and Update Product</h2></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Title:</b></td>
                    <td><input type="text" name="product_title" size="30" value="<?php echo $pro_title;?>"/></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Category:</b></td>
                    <td>
                        <select name="product_cat">
                            <option><?php echo $category_title;?></option>
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
                            <option><?php echo $brand_title;?></option>
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
                    <td><input type="file" name="product_image"/><img src="../images/<?php echo $pro_image;?>" width="50" height="50"/></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Price:</b></td>
                    <td><input type="text" name="product_price" value="<?php echo $pro_price;?>"/></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Description:</b></td>
                    <td><textarea name="product_desc" cols="20" rows="5"><?php echo $pro_desc;?></textarea></td>
                </tr>
                <tr>
                    <td align="right"><b>Product Keywords:</b></td>
                    <td><input type="text" name="product_keywords" size="30" value="<?php echo $pro_keywrds;?>"/></td>
                </tr>
                <tr align="center">
                    <td colspan="8"><input type="submit" name="update_pro" value="Update Product"/></td>
                </tr>
            </table>
            
        </form>
               
    </body>
</html>
<?php
    if (isset($_POST['update_pro'])) {
        //getting text data from form
        $product_id=$pro_id;
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
        $update_product="update products set product_cat='$product_cat', product_brand='$product_brand', product_title='$product_title', product_price='$product_price', product_desc='$product_desc', product_image='$product_image', product_keywords='$product_keywords' where product_id='$product_id'";
        $run_update_pro= mysqli_query($conn, $update_product);
        
        if ($run_update_pro) {
            echo "<script>alert('Product updated successfully...')</script>";
            echo "<script>window.open('index.php?view_products','_self')</script>";
        }
        
    }
?>

