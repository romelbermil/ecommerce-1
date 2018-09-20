<!DOCTYPE>
<?php
include './include/dbconnect.php';
?>
<div style="width: 670px; height: 430px; overflow-y: scroll; overflow-style: panner;">
    <table width="650" bgcolor="green">
        <tr align="center" bgcolor="skyblue">
            <td colspan="6"><h2>View all Brands</h2></td>
        </tr>
        <tr align="center" bgcolor="skyblue">
            <th>Serial.No</th>
            <th>Brand</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php

        $get_brands="select * from brands";
        $run_brands=  mysqli_query($conn, $get_brands);

        $i=0;

        while ($row_brands = mysqli_fetch_array($run_brands)) {

            $brand_id=$row_brands['brand_id'];
            $brand_title=$row_brands['brand_title'];
            $i++;

        ?>
        <tr align="center" bgcolor="wheat">
            <td><?php echo $i;?></td>
            <td><?php echo $brand_title;?></td>
            <td><a href="index.php?edit_brand=<?php echo $brand_id;?>">Edit</a></td>
            <td><a href="index.php?delete_brand=<?php echo $brand_id;?>">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
</div>

