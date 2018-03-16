<?php include '../../config.php';

date_default_timezone_set('Europe/London');
$dateNow = date("Y-m-d H:i:s");
$sql = "SELECT prod_id FROM product WHERE prod_sellerID = ". $_POST['sellerID'] ." AND '$dateNow' >= prod_end_date";
$result = mysqli_query($db, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $prod_id = $row["prod_id"];
}


$postFeedbackScore = mysqli_query($db,"INSERT INTO feedback 
(prod_id, buyer_id, seller_id, buyer_feedback_points, 
seller_feedback_points)
VALUES(" . $prod_id . ", NULL, ". $_POST['sellerID'] .", ". $_POST['feedback'] .", NULL) ON DUPLICATE KEY UPDATE
seller_id= ". $_POST['sellerID'] .", buyer_feedback_points= ". $_POST['feedback'] ." ");