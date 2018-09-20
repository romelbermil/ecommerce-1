<!DOCTYPE>
<?php
include './include/dbconnect.php';
?>
<div style="width: 670px; height: 430px; overflow-y: scroll; overflow-style: panner;">
    <table width="650" bgcolor="green">
        <tr align="center" bgcolor="skyblue">
            <td colspan="6"><h2>View all Categories</h2></td>
        </tr>
        <tr align="center" bgcolor="skyblue">
            <th>Serial.No</th>
            <th>Category</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php

        $get_categories="select * from categories";
        $run_categories=  mysqli_query($conn, $get_categories);

        $i=0;

        while ($row_categories = mysqli_fetch_array($run_categories)) {

            $cat_id=$row_categories['cat_id'];
            $cat_title=$row_categories['cat_title'];
            $i++;

        ?>
        <tr align="center" bgcolor="wheat">
            <td><?php echo $i;?></td>
            <td><?php echo $cat_title;?></td>
            <td><a href="index.php?edit_cat=<?php echo $cat_id;?>">Edit</a></td>
            <td><a href="index.php?delete_cat=<?php echo $cat_id;?>">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
</div>

