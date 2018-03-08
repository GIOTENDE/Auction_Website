<?php include 'config.php'; ?>

<?php
$_SESSION['user_ID'];
$prod_ID = $_GET["prod_ID"];
$sql = "SELECT prod_name, prod_category, prod_description, prod_start_price, prod_reserve_price, prod_end_date, prod_condition, prod_picture FROM product WHERE prod_ID = '$prod_ID'";
$result = mysqli_query($db, $sql);

    while($row = mysqli_fetch_assoc($result)) {
        $prod_name = $row["prod_name"];
        $prod_category = $row["prod_category"];
        $prod_description = $row["prod_description"];
        $prod_start_price = $row["prod_start_price"];
        $prod_reserve_price = $row["prod_reserve_price"];
        $prod_end_date = $row["prod_end_date"];
        $prod_condition = $row["prod_condition"];
        $prod_picture_directory = $row["prod_picture"];
        $prod_picture = "Images/" . $prod_picture_directory; //needs changing?
    }

    $sql2 = "SELECT user_ID, prod_ID FROM wishlist WHERE user_ID = '1'";
mysqli_close($db);



date_default_timezone_set('Europe/London');
$end_date = new DateTime($prod_end_date);
$now = new DateTime("now");
$interval = $now->diff($end_date);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<h1 align="center"><?php echo $prod_name; ?></h1>
<hr>

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <img src="<?php echo $prod_picture; ?>" class="img-rounded img-responsive">
            <button type="button" class="btn btn-warning">Save to wish list <span class="glyphicon glyphicon-heart"></button>
        </div>
        <div class="col-sm-4"><?php echo $prod_description ?></div>
        <div class="col-sm-4 well"> <table style="width:100%">
                <tr align="center">
                    <td>Condition:</td>
                    <td><b><?php echo $prod_condition; ?></b></td>
                </tr>
                <tr align="center">
                    <td>Time remaining:</td>
                    <td><?php echo $interval->format(' %d days, %h hours, %m minutes')?></td>
                </tr>
            </table>

            <button type="button" class="btn btn-warning btn-block">Bid</button>
        </div>
    </div>
</div>
<hr>

<h2>Customers who have bidded on this item have also bidded on</h2>

</body>
</html>
