<?php
include './include/dbconnect.php';

if (isset($_GET['delete_pro'])) {
    $get_id=$_GET['delete_pro'];
    
    $sel_pro="select * from products where product_id='$get_id'";
    $run_sel_pro=  mysqli_query($conn, $sel_pro);
    $row_sel=  mysqli_fetch_array($run_sel_pro);
    
    $pro_id=$row_sel['product_id'];
}
?>
<form method="post" action="">
    <table width="670" bgcolor="green">
        <tr align="center">
            <td colspan="3"><h2>Do you really want to DELETE this product?</h2></td>
        </tr>
        <tr align="center">
            <td><input type="submit" name="yes" value="Yes,Proceed"</td>
            <td><input type="submit" name="no" value="No,Cancel"</td>
        </tr>
    </table>
</form>
<?php
$product_id=$pro_id;
if (isset($_POST['yes'])) {
    $delete_product="delete from products where product_id='$product_id'";
    $run_delete_product=  mysqli_query($conn, $delete_product);
    
    echo "<script>alert('Product Deleted!!')</script>";
    echo "<script>window.open('index.php?view_products','_self')</script>";
}
if (isset($_POST['no'])) {
    echo "<script>alert('Product deletion cancelled!')</script>";
    echo "<script>window.open('index.php?view_products','_self')</script>";
}
?>

