<?php

include '../../config.php';

$postFeedbackScore = mysqli_query($db,"UPDATE feedback SET seller_id = ". $_POST['sellerID'] ." , buyer_feedback_points = ". $_POST['feedback'] ." WHERE prod_id = ". $_POST['prodID'] ." ");

