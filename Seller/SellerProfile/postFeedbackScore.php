<?php

include '../../config.php';

//$postFeedbackScore = mysqli_query($db,"REPLACE INTO feedback (prod_id, seller_id, buyer_feedback_points) VALUES( " . $_POST['prodID']. ", ". $_POST['sellerID'] .", ". $_POST['feedback'] ." ) ");

$postFeedbackScore = mysqli_query($db,"INSERT INTO feedback 
(prod_id, buyer_id, seller_id, buyer_feedback_points, 
seller_feedback_points)
VALUES(" . $_POST['prodID']. ", NULL, ". $_POST['sellerID'] .", ". $_POST['feedback'] .", NULL) ON DUPLICATE KEY UPDATE
seller_id= ". $_POST['sellerID'] .", buyer_feedback_points= ". $_POST['feedback'] ." ");