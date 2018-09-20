<!DOCTYPE>
<?php
include './include/dbconnect.php';
?>
<form action="" method="post" enctype="multipart/form-data">
            
    <table width="670" bgcolor="green">
        <tr align="center">
            <td colspan="8"><h2>Insert a new Brand</h2></td>
        </tr>
        <tr>
            <td align="right"><b>Brand Name:</b></td>
            <td><input type="text" name="new_brand" size="30"/></td>
        </tr>                
        <tr align="center">
            <td colspan="8"><input type="submit" name="add_brand" value="Add Brand"/></td>
        </tr>
    </table>

</form>
<?php

if (isset($_POST['add_brand'])) {
    $brand_title=$_POST['new_brand'];
    
    $insert_brand="insert into brands (brand_title) values ('$brand_title')";
    $run_insert_brand=  mysqli_query($conn, $insert_brand);
    
    if ($run_insert_brand) {
        echo "<script>alert('Brand inserted successfully...')</script>";
        echo "<script>window.open('index.php?insert_brand','_self')</script>";
    }
}
?>

