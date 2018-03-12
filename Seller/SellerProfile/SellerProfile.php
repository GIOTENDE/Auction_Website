<?php 
include '../../config.php'; 

session_start();
$userID = $_SESSION['userID'];

$username="";
$fullname = "";
$dateWOtime = "";
$timeWOdate = "";
$jsformat="";
//echo $_SESSION['username'];

//
$getUserDetails = mysqli_query($db,"SELECT userID, username, fullName FROM users WHERE userID=(('$userID'))");
if (mysqli_num_rows($getUserDetails) > 0) {
    while($row = mysqli_fetch_assoc($getUserDetails)) {
        //echo "username: " . $row["username"]. " - fullName: " . $row["fullName"] . "<br>";
        $fullname = $row["fullName"];
        $userID = $row["userID"];
    }
} else {
    echo "0 results";
}
$getProductDetails = mysqli_query($db,"SELECT prod_id, prod_name, prod_start_date, prod_end_date, prod_highest_price prod_buyerID FROM product WHERE prod_sellerID=(('$userID'))");
?>

<!--    HEADER      -->
<link rel="stylesheet" href="includes/styleheader.css">
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li href="../../logout.php" class="active"><a>Logout</a></li>
          </ul>
        </div>
      </div>
  </div>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Seller Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="SellerProfile.css" />
    <!-- <script src="SellerProfile.js"></script> -->
</head>
<body>

<h1 class="title"><?php echo $fullname;?>'s Seller Profile</h1> 
<h3 class="title"><?php echo $fullname;?>'s user id:<?php echo $userID;?></h3> 

<!--        Button: ADD NEW ITEM        -->
<div id="button"> 
    <a href="../SellerCreateNewAuction/SellerCreateNewAuction.php">Auction an Item!</a>
</div>
<br>
<!--        Button: CHANGE SELLER DETAILS -->
<div id="button"> 
    <a href="../SellerChangeDetails/SellerChangeDetails.php">Change Customer Details</a>
</div>
<br>
<!--        AUCTION HISTORY TABLE       -->
<h1>Auction History Table</h1>
<div class="tbl-header">
<table cellpadding="0" cellspacing="0" border="0">
<thead>
        <tr>
          <th>Product ID</th>
          <th>Product Title</th>
          <th>Product Added</th>
          <th>State</th>
          <th>Current Price</th>
          <th>Number of Bids</th>
          <th>Winning Bidder</th>
          <th>Feedback Score</th>
          <th>Feedback Comments</th>
        </tr>
            </thead>
       
      </div>
    
      <tbody>
        <tr>
          
<?php if (mysqli_num_rows($getProductDetails) > 0) : 
        $count=1;
        $dateArray=[];
        while($row = mysqli_fetch_assoc($getProductDetails)) : ?>

        <!--    PRODUCT ID COLUMN    -->
          <td><?php echo $row['prod_id'] ?></td>
          <!--    PRODUCT TITLE COLUMN    -->
          <td><?php echo $row['prod_name'] ?></td>
          <!--    PRODUCT START DATE COLUMN    -->
          <td><?php echo $row['prod_start_date'] ?></td>
           <!--    PRODUCT STATE COLUMN    -->
          <td><?php
          //format end date
            $unformattedDate=$row['prod_end_date'];
        //     $splitDate = explode("T", $unformattedDate);
        //     $dateWOtime=$splitDate[0];
        //     $timeWOdate=$splitDate[1];
        //     $splitDateMore = explode("-", $dateWOtime);
        //     $date = $splitDateMore[2]."-".$splitDateMore[1]."-".$splitDateMore[0];
        //     $correctDate=$date." ".$timeWOdate;
        //    // echo $correctDate;
        //     $convertdate=date_create_from_format("d-m-Y H:i", $correctDate);
        //     //end date 
        //     $converteddate=$convertdate->format("d-m-Y H:i");
            $today= new DateTime();
            $dateEnd= new DateTime($unformattedDate);
            $remaining=$today->diff($dateEnd);
            if ($today<$dateEnd){
            echo $unformattedDate."<br>";
            echo $remaining->format('%d d %h h %i m');
            }else{
                echo $unformattedDate."<br>";
            echo "<p class='incomplete'>Auction Ended!<p>";
            }

            // $days_remaining = floor($remaining / 86400);
            // $hours_remaining = floor(($remaining % 86400) / 3600);
            // $minutes_remaining = floor(($remaining % 86400) / 3600/3600);

            // echo "Time left: ".$days_remaining." days ".$hours_remaining." hrs ".$minutes_remaining." min";


            //JavaScript format 
            //$jsFormat = $convertdate-> format('M d, Y H:i:s');

            

//            array_push( $dateArray, $jsFormat);
            //print_r($dateArray);
          //$countdowntag = "countdown".$count;
          
          //  echo "<p id=$countdowntag></p>";
           
            //echo $convertdate-> format('M d, Y H:i:s');
              ?>

                <!--p id="countdown"></p-->

            </td>
             <!--    PRODUCT CURRENT PRICE COLUMN    -->
          <td><?php 
          if (empty($row['prod_highest_price'])){
              echo "<p class='incomplete'>Auction has not ended!</p>";
          }else{
          echo  '£'.$row['prod_highest_price'];
          }
          ?></td>
           <!--    PRODUCT BUYER COLUMN    -->
          <td><?php echo $row['prod_buyerID'] ?></td>

        </tr>
       <?php $count+=1; endwhile;
     else : 
        echo "no results";
     endif;  
?>
        </tbody>
    </table>
  

<!--        FEEDBACK TABLE   ?????    -->

</body>

<script type ="text/javascript">
                
                // End date
                var countDownDate = new Date('<?php echo $convertdate-> format('M d, Y H:i:s');?>').getTime();

                //var c = <!--?php echo json_encode($count); ?-->;
               // document.getElementById('countdown').innerHTML = c;
                // Update the count down every 1 second
                var x = setInterval(function() {

                // Today's date
                var now = new Date().getTime();

                // Find the difference between now an the count down date
                var difference = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(difference / (1000 * 60 * 60 * 24));
                var hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((difference % (1000 * 60)) / 1000);

                // Output the result in an element with id='countdown'
                document.getElementById('countdown').innerHTML = days + 'd ' + hours + 'h '
                + minutes + 'm ' + seconds + 's ';

                // If the count down is over, write some text 
                if (difference < 0) {
                clearInterval(x);
                document.getElementById('countdown').innerHTML = 'EXPIRED';
                }
                 }, 1000);
                
                </script>
<!--        FOOTER          -->
</html>