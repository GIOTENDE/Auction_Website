<?php

// !!set userID to test for nicolai development purposes
// !!local host development only
//session_start();

session_start();

$_SESSION['userID'] = 33;
$userID = $_SESSION['userID'];

//$userID = 33;

?>
<!--<script type="text/javascript"-->
<!--        src="BuyerHistoricAuctionsController.js">-->
<!--</script>-->

<?php
include '../../config.php';?>
<?php include '../../includes/pagetop.php'; ?>
<link rel="stylesheet" type="text/css" media="screen" href="SellerProfile.css" />

<!--        AUCTION HISTORY TABLE       -->
<h1>Previous Auctions Table</h1>
<div class="tbl-header">
<table cellpadding="0" cellspacing="0" border="0">
<thead>
        <tr>
          <th>Product ID</th>
          <th>Product Name</th>
            <th>Date Auction Ends</th>
          <th>Condition</th>
          <th>Bid Amount</th>
          <th>The Highest Bid</th>
            <th>Number of Bids</th>
            <th>Outcome</th>
            <th>Seller Feedback Score</th>
            <th>Your Feedback Score</th>

        </tr>
            </thead>

      </div>

      <tbody>
        <tr>

<?php
$dateNow = date("Y-m-d H:i:s");
$getProductDetails = mysqli_query($db,"SELECT b.prod_id, p.prod_name, p.prod_end_date, p.prod_condition, 
b.amount AS bid_amount, p.prod_highest_bid
AS current_highest_bid, (SELECT COUNT(prod_id) FROM bids WHERE prod_id = p.prod_id) AS total_bids_on_product
, f.seller_feedback_points, f.buyer_feedback_points
FROM bids AS b
  LEFT JOIN product AS p ON b.prod_id = p.prod_id
  LEFT JOIN feedback AS f ON p.prod_id = f.prod_id
WHERE b.buyer_id = (('$userID'))  AND '$dateNow' >= prod_end_date");



if (mysqli_num_rows($getProductDetails) > 0) :
        $count=1;
        $dateArray=[];
        while($row = mysqli_fetch_assoc($getProductDetails)) : ?>
            <?php $prodID = $row['prod_id']?>

        <!--    PRODUCT ID COLUMN    -->
          <td><?php echo $row['prod_id'] ?></td>
          <!--    PRODUCT TITLE COLUMN    -->
          <td><?php echo $row['prod_name'] ?></td>
          <!--    PRODUCT START DATE COLUMN    -->
            <td><?php echo $row['prod_end_date'] ?></td>
           <!--    PRODUCT STATE COLUMN    -->
            <td><?php echo $row['prod_condition'] ?></td>
            <td><?php echo $row['bid_amount'] ?></td>
            <td><?php echo $row['current_highest_bid'] ?></td>

            <td><?php echo $row['total_bids_on_product'] ?></td>
            <td><?php
                if($row['bid_amount'] == $row['current_highest_bid']){ ?>
                    <h2>You Won!</h2>
                <?php } else { ?>
                    <h2>Someone else is higher...!</h2>
                <?php } ?></td>

            <td><?php
            if($row['bid_amount'] == $row['current_highest_bid'] && $row['f.seller_feedback_points']==NULL){?>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

                <script>

$(document).ready(function (){
    $("#score").click(function(){
        $.ajax({
            url: 'postFeedbackScore.php',
            data: {'buyerID': <?php echo $userID?>, 'feedback': $("#score").val(), 'prodID': <?php echo $prodID?>},
            type: 'post',
            success: function(output) {

            }
        })
        $("#score").replaceWith($("#score").val())

        // alert($("#score").val())

    });
});



                </script>


                <div id="container">
<!--                    // you need to do AJAX or jQuery here-->
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
            } else {echo $row['f.seller_feedback_pointsbuyer_feedback_points'];

                }
            ?>
            </td>
            <td><?php echo $row['f.buyer_feedback_points'] ?></td>





        </tr>
       <?php $count+=1; endwhile;
     else :
        echo "no results";
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


<br>
<br>
<br><br>



<?php require '../../includes/footer.php'; ?>
</html>
