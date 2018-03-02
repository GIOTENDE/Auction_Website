<?php include 'config.php'; ?>
<?php include 'searchBarHeader.php'; ?>

<div id="container2">

<?php
echo $_GET["category"];
?>

</div>

<div id="container2">

<?php
$category = $_GET["category"];
$sql = "SELECT prod_name, prod_category, prod_description, prod_start_price, prod_reserve_price, prod_end_date, prod_condition, prod_picture FROM product WHERE prod_category = '$category'";
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


