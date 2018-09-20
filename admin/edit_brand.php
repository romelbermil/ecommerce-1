<!DOCTYPE>
<?php
include './include/dbconnect.php';

if (isset($_GET['edit_brand'])) {
    $get_id=$_GET['edit_brand'];
    
    $get_brands="select * from brands where brand_id='$get_id'";
    $run_brands=  mysqli_query($conn, $get_brands);

    $i=0;

    $row_brands = mysqli_fetch_array($run_brands);

            $brand_id=$row_brands['brand_id'];
            $brand_title=$row_brands['brand_title'];
}
?>
<form action="" method="post" enctype="multipart/form-data">
            
    <table width="670" bgcolor="green">
        <tr align="center">
            <td colspan="8"><h2>Update a Brand</h2></td>
        </tr>
        <tr>
            <td align="right"><b>Brand Name:</b></td>
            <td><input type="text" name="new_brand" size="30" value="<?php echo $brand_title;?>"/></td>
        </tr>                
        <tr align="center">
            <td colspan="8"><input type="submit" name="update_brand" value="Update Brand"/></td>
        </tr>
    </table>

</form>
<?php

if (isset($_POST['update_brand'])) {
    
    $brands_id=$brand_id;
    $brand_title=$_POST['new_brand'];
    
    $update_brand="update brands set brand_title='$brand_title' where brand_id='$brand_id'";
    $run_update_brand=  mysqli_query($conn, $update_brand);
    
    if ($run_update_brand) {
        echo "<script>alert('Brand updated successfully...')</script>";
        echo "<script>window.open('index.php?view_brands','_self')</script>";
    }
}
?>

