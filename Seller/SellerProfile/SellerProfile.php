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

<div id="button">
    <a href="SellerHistoricAuctions.php">View historic auctions on your past items</a>
</div>

<div id="button">
    <a href="SellerOngoingAuctions.php">View current auctions</a>
</div>

