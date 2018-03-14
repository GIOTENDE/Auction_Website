<?php include '../../config.php';

//get user that has been outbid
include 'outbidEmail.php';

//insert into bids table
$seller_ID = 26; //delete this column from table?

$insertBid = "INSERT INTO bids (prod_id, buyer_id, seller_id, amount) VALUES ('" . $_POST['prod_ID'] . "', '" . $_POST['buyer_ID'] . "', '26', '" . $_POST['amount'] . "')";
mysqli_query($db, $insertBid);

//update product table
$updateProduct = "UPDATE product SET prod_highest_bid = '" . $_POST['amount'] . "', prod_buyerID = '" . $_POST['buyer_ID'] . "' WHERE prod_id = '" . $_POST['prod_ID'] . "' ";
mysqli_query($db, $updateProduct);