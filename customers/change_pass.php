<?php
include '../admin/include/dbconnect.php';
?>
<form method="post" action="">
    <table width="670" align="center" bgcolor="green">
        <tr align="center">
            <td colspan="3"><h2>Change Your Password</h2></td>
        </tr>
        <tr align="center">
            <td><input type="password" name="current_pass" placeholder="Current password" required="required"/></td>
        </tr>
        <tr align="center">
            <td><input type="password" name="new_pass" placeholder="New password" required="required"/></td>
        </tr>
        <tr align="center">
            <td><input type="password" name="new_pass_again" placeholder="Confirm password"/></td>
        </tr>
        <tr align="center">
            <td colspan="4"><input type="submit" name="change_pass" value="Change Password"/></td>
        </tr>
        <!--<tr align="center">
            <td align="right"><a href="customer_login.php?forgot_pass">Forgot Password?</a></td>
            <td align="center"><a href="customer_register.php">New? Register Here!</a></td>
        </tr>-->
    </table>
</form>
<?php
if (isset($_POST['change_pass'])) {
    $user=$_SESSION['customer_email'];
    
    $current_pass=$_POST['current_pass'];
    $new_pass=$_POST['new_pass'];
    $new_again=$_POST['new_pass_again'];
    
    $sel_pass="select * from customers where customer_pass='$current_pass' AND customer_email='$user'";
    $run_pass=  mysqli_query($conn, $sel_pass);
    $check_pass=  mysqli_num_rows($run_pass);
    
    if ($check_pass==0) {
        echo "<script>alert('Your current password is wrong!')</script>";
        echo "<script>window.open('myaccount.php?change_pass','_self')</script>";
        exit();
    }
    if ($new_pass!=$new_again) {
        echo "<script>alert('New password do not match!')</script>";
        echo "<script>window.open('myaccount.php?change_pass','_self')</script>";
        exit();
    }  else {
        $update_pass="update customers set customer_pass='$new_pass' where customer_email='$user'";
        $run_update_pass=  mysqli_query($conn, $update_pass);
        
        echo "<script>alert('Password changed successfully!')</script>";
        echo "<script>window.open('myaccount.php','_self')</script>";
    }
}
?>

