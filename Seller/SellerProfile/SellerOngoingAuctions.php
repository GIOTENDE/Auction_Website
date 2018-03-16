<?php include '../../config.php';
session_start();
$userID = $_SESSION['userID'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Your Ongoing Auctions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="SellerProfile.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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

<h1>Live Auction Table</h1>
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th style="text-align: center">Product Name</th>
            <th style="text-align: center">Date Product Added</th>
            <th style="text-align: center">Date Will End</th>
            <th style="text-align: center">Condition</th>
            <th style="text-align: center">Bid Amount</th>
            <th style="text-align: center">Highest Bid</th>
            <th style="text-align: center">Winning Bidder</th>
            <th style="text-align: center">Number of Bids</th>
            <th style="text-align: center">Product Views</th>
        </tr>
        </thead>
<tbody>
<tr>
    <?php
    date_default_timezone_set('Europe/London');
    $dateNow = date("Y-m-d H:i:s");
    $getProductDetails = mysqli_query($db, "SELECT b.prod_id, p.prod_name, p.prod_start_date, p.prod_end_date, p.prod_condition,
b.amount AS bid_amount, p.prod_highest_bid
AS current_highest_bid, p.prod_reserve_price, p.prod_views, b.buyer_id, (SELECT COUNT(prod_id) FROM bids WHERE prod_id = p.prod_id) AS total_bids_on_product
, f.seller_feedback_points, f.buyer_feedback_points
FROM bids AS b
  LEFT JOIN product AS p ON b.prod_id = p.prod_id
  LEFT JOIN feedback AS f ON p.prod_id = f.prod_id
WHERE b.seller_id = (('$userID')) AND '$dateNow' <= prod_end_date");
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
            echo 'Yes but reserve price not met.';
        } ?></td>
    <td><?php echo $row['buyer_id'] ?></td>
    <td><?php echo $row['total_bids_on_product'] ?></td>
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
