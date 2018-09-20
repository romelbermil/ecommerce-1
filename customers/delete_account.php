<?php
include '../admin/include/dbconnect.php';
?>
<form method="post" action="">
    <table width="600" align="center" bgcolor="green">
        <tr align="center">
            <td colspan="3"><h2>Do you really want to DELETE your account?</h2></td>
        </tr>
        <tr>
            <td><input type="submit" name="yes" value="Yes,Proceed"</td>
            <td><input type="submit" name="no" value="No,Cancel"</td>
        </tr>
    </table>
</form>
<?php
$user=$_SESSION['customer_email'];

if (isset($_POST['yes'])) {
    $delete_account="delete from customers where customer_email='$user'";
    $run_delete_a=  mysqli_query($conn, $delete_account);
    
    echo "<script>alert('Account Deleted!!')</script>";
    echo "<script>window.open('../index.php','_self')</script>";
}
if (isset($_POST['no'])) {
    echo "<script>alert('Deletion cancelled!')</script>";
    echo "<script>window.open('myaccount.php','_self')</script>";
}

?>
