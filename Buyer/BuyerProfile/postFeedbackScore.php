<?php

include '../../config.php';
//
//$postFeedbackScore = mysqli_query($db,"REPLACE INTO feedback
//(prod_id, buyer_id, seller_feedback_points)
//VALUES( " . $_POST['prodID']. ", ". $_POST['buyerID'] .", ". $_POST['feedback'] ." ) ");


$postFeedbackScore = mysqli_query($db,"INSERT INTO feedback 
(prod_id, buyer_id, seller_id, buyer_feedback_points, 
seller_feedback_points)
VALUES(" . $_POST['prodID']. ", ". $_POST['buyerID'] .", NULL, NULL, ". $_POST['feedback'] .") ON DUPLICATE KEY UPDATE
buyer_id= ". $_POST['buyerID'] .", seller_feedback_points= ". $_POST['feedback'] ." ");