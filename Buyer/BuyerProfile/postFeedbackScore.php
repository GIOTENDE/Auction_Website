<?php include '../../config.php';

mysqli_query($db,"INSERT INTO feedback (prod_id, buyer_id, seller_id, buyer_feedback_points, seller_feedback_points) VALUES('1', '1', NULL, NULL, '1') ON DUPLICATE KEY UPDATE buyer_id= '1', '1'");
