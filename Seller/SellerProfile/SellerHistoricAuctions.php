<?php
include '../../config.php';
session_start();
$userID = $_SESSION['userID'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Your Expired Auctions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="SellerProfile.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="SellerHistoricAuctionsController.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand">Auction Website</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="../SellerProfile/SellerProfile.php"><span
                            class="glyphicon glyphicon-user"></span>
                    My Account</a></li>
            <li><a href="../../logout.php" class="active"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
            </li>
        </ul>
    </div>
</nav>

<!--        AUCTION HISTORY TABLE       -->
<h1>Your Expired Auctions</h1>
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover">
    <thead>
    <tr>
        <th style="text-align: center">Product Name</th>
        <th style="text-align: center">Start Date</th>
        <th style="text-align: center">End Date</th>
        <th style="text-align: center">Condition</th>
        <th style="text-align: center">Bid Amount</th>
        <th style="text-align: center">Winning Bid?</th>
        <th style="text-align: center">Bidder</th>
        <th style="text-align: center">Total Number of Bids</th>
        <th style="text-align: center">Buyer Feedback Score</th>
        <th style="text-align: center">Your Feedback Score</th>
        <th style="text-align: center">Product Views</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php
        date_default_timezone_set('Europe/London');
        $dateNow = date("Y-m-d H:i:s");
        $getProductDetails = mysqli_query($db, "SELECT b.prod_id, p.prod_name, p.prod_start_date, p.prod_end_date, p.prod_condition,
b.amount AS bid_amount, p.prod_highest_bid AS current_highest_bid, p.prod_reserve_price, p.prod_views, b.buyer_id, (SELECT COUNT(prod_id) FROM bids WHERE prod_id = p.prod_id) AS total_bids_on_product
, f.seller_feedback_points, f.buyer_feedback_points
FROM bids AS b
  LEFT JOIN product AS p ON b.prod_id = p.prod_id
  LEFT JOIN feedback AS f ON p.prod_id = f.prod_id
WHERE b.seller_id = (('$userID')) AND '$dateNow' >= prod_end_date");
        if (mysqli_num_rows($getProductDetails) > 0) :
        $count = 1;
        $dateArray = [];
        while ($row = mysqli_fetch_assoc($getProductDetails)) : ?>
        <!--    PRODUCT TITLE COLUMN    -->
        <td><?php echo $row['prod_name'] ?></td>
        <!--    PRODUCT START DATE COLUMN    -->
        <td><?php echo $row['prod_start_date'] ?></td>
        <td><?php echo $row['prod_end_date'] ?></td>
        <!--    PRODUCT STATE COLUMN    -->
        <td><?php echo $row['prod_condition'] ?></td>
        <td><?php echo $row['bid_amount'] ?></td>
        <td><?php if ($row['current_highest_bid'] > $row['prod_reserve_price']) {
                //started here
                echo ($row['current_highest_bid'] == $row['bid_amount']) ? 'Yes' : 'No';
            } else {
                echo 'Yes but Reserve price not met.';
            } ?></td>
        <td><?php echo $row['buyer_id'] ?></td>
        <td><?php echo $row['total_bids_on_product'] ?></td>
        <td><?php
            if ($row['current_highest_bid'] > $row['prod_reserve_price']) {
                if ($row['bid_amount'] == $row['current_highest_bid'] && $row['buyer_feedback_points'] == NULL) {
                    ?>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                    <script>
                        $(document).ready(function () {
                            $("#score").click(function () {
                                $.ajax({
                                    url: 'postFeedbackScore.php',
                                    data: {
                                        'sellerID': <?php echo $userID?>,
                                        'feedback': $("#score").val(),
                                        'prodID': <?php echo $prodID?>},
                                    type: 'post',
                                    success: function (output) {
                                    }
                                })
                                $("#score").replaceWith($("#score").val())
                            });
                        });
                    </script>
                    <div id="container">

                        <form>
                            <select name="Score" id="score">
                                <option value="" disabled selected>Score</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </form>
                    </div>
                    <?php
                } else if ($row['bid_amount'] != $row['current_highest_bid']) {
                    echo 'Not highest bid';
                } else {
                    echo $row['buyer_feedback_points'];
                }
            } else {
                echo 'Reserve Price Not Met';
            }
            ?>
        </td>
        <td>
            <?php if ($row['current_highest_bid'] > $row['prod_reserve_price']) {
                if ($row['bid_amount'] == $row['current_highest_bid'] && $row['seller_feedback_points'] == NULL) {
                    echo 'No buyer feedback received';
                } else if ($row['bid_amount'] != $row['current_highest_bid']) {
                    echo 'Not highest bid';
                } else {
                    echo $row['seller_feedback_points'];
                }
            } else {
                echo 'Reserve Price Not Met';
            }
            ?></td>
        <td><?php echo $row['prod_views'] ?></td>
    </tr>
    <?php $count += 1;
    endwhile;
    else :
        echo "no results";
    endif;
    ?>
    </tbody>
</table>
</body>
</html>
