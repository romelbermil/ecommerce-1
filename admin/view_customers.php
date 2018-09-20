<!DOCTYPE>
<?php
include './include/dbconnect.php';
?>
<div style="width: 670px; height: 430px; overflow-y: scroll; overflow-style: panner;">
    <table width="650" bgcolor="green">
        <tr align="center" bgcolor="skyblue">
            <td colspan="6"><h2>View all Customers</h2></td>
        </tr>
        <tr align="center" bgcolor="skyblue">
            <th>Serial.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Delete</th>
        </tr>
        <?php

        $get_customers="select * from customers";
        $run_customers=  mysqli_query($conn, $get_customers);

        $i=0;

        while ($row_customers = mysqli_fetch_array($run_customers)) {

            $c_id=$row_customers['customer_id'];
            $c_name=$row_customers['customer_name'];
            $c_email=$row_customers['customer_email'];
            $c_image=$row_customers['customer_image'];
            $i++;

        ?>
        <tr align="center" bgcolor="wheat">
            <td><?php echo $i;?></td>
            <td><?php echo $c_name;?></td>
            <td><?php echo $c_email;?></td>
            <td><img src="../customers/customer_images/<?php echo $c_image;?>" width="60" height="50"/></td>           
            <td><a href="index.php?delete_c=<?php echo $c_id;?>">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
</div>



