<?php include 'config.php'; ?>
<?php //include 'searchBarHeader.php'; ?>

$prod_ID = $_GET['prod_ID'];

<!--    <div id="container2">-->
<!--        --><?php
//        echo $_GET["prod_ID"];
//        ?>
<!--    </div>-->
<!--    <div id="container2">-->

<?php
$prod_ID = $_GET["prod_ID"];
$sql = "SELECT prod_name, prod_category, prod_description, prod_start_price, prod_reserve_price, prod_end_date, prod_condition, prod_picture FROM product WHERE prod_ID = '$prod_ID'";
$result = mysqli_query($db, $sql);
?>

<!DOCTYPE html>
        <html>
        <body>

        <?php
        echo "product ID is $prodID";
        ?>
        </body>
        </html>
