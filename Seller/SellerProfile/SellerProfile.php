<?php
include '../../config.php';
session_start();
$userID = $_SESSION['userID'];

$username = "";
$fullname = "";
$dateWOtime = "";
$timeWOdate = "";
$jsformat = "";

$getUserDetails = mysqli_query($db, "SELECT userID, username, fullName FROM users WHERE userID=(('$userID'))");
if (mysqli_num_rows($getUserDetails) > 0) {
    while ($row = mysqli_fetch_assoc($getUserDetails)) {
        //echo "username: " . $row["username"]. " - fullName: " . $row["fullName"] . "<br>";
        $fullname = $row["fullName"];
        $userID = $row["userID"];
    }
} else {
    echo "0 results";
}
$getProductDetails = mysqli_query($db, "SELECT prod_id, prod_name, prod_start_date, prod_end_date, prod_highest_price prod_buyerID FROM product WHERE prod_sellerID=(('$userID'))");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Your Profile</title>
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
            <li class="active"><a href="../../logout.php" class="active"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>

<h1 class="title"><?php echo $fullname; ?>'s Profile</h1>

<!--        Button: ADD NEW ITEM        -->
<div class="containerButton">
    <a href="../SellerCreateNewAuction/SellerCreateNewAuction.php">
        <button id="button">Auction an Item</button>
    </a>
</div>
<br>
<!--        Button: CHANGE SELLER DETAILS -->
<div class="containerButton">
    <a href="../SellerChangeDetails/SellerChangeDetails.php">
        <button id="button">Update Details</button>
    </a>
</div>
<br>
<div class="containerButton">
    <a href="SellerHistoricAuctions.php">
        <button id="button">Your Expired Auctions</button>
    </a>
</div>
<br>

<div class="containerButton">
    <a href="SellerOngoingAuctions.php">
        <button id="button">Your Ongoing Auctions</button>
    </a>
</div>
<br>

