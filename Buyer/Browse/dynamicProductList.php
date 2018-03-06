<?php include 'config.php'; ?>
<?php include 'searchBarHeader.php'; ?>

<div id="container2">



    <?php
    $productSearch = $_POST["search"];
    $category = $_POST["searchCategories"];
    $dateNow = date("Y-m-d H:i:s");
    ?>

    <br>
    <br>

</div>

<!--<div id="container">-->
<!--    <header>-->
<!--        <h1>Filter results</h1>-->
<!--    </header>-->
<!--    <div id="searchBar">-->
<!---->
<!--        <ul>-->
<!--            <form action="dynamicProductList.php" method ="post">-->
<!--                <input type="text" id="search" name="search" placeholder="Search for an item"/>-->
<!---->
<!---->
<!--                <select name="searchCategories">-->
<!--                    <option value="*">All Categories</option>-->
<!--                    <option value="Collectables and antiques">Antiques</option>-->
<!--                    <option value="Home and Garden">Home & Garden</option>-->
<!--                    <option value="Sporting Goods">Sports & Active Goods</option>-->
<!--                    <option value="Electronics">Electronics</option>-->
<!--                    <option value="Jewellery and Watches">Jewellery & Watches</option>-->
<!--                    <option value="Toys and Games">Toys & Games</option>-->
<!--                    <option value="Fashion">Fashion</option>-->
<!--                    <option value="Motors">Fashion</option>-->
<!--                    <option value="Other">Other</option>-->
<!--                </select>-->
<!---->
<!--                <input id="show-btn" type="submit" name="submit" value="Search">-->
<!--            </form>-->
<!--        </ul>-->
<!---->
<!--    </div>-->
<!---->
<!---->
<!---->
<!--</div>-->

<div id="container2">

<?php
if(isset($_GET["category"])) {
    $category = $_GET["category"];
    $sql = "SELECT prod_name, prod_category, prod_description, prod_start_price, prod_reserve_price, prod_end_date, prod_condition, prod_picture FROM product WHERE prod_category = '$category' AND '$dateNow' <= prod_end_date";
}


// run search for all categories
else if ($category == "*") {
        $sql = "SELECT prod_name, prod_category, prod_description, prod_start_price, prod_reserve_price, prod_end_date, prod_condition, prod_picture FROM product WHERE prod_name LIKE '%$productSearch%' AND '$dateNow' <= prod_end_date";
    }

// run search within a category
else {

        $sql = "SELECT prod_name, prod_category, prod_description, prod_start_price, prod_reserve_price, prod_end_date, prod_condition, prod_picture FROM product WHERE (prod_name LIKE '%$productSearch%') AND (prod_category = '$category')  AND '$dateNow' <= prod_end_date";
    }





$result = mysqli_query($db, $sql);


if (mysqli_num_rows($result) > 0) {
    // output data of each row
    ?>
    <div id="container2">
        <?php
    while($row = mysqli_fetch_assoc($result)) {
        echo "Name: " . $row["prod_name"]. "<br>" .
            "Category: " . $row["prod_category"]. "<br>" .
            "Description: " . $row["prod_description"]. "<br>" .
            "Start Price: " . $row["prod_start_price"]. "<br>" .
            "Reserve Price: " . $row["prod_reserve_price"]. "<br>" .
            "End date: " . $row["prod_end_date"]. "<br>" .
            "Condition: " . $row["prod_condition"]. "<br>" .
            "Picture File: " . $row["prod_picture"]. "<br>";
            $picture1 = $row["prod_picture"];
//            below needs changing when put on server
            $picture2 = "Images/" . $picture1;


?>
        <img src= "<?php echo $picture2?>" alt="Image picture" width="300" height="200">
        <br>
 <?php   }
    ?>
    </div>
    <?php
} else {
    echo "0 results";
}

mysqli_close($db);
?>

</div>


