<?php include 'config.php'; ?>
<?php include 'searchBarHeader.php'; ?>
<script type="text/javascript"
        src="dynamicProductListController.js">
</script>


<?php

$productSearch =  $_POST["search"];

$category2 = $_POST["searchCategories"];

$category1 = $_GET["category"];

$dateNow = date("Y-m-d H:i:s");

echo $productSearch;
echo $category2;
echo $category1;
?>

<div id="container">

    <select name="Name Alphabetical" id="nameAlphabetical"  onclick="sortName()">
        <option value="" disabled selected>Name</option>
        <option value="Name Alphabetical">Name Alphabetical</option>
    </select>

    <select name="Ending soon" id="endingSoon"  onclick="endingSoon(value)">
        <option value="" disabled selected>Sort by End Date</option>
        <option value="End soon first">End soon first</option>
        <option value="End soon last">End soon last</option>
    </select>

    <select name="Condition Filter" id="condition"  onclick="filterCategory()">
        <option value="" disabled selected>Condition</option>
        <option value="e">New or Used</option>
        <option value="New">New</option>
        <option value="Used">Used</option>
    </select>

    <select name="Reserve price" id="reservePrice"  onclick="sortReservePrice(value)">
        <option value="" disabled selected>Sort Reserve Price</option>
        <option value="High to Low">High to Low</option>
        <option value="Low to High">Low to High</option>
    </select>

    <select name="Highest bid" id="highestBid"  onclick="sortHighestBid(value)">
        <option value="" disabled selected>Sort Highest Bid</option>
        <option value="High to Low">High to Low</option>
        <option value="Low to High">Low to High</option>
    </select>



</div>


<div id="container2">









<?php
if(isset($category1)) {

    $sql = "SELECT prod_name, prod_category, prod_description, prod_start_price, prod_reserve_price, prod_end_date, prod_condition, prod_picture, prod_highest_price FROM product WHERE prod_category = '$category1' AND '$dateNow' <= prod_end_date";
    echo "first loop";
}


// run search for all categories
else if ($category2 == "*") {
        $sql = "SELECT prod_name, prod_category, prod_description, prod_start_price, prod_reserve_price, prod_end_date, prod_condition, prod_picture, prod_highest_price FROM product WHERE prod_name LIKE '%$productSearch%' AND '$dateNow' <= prod_end_date";
    echo "second loop";
    }

// run search within a category
else {

        $sql = "SELECT prod_name, prod_category, prod_description, prod_start_price, prod_reserve_price, prod_end_date, prod_condition, prod_picture, prod_highest_price FROM product WHERE (prod_name LIKE '%$productSearch%') AND (prod_category = '$category2')  AND '$dateNow' <= prod_end_date";
        echo "third loop";
    }





$result = mysqli_query($db, $sql);


if (mysqli_num_rows($result) > 0) {
    // output data of each row
    ?>
    <table id="myTable">
        <tr>
            <th></th>
            <th>Name</th>
            <th>Category</th>
            <th>End date</th>
            <th>Condition</th>
            <th>Reserve Price</th>
            <th>Current Bid</th>
        </tr>

        <?php
    while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td> <?php $picture1 = $row["prod_picture"];
            //            below needs changing when put on server
                $picture2 = "Images/" . $picture1;
                ?>
                <img src= "<?php echo $picture2?>" alt="Image picture" width="300" height="200"> </td>
            <td><?php echo    $row["prod_name"]; ?> </td>
            <td><?php echo $row["prod_category"]; ?> </td>
            <td><?php echo $row["prod_end_date"]; ?> </td>
            <td><?php echo $row["prod_condition"]; ?> </td>
            <td><?php echo  $row["prod_reserve_price"]; ?> </td>
            <td><?php echo  $row["prod_highest_price"]; ?> </td>





        </tr>
        <br>
 <?php   }
    ?>

    <?php
} else {
    echo "0 results";
}

mysqli_close($db);
?>

</div>



