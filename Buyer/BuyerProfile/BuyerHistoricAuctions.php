<?php
session_start();
$userID = $_SESSION['userID'];
include '../../config.php';


//$getProdID = mysqli_query($db, "SELECT p.prod_id FROM bids AS b LEFT JOIN product AS p ON b.prod_id = p.prod_id WHERE b.buyer_id = (('$userID'))  AND '$dateNow' >= prod_end_date");
//while ($row = mysqli_fetch_assoc($getProdID)) {
//    $prodID = $row['prod_id'];
//}
//?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Expired Auctions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="SellerProfile.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#score").on('change', function () {
                var feedback = $("#score").val();
                $.ajax({
                    url: 'postFeedbackScore.php',
                    data: {'buyerID': <?php echo $userID ?>, 'feedback': feedback, 'prodID': $GLOBALS['prodID']},
                    type: 'post',
                    success: function (output) {
                        alert("Feedback sent!")
                    }
                })
                $("#score").replaceWith($("#score").val());
            });
        });
    </script>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand">Auction Website</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="../BuyerProfile/BuyerProfile.php"><span class="glyphicon glyphicon-user"></span>
                    My Account</a></li>
            <li><a href="../../logout.php" class="active"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
            </li>
        </ul>
    </div>
</nav>

<h1>Expired Auctions</h1>
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover">
    <thead>
    <tr>
        <th style="text-align: center">Product Name</th>
        <th style="text-align: center">End Date</th>
        <th style="text-align: center">Condition</th>
        <th style="text-align: center">Bid Amount</th>
        <th style="text-align: center">Current Highest Bid</th>
        <th style="text-align: center">Number of Bids</th>
        <th style="text-align: center">Outcome</th>
        <th style="text-align: center">Seller Feedback Score</th>
        <th style="text-align: center">Your Feedback Score</th>
    </tr>
    </thead>
    <tbody>
    <tr>

        <?php
        date_default_timezone_set('Europe/London');
        $dateNow = date("Y-m-d H:i:s");
        $getProductDetails = mysqli_query($db, "SELECT p.prod_id, p.prod_name, p.prod_end_date, p.prod_condition, 
b.amount AS bid_amount, p.prod_highest_bid
AS current_highest_bid, p.prod_reserve_price, (SELECT COUNT(prod_id) FROM bids WHERE prod_id = p.prod_id) AS total_bids_on_product
, f.seller_feedback_points, f.buyer_feedback_points
FROM bids AS b
  LEFT JOIN product AS p ON b.prod_id = p.prod_id
  LEFT JOIN feedback AS f ON p.prod_id = f.prod_id
WHERE b.buyer_id = (('$userID'))  AND '$dateNow' >= prod_end_date");

        if (mysqli_num_rows($getProductDetails) > 0) :
        $count = 1;
        $dateArray = [];
        while ($row = mysqli_fetch_assoc($getProductDetails)) :
        $GLOBALS['prodID'] = $row['prod_id'];
        ?>
        <!--    PRODUCT NAME COLUMN    -->
        <td>
            <a href='../product/productPage.php?prod_ID=<?php echo $row['prod_id'] ?>'><?php echo $row['prod_name'] ?></a>
        </td>
        <!--    AUCTION START DATE COLUMN    -->
        <td><?php echo $row['prod_end_date'] ?></td>
        <!--    PRODUCT CONDITION COLUMN    -->
        <td><?php echo $row['prod_condition'] ?></td>
        <!--    PRODUCT TITLE COLUMN    -->
        <td><?php echo $row['bid_amount'] ?></td>
        <td><?php echo $row['current_highest_bid'] ?></td>
        <td><?php echo $row['total_bids_on_product'] ?></td>
        <td><?php if ($row['current_highest_bid'] > $row['prod_reserve_price']) {
                echo ($row['current_highest_bid'] == $row['bid_amount']) ? 'This bid won the auction for this item!' : 'Not highest bid';
            } else {
                echo 'Highest bid but reserve price not met, do not be so cheap...';
            } ?></td>
        <td><?php if ($row['current_highest_bid'] > $row['prod_reserve_price']) {
                if ($row['bid_amount'] == $row['current_highest_bid'] && $row['seller_feedback_points'] == NULL) {
                    ?>
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
                    echo $row['seller_feedback_points'];
                }
            } else {
                echo 'Reserve price not met';
            }
            ?>
        </td>
        <td>
            <?php
            if ($row['current_highest_bid'] > $row['prod_reserve_price']) {
                if ($row['bid_amount'] == $row['current_highest_bid'] && $row['seller_feedback_points'] == NULL) {
                    echo 'No seller feedback received';

                } else if ($row['bid_amount'] != $row['current_highest_bid']) {
                    echo 'Not highest bid';

                } else {
                    echo $row['buyer_feedback_points'];
                }
            } else {
                echo 'Reserve price not met';
            } ?>
        </td>
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
