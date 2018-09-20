<!DOCTYPE>
<?php
include './include/dbconnect.php';
?>
<div style="width: 670px; height: 430px; overflow-y: scroll; overflow-style: panner;">
    <table width="650" bgcolor="green">
        <tr align="center" bgcolor="skyblue">
            <td colspan="6"><h2>View all Products</h2></td>
        </tr>
        <tr align="center" bgcolor="skyblue">
            <th>No.</th>
            <th>Title</th>
            <th>Image</th>
            <th>Price</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php

        $get_products="select * from products";
        $run_products=  mysqli_query($conn, $get_products);

        $i=0;

        while ($row_products = mysqli_fetch_array($run_products)) {

            $pro_id=$row_products['product_id'];
            $pro_title=$row_products['product_title'];
            $pro_image=$row_products['product_image'];
            $pro_price=$row_products['product_price'];
            $i++;

        ?>
        <tr align="center" bgcolor="wheat">
            <td><?php echo $i;?></td>
            <td><?php echo $pro_title;?></td>
            <td><img src="../images/<?php echo $pro_image;?>" width="60" height="50"/></td>
            <td><?php echo $pro_price;?></td>
            <td><a href="index.php?edit_pro=<?php echo $pro_id;?>">Edit</a></td>
            <td><a href="index.php?delete_pro=<?php echo $pro_id;?>">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
</div>

