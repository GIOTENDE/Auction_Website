<?php

include '../../config.php';

$postFeedbackScore = mysqli_query($db,"UPDATE feedback SET seller_id = $sellerID, buyer_feedback_points = $feedbackScore WHERE prod_id = $prodID");
