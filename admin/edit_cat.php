<!DOCTYPE>
<?php
include './include/dbconnect.php';

if (isset($_GET['edit_cat'])) {
    $get_id=$_GET['edit_cat'];
    
    $get_categories="select * from categories where cat_id='$get_id'";
    $run_categories=  mysqli_query($conn, $get_categories);

    $i=0;

    $row_categories = mysqli_fetch_array($run_categories);
    
        $cat_id=$row_categories['cat_id'];
        $cat_title=$row_categories['cat_title'];
}
?>
<form action="" method="post" enctype="multipart/form-data">
            
    <table width="670" bgcolor="green">
        <tr align="center">
            <td colspan="8"><h2>Update a Category</h2></td>
        </tr>
        <tr>
            <td align="right"><b>Category Name:</b></td>
            <td><input type="text" name="new_cat" size="30" value="<?php echo $cat_title;?>"/></td>
        </tr>                
        <tr align="center">
            <td colspan="8"><input type="submit" name="update_cat" value="Update Category"/></td>
        </tr>
    </table>

</form>
<?php

if (isset($_POST['update_cat'])) {
    
    $category_id=$cat_id;
    $cat_title=$_POST['new_cat'];
    
    $update_cat="update categories set cat_title='$cat_title' where cat_id='$category_id'";
    $run_update_cat=  mysqli_query($conn, $update_cat);
    
    if ($run_update_cat) {
        echo "<script>alert('Category updated successfully...')</script>";
        echo "<script>window.open('index.php?view_cats','_self')</script>";
    }
}
?>

