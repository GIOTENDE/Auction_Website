<?php include '../../config.php'; ?>

<?php
$userID = $_SESSION['userID']; //TODO: does this work?
$userID = 2; //TODO: delete this
$onWatchlist = False;
$prod_ID = $_GET["prod_ID"];
$sql = "SELECT prod_name, prod_category, prod_description, prod_start_price, prod_reserve_price, prod_end_date, prod_highest_bid, prod_condition, prod_picture, prod_views FROM product WHERE prod_ID = '$prod_ID'";
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
    $prod_picture = "../Browse/Images/" . $prod_picture_directory; //TODO:needs changing?
    $prod_views = $row["prod_views"];
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
<!--    <meta http-equiv="refresh" content="5">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'updateViews.php',
                data: {'prod_ID': <?php echo $prod_ID ?>},
                type: 'post',
                success: function(output) {
                }
            });

            $('#watchlist').click(function () {
                if ($(this).html() == 'Save to watch list <span class="glyphicon glyphicon-heart"></span>') {
                    $.ajax({
                        url: 'watchlist.php',
                        data: {action: 'save', 'buyer_ID': 1, 'prod_ID': <?php echo $prod_ID ?>}, //TODO: update buyer_ID
                        type: 'post',
                        success: function (output) {
                        }
                    });
                    $(this).html('Remove from watch list <span class="glyphicon glyphicon-heart"></span>');
                } else {
                    alert ($(this).html());
                    $.ajax({
                        url: 'watchlist.php',
                        data: {action: 'remove', 'buyer_ID': 1, 'prod_ID': <?php echo $prod_ID ?>}, //TODO: update buyer_ID
                        type: 'post',
                        success: function (output) {
                        }
                    });
                    $(this).html('Save to watch list <span class="glyphicon glyphicon-heart"></span>');
                }
            });

            $('#bidbtn').click(function() {
                if ($('#bid').val().match("^[0-9]+(.[0-9]{1,2})?$")) {
                    if ($('#bid').val() > <?php echo ($prod_highest_bid != null)? $prod_highest_bid : $prod_start_price - 0.01?>) {

                        // generate outbid email
                        $.ajax({
                            url: 'outbidEmail.php',
                            data: {},
                            type: 'post',
                            success:function(output) {
                                alert ("email sent");
                            }
                        });

                        var amount = $('#bid').val();

                        // Update text if this was the first bid
                        if ($('#priceTitle').html() == 'Starting price:') {
                            $('#priceTitle').html('Current price:')
                        }

                        // Update the current price
                        $('#priceText').html('£' + amount);

                        //Update the placeholder and empty it
                        var newAmount = Number(amount) + 0.01;
                        $('#bid').attr("placeholder", newAmount);
                        $('#bid').val('');

                        // popup for valid bid
                        $('#modal-title').html('Valid Bid');
                        $('#modal-body').html('Your bid has been received for: <?php echo $prod_name ?>');
                        $('#myModal').modal('show');

                        //ajax to update the database - insert into bids table & update product table
                        $.ajax({
                            url: 'successfulBid.php',
                            data: {'prod_ID': <?php echo $prod_ID ?>, 'amount': amount, 'buyer_ID': 1}, // TODO: update buyer_ID
                            type: 'post',
                            success: function(output) {
                            }
                        });

                    } else {
                        $('#modal-title').html('Invalid Bid');
                        $('#modal-body').html('You have not bidded enough!');
                        $('#myModal').modal('show');
                    }
                } else {
                    $('#modal-title').html('Invalid Bid');
                    $('#modal-body').html('You must enter a valid amount!');
                    $('#myModal').modal('show');
                }
            })
        })

        setInterval(function() {
            $.ajax({
                url: 'getPrice.php',
                data: {'prod_ID': <?php echo $prod_ID ?>},
                type: 'post',
                success: function (output) {
                    if ($('#priceText').html() != '£ ' + output) {
                        $('#priceText').html('£ ' + output);
                        //TODO: the php variable itself should be updated??, placeholder update, Starting price update
                        // $('#modal-title').html('Alert');
                        $('#modal-body2').html('The price has been updated as a new bid of £ ' + output + ' has been received.');
                        $('#myModal2').modal('show');
                    }
                }
            });
        }, 1000);
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
                    <td id ="priceTitle"><?php echo ($prod_highest_bid != null)? 'Current price:' : 'Starting price:' ?></td>
                    <td><b id ="priceText">£ <?php echo ($prod_highest_bid != null)? $prod_highest_bid: $prod_start_price ?></b></td>
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

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal-title"></h4>
            </div>
            <div class="modal-body">
                <p id="modal-body"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div id="myModal2" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"">Alert!</h4>
            </div>
            <div class="modal-body" >
                <p id="modal-body2"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

</body>
</html>
