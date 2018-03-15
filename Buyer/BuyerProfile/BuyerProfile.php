<?php
include '../../config.php'; 

session_start();
$userID = $_SESSION['userID'];

$username="";
$fullname = "";
$dateWOtime = "";
$timeWOdate = "";
$jsformat="";

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

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Seller Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="SellerProfile.css" />
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

<h1 class="title"><?php echo $fullname;?>'s Profile</h1>

<div class="containerButton"> 
    <a href="../Browse/categoryGallery.php"><button id="button">Browse Items</Button></a>
</div>
<br>

<div class="containerButton"> 
    <a href="../BuyerChangeDetails/BuyerChangeDetails.php"><button id="button">Update Details</button></a>
</div>
<br>
<div class="containerButton">
    <a href="BuyerHistoricAuctions.php"><button id="button">Expired Auctions</button></a>
</div>
<br>

<div class="containerButton">
    <a href="BuyerOngoingAuctions.php"><button id="button">Ongoing Auctions</button></a>
</div>

