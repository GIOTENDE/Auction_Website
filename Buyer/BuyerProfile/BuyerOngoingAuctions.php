<?php
session_start();
$userID = $_SESSION['userID'];
include '../../config.php';?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Ongoing Auctions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="SellerProfile.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand">Auction Website</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="../BuyerProfile/BuyerProfile.php"><span class="glyphicon glyphicon-user"></span> My Account</a></li>
            <li> <a href="../../logout.php" class="active"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>

<h1>Ongoing Auctions</h1>
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th style="text-align: center">Product Name</th>
        <th style="text-align: center">End Date</th>
        <th style="text-align: center">Condition</th>
        <th style="text-align: center">Bid Amount</th>
        <th style="text-align: center">Current Highest Bid</th>
        <th style="text-align: center">Number of Bids</th>
        <th style="text-align: center">Are you winning?</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php
        $dateNow = date("Y-m-d H:i:s");
        $getProductDetails = mysqli_query($db,"SELECT p.prod_name, p.prod_end_date, p.prod_condition, b.amount AS bid_amount, p.prod_highest_bid AS current_highest_bid, p.prod_reserve_price, (SELECT COUNT(prod_id) FROM bids WHERE prod_id = p.prod_id) AS total_bids_on_product FROM bids AS b LEFT JOIN product AS p ON b.prod_id = p.prod_id WHERE b.buyer_id = (('$userID')) AND '$dateNow' <= prod_end_date");

        if (mysqli_num_rows($getProductDetails) > 0) :
        $count=1;
        $dateArray=[];
        while($row = mysqli_fetch_assoc($getProductDetails)) : ?>
        <!--    PRODUCT TITLE COLUMN    -->
        <td><?php echo $row['prod_name'] ?></td>
        <!--    PRODUCT START DATE COLUMN    -->
        <td><?php echo $row['prod_end_date'] ?></td>
        <!--    PRODUCT STATE COLUMN    -->
        <td><?php echo $row['prod_condition'] ?></td>
        <td><?php echo $row['bid_amount'] ?></td>
        <td><?php echo $row['current_highest_bid'] ?></td>

        <td><?php echo $row['total_bids_on_product'] ?></td>
        <td><?php if ($row['current_highest_bid'] > $row['prod_reserve_price']) {
                echo ($row['current_highest_bid'] == $row['bid_amount']) ? 'You are winning the auction! #tigerblood' : 'You have been outbid... #growapair';
            } else {
                echo 'You are winning but you havent even met the reserve price...';
            } ?></td>
    </tr>
    <?php $count+=1; endwhile;
    else :
        echo "no results";
    endif;
    ?>
    </tbody>
</table>
</body>
</html>


