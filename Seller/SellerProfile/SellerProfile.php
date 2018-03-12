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
?>

<!--    HEADER      -->
<?php require '../../includes/pagetop.php'; ?>

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

