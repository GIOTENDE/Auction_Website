<?php include '../../config.php';

date_default_timezone_set('Europe/London');
$dateNow = date("Y-m-d H:i:s");
$sql = "SELECT prod_id FROM product WHERE prod_buyerID = ". $_POST['buyerID'] ." AND '$dateNow' >= prod_end_date";
$result = mysqli_query($db, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $prod_id = $row["prod_id"];
}

$postFeedbackScore = mysqli_query($db,"INSERT INTO feedback 
(prod_id, buyer_id, seller_id, buyer_feedback_points, 
seller_feedback_points)
VALUES(". $prod_id .", ". $_POST['buyerID'] .", NULL, NULL, ". $_POST['feedback'] .") ON DUPLICATE KEY UPDATE
buyer_id= ". $_POST['buyerID'] .", seller_feedback_points= ". $_POST['feedback'] ." ");