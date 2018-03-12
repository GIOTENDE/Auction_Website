<?php

// !!set userID to test for nicolai development purposes
// !!local host development only
$userID = 26;

?>
<script type="text/javascript"
        src="SellerHistoricAuctionsController.js">
</script>

<?php
include '../../config.php';?>
<?php require '../../includes/pagetop.php'; ?>
<link rel="stylesheet" type="text/css" media="screen" href="SellerProfile.css" />

<!--        AUCTION HISTORY TABLE       -->
<h1>Auction History Table</h1>
<div class="tbl-header">
<table cellpadding="0" cellspacing="0" border="0">
<thead>
        <tr>
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Date Product Added</th>
            <th>Date Auction Ended</th>
          <th>Condition</th>
          <th>Sale price</th>
          <th>Winning Bidder</th>
            <th>Number of Bids</th>
            <th>Buyer Feedback Score</th>
            <th>Your Feedback Score</th>

        </tr>
            </thead>

      </div>

      <tbody>
        <tr>

<?php
$dateNow = date("Y-m-d H:i:s");
$getProductDetails = mysqli_query($db,"SELECT a.prod_id, a.prod_name, a.prod_start_date, a.prod_end_date, a.prod_condition, a.prod_highest_price, a.prod_buyerID, COUNT(b.prod_ID) AS bids, c.buyer_feedback_points, c.seller_feedback_points FROM product AS a, feedback AS c LEFT JOIN bids AS b USING(prod_id) WHERE prod_sellerID = (('$userID')) AND '$dateNow' >= prod_end_date");



if (mysqli_num_rows($getProductDetails) > 0) :
        $count=1;
        $dateArray=[];
        while($row = mysqli_fetch_assoc($getProductDetails)) : ?>
            <?php $buyerID = $row['prod_buyerID']?>
            <?php $prodID = $row['prod_id']?>

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
            <td><?php
            if($row['buyer_feedback_points']==NULL){?>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

                <script>
                // function sendFeedbackScore(str) {
                // if (str == "") {
                // document.getElementById("container").innerHTML = "";
                // return;
                // } else {
                // if (window.XMLHttpRequest) {
                // // code for IE7+, Firefox, Chrome, Opera, Safari
                // xmlhttp = new XMLHttpRequest();
                // } else {
                // // code for IE6, IE5
                // xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                // }
                // xmlhttp.onreadystatechange = function() {
                // if (this.readyState == 4 && this.status == 200) {
                // document.getElementById("container").innerHTML = this.responseText;
                // }
                // };
                // xmlhttp.open("POST","postFeedbackScore.php",true);
                // xmlhttp.send();
                // // hide the form and show the posted value
                // }
                // }
$(document).ready(function (){
    $("#score").click(function(){
        $.ajax({
            url: 'postFeedbackScore.php',
            data: {'sellerID': <?php echo $userID?>, 'feedback': $("#score").val(), 'prodID': <?php echo $prodID?>},
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
            } else {echo $row['buyer_feedback_points'];

                }
            ?>
            </td>
            <td><?php echo $row['seller_feedback_points'] ?></td>





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
