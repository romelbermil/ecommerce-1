<?php
include './include/dbconnect.php';

if ($_GET['delete_cat']) {
    $get_id=$_GET['delete_cat'];
    
    $sel_cat="select * from categories where cat_id='$get_id'";
    $run_sel_cat=  mysqli_query($conn, $sel_cat);
    $row_sel_cat = mysqli_fetch_array($run_sel_cat);
    
    $category_id=$row_sel_cat['cat_id'];
}
?>
<form method="post" action="">
    <table width="670" bgcolor="green">
        <tr align="center">
            <td colspan="3"><h2>Do you really want to DELETE this Category?</h2></td>
        </tr>
        <tr align="center">
            <td><input type="submit" name="yes" value="Yes,Proceed"</td>
            <td><input type="submit" name="no" value="No,Cancel"</td>
        </tr>
    </table>
</form>
<?php
$cat_id=$category_id;
if (isset($_POST['yes'])) {
    $delete_category="delete from categories where cat_id='$cat_id'";
    $run_delete_category=  mysqli_query($conn, $delete_category);
    
    echo "<script>alert('Category Deleted!!')</script>";
    echo "<script>window.open('index.php?view_cats','_self')</script>";
}
if (isset($_POST['no'])) {
    echo "<script>alert('Category deletion cancelled!')</script>";
    echo "<script>window.open('index.php?view_cats','_self')</script>";
}
?>
