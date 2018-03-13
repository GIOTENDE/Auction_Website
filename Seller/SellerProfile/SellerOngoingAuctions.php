<?php
?>
<?php

// !!set userID to test for nicolai development purposes
// !!local host development only
$userID = 26;

?>
<?php
include '../../config.php';?>
<link rel="stylesheet" type="text/css" media="screen" href="SellerProfile.css" />

<!--        AUCTION HISTORY TABLE       -->
<link rel="stylesheet" href="CreateNewAuctionItem.css" type="text/css">
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Auction Website</a>
        </div>
          <ul class="nav navbar-nav">
            <li class="active"><a href="../SellerProfile/SellerProfile.php">Home</a></li>
            <li href="../../logout.php" class="active"><a>Logout</a></li>
          </ul>
        </div>
      </div>
  </div>
  <br>
  <br>
<h1>Auction History Table</h1>
<div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
        <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Date Product Added</th>
            <th>Date Will End</th>
            <th>Condition</th>
            <th>Sale price</th>
            <th>Winning Bidder</th>
            <th>Number of Bids</th>

        </tr>
        </thead>

</div>

<tbody>
<tr>

    <?php
    $dateNow = date("Y-m-d H:i:s");
    $getProductDetails = mysqli_query($db,"SELECT a.prod_id, a.prod_name, a.prod_start_date, a.prod_end_date, a.prod_condition, a.prod_highest_price, a.prod_buyerID, COUNT(b.prod_ID) AS bids FROM product AS a LEFT JOIN bids AS b USING(prod_id) WHERE prod_sellerID = (('$userID')) AND '$dateNow' <= prod_end_date");



    if (mysqli_num_rows($getProductDetails) > 0) :
    $count=1;
    $dateArray=[];
    while($row = mysqli_fetch_assoc($getProductDetails)) : ?>

    <!--    PRODUCT ID COLUMN    -->
    <td><?php echo $row['prod_id'] ?></td>
    <!--    PRODUCT TITLE COLUMN    -->
    <td><?php echo $row['prod_name'] ?></td>
    <!--    PRODUCT START DATE COLUMN    -->
    <td><?php echo $row['prod_start_date'] ?></td>
    <td><?php echo $row['prod_end_date'] ?></td>
    <!--    PRODUCT STATE COLUMN    -->
    <td><?php echo $row['prod_condition'] ?></td>
    <td><?php echo $row['prod_highest_price'] ?></td>
    <td><?php echo $row['prod_buyerID'] ?></td>
    <td><?php echo $row['bids'] ?></td>




</tr>
<?php $count+=1; endwhile;
else :
    echo "no results";
endif;
?>
</tbody>
</table>




<!--        FEEDBACK TABLE   ?????    -->

<!--</body>-->
<!---->
<!--<script type ="text/javascript">-->
<!---->
<!--    // End date-->
<!--    var countDownDate = new Date('--><?php //echo $convertdate-> format('M d, Y H:i:s');?><!--').getTime();-->
<!--//-->
<!--//    //var c = <!--?php echo json_encode($count); ?-->
<!--//    // document.getElementById('countdown').innerHTML = c;-->
<!--//    // Update the count down every 1 second-->
<!--//    var x = setInterval(function() {-->
<!--//-->
<!--//        // Today's date-->
<!--//        var now = new Date().getTime();-->
<!--//-->
<!--//        // Find the difference between now an the count down date-->
<!--//        var difference = countDownDate - now;-->
<!--//-->
<!--//        // Time calculations for days, hours, minutes and seconds-->
<!--//        var days = Math.floor(difference / (1000 * 60 * 60 * 24));-->
<!--//        var hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));-->
<!--//        var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));-->
<!--//        var seconds = Math.floor((difference % (1000 * 60)) / 1000);-->
<!--//-->
<!--//        // Output the result in an element with id='countdown'-->
<!--//        document.getElementById('countdown').innerHTML = days + 'd ' + hours + 'h '-->
<!--//            + minutes + 'm ' + seconds + 's ';-->
<!--//-->
<!--//        // If the count down is over, write some text-->
<!--//        if (difference < 0) {-->
<!--//            clearInterval(x);-->
<!--//            document.getElementById('countdown').innerHTML = 'EXPIRED';-->
<!--//        }-->
<!--//    }, 1000);-->
<!--//-->
<!--//</script>-->
<!--        FOOTER          -->

<br>
<br>
<br>
<br><br>


</html>
