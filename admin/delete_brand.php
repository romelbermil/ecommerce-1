<?php
include './include/dbconnect.php';

if ($_GET['delete_brand']) {
    $get_id=$_GET['delete_brand'];
    
    $sel_brand="select * from brands where brand_id='$get_id'";
    $run_sel_brand=  mysqli_query($conn, $sel_brand);
    $row_sel_brand = mysqli_fetch_array($run_sel_brand);
    
    $brands_id=$row_sel_brand['brand_id'];
}
?>
<form method="post" action="">
    <table width="670" bgcolor="green">
        <tr align="center">
            <td colspan="3"><h2>Do you really want to DELETE this Brand?</h2></td>
        </tr>
        <tr align="center">
            <td><input type="submit" name="yes" value="Yes,Proceed"</td>
            <td><input type="submit" name="no" value="No,Cancel"</td>
        </tr>
    </table>
</form>
<?php
$brand_id=$brands_id;
if (isset($_POST['yes'])) {
    $delete_brand="delete from brands where brand_id='$brand_id'";
    $run_delete_brand=  mysqli_query($conn, $delete_brand);
    
    echo "<script>alert('Brand Deleted!!')</script>";
    echo "<script>window.open('index.php?view_brands','_self')</script>";
}
if (isset($_POST['no'])) {
    echo "<script>alert('Brand deletion cancelled!')</script>";
    echo "<script>window.open('index.php?view_brands','_self')</script>";
}
?>


