<?php

include '../../config.php';

$postFeedbackScore = mysqli_query($db,"UPDATE feedback SET buyer_id = ". $_POST['buyerID'] ." , buyer_feedback_points = ". $_POST['feedback'] ." WHERE prod_id = ". $_POST['prodID'] ." ");

