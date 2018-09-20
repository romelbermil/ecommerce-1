<!DOCTYPE>
<?php
include './include/dbconnect.php';
?>
<form action="" method="post" enctype="multipart/form-data">
            
    <table width="670" bgcolor="green">
        <tr align="center">
            <td colspan="8"><h2>Insert a new Category</h2></td>
        </tr>
        <tr>
            <td align="right"><b>Category Name:</b></td>
            <td><input type="text" name="new_cat" size="30"/></td>
        </tr>                
        <tr align="center">
            <td colspan="8"><input type="submit" name="add_cat" value="Add Category"/></td>
        </tr>
    </table>

</form>
<?php

if (isset($_POST['add_cat'])) {
    $cat_title=$_POST['new_cat'];
    
    $insert_cat="insert into categories (cat_title) values ('$cat_title')";
    $run_insert_cat=  mysqli_query($conn, $insert_cat);
    
    if ($run_insert_cat) {
        echo "<script>alert('Category inserted successfully...')</script>";
        echo "<script>window.open('index.php?insert_cat','_self')</script>";
    }
}
?>

