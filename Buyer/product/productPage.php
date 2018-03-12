<?php include '../../config.php'; ?>

<?php
session_start();
//$userID = $_SESSION['userID']; // uncomment this
$userID = 1;
$onWatchlist = False;
$prod_ID = $_GET["prod_ID"];
$sql = "SELECT prod_name, prod_category, prod_description, prod_start_price, prod_reserve_price, prod_end_date, prod_condition, prod_picture FROM product WHERE prod_ID = '$prod_ID'";
$result = mysqli_query($db, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $prod_name = $row["prod_name"];
    //$prod_category = $row["prod_category"];
    $prod_description = $row["prod_description"];
    $prod_start_price = $row["prod_start_price"];
    $prod_reserve_price = $row["prod_reserve_price"];
    $prod_end_date = $row["prod_end_date"];
    $prod_condition = $row["prod_condition"];
    $prod_picture_directory = $row["prod_picture"];
    $prod_picture = "../Browse/Images/" . $prod_picture_directory; //needs changing?
}

$sql2 = "SELECT buyer_ID, prod_ID FROM watchlist WHERE buyer_ID = '$userID' AND prod_ID = '$prod_ID'";
$result = mysqli_query($db, $sql2);

while ($row = mysqli_fetch_assoc($result)) {
    $onWatchlist = True;
}

date_default_timezone_set('Europe/London');
$end_date = new DateTime($prod_end_date);
$now = new DateTime("now");
$interval = $now->diff($end_date);

$dateNow = date("Y-m-d H:i:s");
$sql3 = "SELECT DISTINCT bids.prod_id, product.prod_name, product.prod_highest_price, product.prod_picture, product.prod_end_date FROM bids, product WHERE buyer_id IN (SELECT buyer_id FROM bids WHERE bids.prod_id = '$prod_ID') AND NOT bids.prod_ID = '$prod_ID' AND '$dateNow' <= prod_end_date ORDER BY bid_id DESC LIMIT 3";
$result = mysqli_query($db, $sql3);
$watchlistArray = array();
while ($row = mysqli_fetch_assoc($result)) {
    $watchlistArray[] = $row;
}

mysqli_close($db);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#watchlist').click(function () {
                if ($(this).html() == 'Save to watch list <span class="glyphicon glyphicon-heart"></span>') {
                    $.ajax({
                        url: 'watchlist.php',
                        data: {action: 'save', 'buyer_ID': 1, 'prod_ID': <?php echo $prod_ID ?>},
                        type: 'post',
                        success: function (output) {
                        }
                    });
                    $(this).html('Remove from watch list <span class="glyphicon glyphicon-heart"></span>');
                } else {
                    $.ajax({
                        url: 'watchlist.php',
                        data: {action: 'remove', 'buyer_ID': 1, 'prod_ID': <?php echo $prod_ID ?>},
                        type: 'post',
                        success: function (output) {
                        }
                    });
                    $(this).html('Save to watch list <span class="glyphicon glyphicon-heart"></span>');
                }
            })
        })
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<h1 align="center"><?php echo $prod_name; ?></h1>
<hr>

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <img src="<?php echo $prod_picture; ?>" class="img-rounded img-responsive">
            <button type="button" id="watchlist"
                    class="btn btn-warning"><?php echo $onWatchlist ? 'Remove from watch list' : 'Save to watch list' ?>
                <span class="glyphicon glyphicon-heart"></button>
        </div>
        <div class="col-sm-4"><?php echo $prod_description ?></div>
        <div class="col-sm-4 well">
            <table style="width:100%">
                <tr align="center">
                    <td>Condition:</td>
                    <td><b><?php echo $prod_condition; ?></b></td>
                </tr>
                <tr align="center">
                    <td>Time remaining:</td>
                    <td><?php echo $interval->format(' %d days, %h hours, %m minutes') ?></td>
                </tr>
            </table>

            <button type="button" class="btn btn-warning btn-block">Bid</button>
        </div>
    </div>
</div>

<h2>Customers have also bidded on</h2>
<hr>
<div class="container">
    <div class="row">
        <div class="col-sm-4" align="center">
            <a href="../product/productPage.php?prod_ID=<?php echo $watchlistArray[0]["prod_id"]; ?>">
                <img src="../Browse/Images/<?php echo $watchlistArray[0]["prod_picture"] ?>"
                     class="img-rounded img-responsive">
            </a>
            <h4><?php echo $watchlistArray[0]["prod_name"] ?></h4>
            Current price: <strong><?php echo $watchlistArray[0]["prod_highest_price"] ?></strong>
        </div>
        <div class="col-sm-4" align="center">
            <a href="../product/productPage.php?prod_ID=<?php echo $watchlistArray[1]["prod_id"]; ?>">
                <img src="../Browse/Images/<?php echo $watchlistArray[1]["prod_picture"] ?>"
                     class="img-rounded img-responsive">
            </a>
            <h4><?php echo $watchlistArray[1]["prod_name"] ?></h4>
            Current price: <strong><?php echo $watchlistArray[1]["prod_highest_price"] ?></strong>
        </div>
        <div class="col-sm-4" align="center">
            <a href="../product/productPage.php?prod_ID=<?php echo $watchlistArray[2]["prod_id"]; ?>">
                <img src="../Browse/Images/<?php echo $watchlistArray[2]["prod_picture"] ?>"
                     class="img-rounded img-responsive">
            </a>
            <h4><?php echo $watchlistArray[2]["prod_name"] ?></h4>
            Current price: <strong><?php echo $watchlistArray[2]["prod_highest_price"] ?></strong>
        </div>
    </div>
</div>
</body>
</html>
