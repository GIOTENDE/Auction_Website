<?php include '../../config.php'; ?>

<?php
$userID = $_SESSION['userID'];
$userID = 1; //delete this
$onWatchlist = False;
$prod_ID = $_GET["prod_ID"];
$sql = "SELECT prod_name, prod_category, prod_description, prod_start_price, prod_reserve_price, prod_end_date, prod_highest_bid, prod_condition, prod_picture FROM product WHERE prod_ID = '$prod_ID'";
$result = mysqli_query($db, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $prod_name = $row["prod_name"];
    //$prod_category = $row["prod_category"];
    $prod_description = $row["prod_description"];
    $prod_start_price = $row["prod_start_price"];
    $prod_reserve_price = $row["prod_reserve_price"];
    $prod_end_date = $row["prod_end_date"];
    $prod_highest_bid = $row["prod_highest_bid"];
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
$sql3 = "SELECT DISTINCT bids.prod_id, product.prod_name, product.prod_highest_bid, product.prod_picture, product.prod_end_date FROM bids INNER JOIN product ON bids.prod_id = product.prod_id WHERE buyer_id IN (SELECT buyer_id FROM bids WHERE bids.prod_id = '$prod_ID') AND NOT bids.prod_ID = '$prod_ID' AND '$dateNow' <= prod_end_date ORDER BY bid_id DESC LIMIT 3";
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
                    alert ($(this).html());
                    $.ajax({
                        url: 'watchlist.php',
                        data: {action: 'remove', 'buyer_ID': 1, 'prod_ID': <?php echo $prod_ID ?>},
                        type: 'post',
                        success: function (output) {
                        }
                    });
                    $(this).html('Save to watch list <span class="glyphicon glyphicon-heart"></span>');
                }
            });

            $('#bidbtn').click(function() {
                alert(<?php echo $userID ?>);
                alert($('#bid').val());
                if ($('#bid').val().match("^[0-9]+(.[0-9]{1,2})?$")) {
                    alert ("valid");
                    if ($('#bid').val() > <?php echo ($prod_highest_bid != null)? $prod_highest_bid : $prod_start_price - 0.01?>) {
                        alert ("Bid is enough.");
                    } else {
                        alert ("Higher bid required.");
                    }
                } else {
                    alert("Invalid amount entered.");
                }
            })
        })
    </script>
    <script src="jquery.countdown.js"></script>

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
                    class="btn btn-warning"><?php echo $onWatchlist ? 'Remove from watch list' : 'Save to watch list' ?> <span class="glyphicon glyphicon-heart"></button>
        </div>
        <div class="col-sm-4">
            <p><?php echo $prod_description ?></p>
            <p>Condition: <b><?php echo $prod_condition; ?></b></p>
        </div>
        <div class="col-sm-4 well">
            <table style="width:100%">
                <tr align="center">
                    <td><?php echo ($prod_highest_bid != null)? 'Current price:' : 'Starting price' ?></td>
                    <td><b><?php echo ($prod_highest_bid != null)? '£' . $prod_highest_bid: '£' . $prod_start_price ?></b></td>
                </tr>
                <tr align="center">
                    <td>Reserve price:</td>
                    <td><b>£ <?php echo $prod_reserve_price ?></b></td>
                </tr>
                <tr align="center">
                    <td>Time remaining:</td>
                    <td>
                        <div class="countdown">
                            <span id="clock"></span>
                        </div>
                        <script>
                            $('#clock').countdown(' <?php echo $end_date->format('Y/m/d H:i:s')?> ')
                                .on('update.countdown', function (event) {
                                    var format = '%H:%M:%S';
                                    if (event.offset.totalDays > 0) {
                                        format = '%-d day%!d ' + format;
                                    }
                                    if (event.offset.weeks > 0) {
                                        format = '%-w week%!w ' + format;
                                    }
                                    $(this).html(event.strftime(format));
                                })
                                .on('finish.countdown', function (event) {
                                    $(this).html('This auction has expired!')
                                        .parent().addClass('disabled');
                                    $('#watchlist').prop("disabled", true);
                                    $('#bid').prop("disabled", true);
                                });
                        </script>
                    </td>
                </tr>
            </table>

            <div class="form-group">
                <input type="text" style="text-align: center" placeholder="<?php echo ($prod_highest_bid != null)? $prod_highest_bid + 0.01 : $prod_start_price?>" class="form-control" id="bid">
            </div>

            <button type="button" class="btn btn-warning btn-block" id="bidbtn">Bid</button>
        </div>
    </div>
</div>

<h2>Customers have also bidded on</h2>
<hr>

<?php
$arrSize = sizeof($watchlistArray);
switch ($arrSize) {
    case 0:
        echo "<h4>No one has bidded on this item yet! What are you waiting for?</h4>";
        break;

    case 1:
        echo '<div class="container">
    <div class="row">
        <div class="col-sm-4" align="center" id="watchlist0">
            <a href="../product/productPage.php?prod_ID=' . $watchlistArray[0]["prod_id"] . '">
            <img src="../Browse/Images/' . $watchlistArray[0]["prod_picture"] . '" class="img-rounded img-responsive">
            </a>
            <h4> ' . $watchlistArray[0]["prod_name"] . '</h4>
            Current price: <strong>' . $watchlistArray[0]["prod_highest_bid"] . '</strong>
        </div>
    </div>
</div>';
        break;

    case 2:
        echo '<div class="container">
    <div class="row">
        <div class="col-sm-4" align="center" id="watchlist0">
            <a href="../product/productPage.php?prod_ID=' . $watchlistArray[0]["prod_id"] . '">
            <img src="../Browse/Images/' . $watchlistArray[0]["prod_picture"] . '" class="img-rounded img-responsive">
            </a>
            <h4> ' . $watchlistArray[0]["prod_name"] . '</h4>
            Current price: <strong>' . $watchlistArray[0]["prod_highest_bid"] . '</strong>
        </div>
        <div class="col-sm-4" align="center" id="watchlist1">
            <a href="../product/productPage.php?prod_ID=' . $watchlistArray[1]["prod_id"] . '">
            <img src="../Browse/Images/' . $watchlistArray[1]["prod_picture"] . '" class="img-rounded img-responsive">
            </a>
            <h4> ' . $watchlistArray[1]["prod_name"] . '</h4>
            Current price: <strong>' . $watchlistArray[1]["prod_highest_bid"] . '</strong>
        </div>
    </div>
</div>';
        break;

    case 3:
        echo '<div class="container">
    <div class="row">
        <div class="col-sm-4" align="center" id="watchlist0">
            <a href="../product/productPage.php?prod_ID=' . $watchlistArray[0]["prod_id"] . '">
            <img src="../Browse/Images/' . $watchlistArray[0]["prod_picture"] . '" class="img-rounded img-responsive">
            </a>
            <h4> ' . $watchlistArray[0]["prod_name"] . '</h4>
            Current price: <strong>' . $watchlistArray[0]["prod_highest_bid"] . '</strong>
        </div>
        <div class="col-sm-4" align="center" id="watchlist1">
            <a href="../product/productPage.php?prod_ID=' . $watchlistArray[1]["prod_id"] . '">
            <img src="../Browse/Images/' . $watchlistArray[1]["prod_picture"] . '" class="img-rounded img-responsive">
            </a>
            <h4> ' . $watchlistArray[1]["prod_name"] . '</h4>
            Current price: <strong>' . $watchlistArray[1]["prod_highest_bid"] . '</strong>
        </div>
        <div class="col-sm-4" align="center" id="watchlist2">
            <a href="../product/productPage.php?prod_ID=' . $watchlistArray[2]["prod_id"] . '">
            <img src="../Browse/Images/' . $watchlistArray[2]["prod_picture"] . '" class="img-rounded img-responsive">
            </a>
            <h4> ' . $watchlistArray[2]["prod_name"] . '</h4>
            Current price: <strong>' . $watchlistArray[2]["prod_highest_bid"] . '</strong>
        </div>
    </div>
</div>';
}
?>
</body>
</html>
