<?php
session_start();
$userID = $_SESSION['userID'];
include '../../config.php';
?>
<<<<<<< HEAD
<!--<script type="text/javascript"-->
<!--        src="BuyerHistoricAuctionsController.js">-->
<!--</script>-->

<?php
include '../../config.php';?>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Auction Website</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="../BuyerProfile/BuyerProfile.php">My Account</a></li>
            <li> <a href="../../logout.php" class="active">Logout</a></li>
        </ul>
    </div>
</div>
</div>
<br>
<br>
<link rel="stylesheet" type="text/css" media="screen" href="SellerProfile.css" />
=======
>>>>>>> origin/GioCode

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Expired Auctions</title>
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
        while ($row = mysqli_fetch_assoc($getProductDetails)) : ?>
        <!--    PRODUCT NAME COLUMN    -->
        <td><a href='../product/productPage.php?prod_ID=<?php echo $row['prod_id'] ?>' ><?php echo $row['prod_name'] ?></a></td>
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
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                    <script>
                        $(document).ready(function () {
                            $("#score").click(function () {
                                $.ajax({
                                    url: 'postFeedbackScore.php',
                                    data: {
                                        'buyerID': <?php echo $userID?>,
                                        'feedback': $("#score").val(),
                                        'prodID': <?php echo $prodID?>},
                                    type: 'post',
                                    success: function (output) {
                                    }
                                })
                                $("#score").replaceWith($("#score").val());
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
<<<<<<< HEAD
     endif;
?>
        </tbody>
    </table>

<!---->
<!--<!--        FEEDBACK TABLE   ?????    -->
<!---->
<!--</body>-->
<!---->
<!--<script type ="text/javascript">-->
<!---->
<!--                // End date-->
<!--                var countDownDate = new Date('--><?php //echo $convertdate-> format('M d, Y H:i:s');?><!--').getTime();-->
<!--//-->
<!--//                //var c = <!--?php echo json_encode($count); ?-->
<!--//               // document.getElementById('countdown').innerHTML = c;-->
<!--//                // Update the count down every 1 second-->
<!--//                var x = setInterval(function() {-->
<!--//-->
<!--//                // Today's date-->
<!--//                var now = new Date().getTime();-->
<!--//-->
<!--//                // Find the difference between now an the count down date-->
<!--//                var difference = countDownDate - now;-->
<!--//-->
<!--//                // Time calculations for days, hours, minutes and seconds-->
<!--//                var days = Math.floor(difference / (1000 * 60 * 60 * 24));-->
<!--//                var hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));-->
<!--//                var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));-->
<!--//                var seconds = Math.floor((difference % (1000 * 60)) / 1000);-->
<!--//-->
<!--//                // Output the result in an element with id='countdown'-->
<!--//                document.getElementById('countdown').innerHTML = days + 'd ' + hours + 'h '-->
<!--//                + minutes + 'm ' + seconds + 's ';-->
<!--//-->
<!--//                // If the count down is over, write some text-->
<!--//                if (difference < 0) {-->
<!--//                clearInterval(x);-->
<!--//                document.getElementById('countdown').innerHTML = 'EXPIRED';-->
<!--//                }-->
<!--//                 }, 1000);-->
<!--//-->
<!--//                </script>-->
<!--        FOOTER          -->



=======
    endif;
    ?>
    </tbody>
</table>
</body>
>>>>>>> origin/GioCode
</html>

