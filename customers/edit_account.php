<!DOCTYPE html>
<?php
session_start();
include '../admin/include/dbconnect.php';
?>
<?php
$user=$_SESSION['customer_email'];
                        
$get_customer="select * from customers where customer_email='$user'";
$run_customer=  mysqli_query($conn, $get_customer);
$row_customer=  mysqli_fetch_array($run_customer);

$c_id=$row_customer['customer_id'];
$name=$row_customer['customer_name'];
$email=$row_customer['customer_email'];
$pass=$row_customer['customer_pass'];
$country=$row_customer['customer_country'];
$city=$row_customer['customer_city'];
$contact=$row_customer['customer_contact'];
$address=$row_customer['customer_address'];
$image=$row_customer['customer_image'];

?>
<div>
    <form method="post" action="" enctype="multipart/form-data">
        <table align="center" width="670" bgcolor="green">
            <tr align="center">
                <td colspan="2"><h2>Update your Account</h2></td>
            </tr>
            <tr>
                <td align="right"><b>Name:</b></td>
                <td align="left"><input type="text" name="c_name" size="30" value="<?php echo $name;?>"/></td>
            </tr>                    
            <tr>
                <td align="right"><b>Email:</b></td>
                <td align="left"><input type="text" name="c_email" size="30" value="<?php echo $email;?>"/></td>
            </tr>                    
            <tr>
                <td align="right"><b>Password:</b></td>
                <td align="left"><input type="password" name="c_pass" size="30" value="<?php echo $pass;?>"/></td>
            </tr>
            <tr>
                <td align="right"><b>Picture:</b></td>
                <td align="left"><input type="file" name="c_image" size="30"/><img src="customer_images/<?php echo $image;?>" width="50" height="50"/></td>
            </tr>
            <tr>
                <td align="right"><b>Country:</b></td>
                <td align="left">
                    <select name="c_country" disabled="true">
                        <option><?php echo $country;?></option>
                        <option>Burundi</option>
                        <option>Djibouti</option>
                        <option>Eritrea</option>
                        <option>Ethiopia</option>
                        <option>Kenya</option>
                        <option>Rwanda</option>
                        <option>Somalia</option>
                        <option>South Sudan</option>
                        <option>Sudan</option>
                        <option>Tanzania</option>
                        <option>Uganda</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><b>City:</b></td>
                <td align="left"><input type="text" name="c_city" size="30" value="<?php echo $city;?>"/></td>
            </tr>
            <tr>
                <td align="right"><b>Contacts:</b></td>
                <td align="left"><input type="text" name="c_contact" size="30" value="<?php echo $contact;?>"/></td>
            </tr>
            <tr>
                <td align="right"><b>Address:</b></td>
                <td align="left"><textarea cols="30" rows="5" name="c_address" valu><?php echo $address;?></textarea></td>
            </tr>

            <tr align="center">
                <td align="right"><input type="submit" name="update" value="Update Account"/></td>
                <td align="right"><button><a href="myaccount.php">Go Back</a></button></td>
            </tr>
        </table>
    </form>
</div>
<?php
global $conn;
if (isset($_POST['update'])) {
    $ip=  getIp();
    
    $customer_id=$c_id;
    $c_name=$_POST['c_name'];
    $c_email=$_POST['c_email'];
    $c_pass=$_POST['c_pass'];
    $c_image=$_FILES['c_image']['name'];
    $c_image_temp=$_POST['c_image']['temp_image'];
    $c_city=$_POST['c_city'];
    $c_contact=$_POST['c_contact'];
    $c_address=$_POST['c_address'];
    
    move_uploaded_file($c_image_temp, "customer_images/$c_image");
    
    $update_customer="update customers set customer_name='$c_name', customer_email='$c_email', customer_pass='$c_pass', customer_city='$c_city', customer_contact='$c_contact', customer_address='$c_address', customer_image='$c_image' where customer_id='$customer_id'";
    $run_update_c=  mysqli_query($conn, $update_customer);
    
    if ($run_update_c) {
        echo "<script>alert('Account updated successfully!')</script>";
        echo "<script>window.open('myaccount.php','_self')</script>";
    }
    
    
}
?>



