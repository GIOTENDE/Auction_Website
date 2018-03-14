k<?php 
include '../../config.php'; 

session_start();
$_SESSION['userID'] = 33;
$userID = $_SESSION['userID'];

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
        $fullname = $row["fullName"];
        $userID = $row["userID"];
    }
} else {
    echo "0 results";
}
?>

<!--    HEADER      -->
<link rel="stylesheet" href="includes/styleheader.css">
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Auction Website</a>
        </div>
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li class="active"><a href="../../logout.php">Logout</a></li>
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
<br>
<br>
<h1 class="title"><?php echo $fullname;?>'s Buyer Profile</h1>
<h3 class="title"><?php echo $fullname;?>'s user id:<?php echo $userID;?></h3> 

<!--        Button: ADD NEW ITEM        -->
<div class="containerButton"> 
    <a href="../Browse/categoryGallery.php"><button id="button">Browse Items</Button></a>
</div>
<br>
<!--        Button: CHANGE SELLER DETAILS -->
<div class="containerButton"> 
    <a href="../BuyerChangeDetails/BuyerChangeDetails.php"><button id="button">Change Details</button></a>
</div>
<br>
<div class="containerButton">
    <a href="BuyerHistoricAuctions.php"><button id="button"> Previous Auctions</button></a>
</div>
<br>

<div class="containerButton">
    <a href="BuyerOngoingAuctions.php"><button id="button">Current Auctions</button></a>
</div>

