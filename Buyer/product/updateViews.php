<?php include '../../config.php';

// get prod_views

$getViews = "SELECT prod_views FROM product WHERE prod_id = '" . $_POST['prod_ID'] . "'";
$result = mysqli_query($db, $getViews);
while ($row = mysqli_fetch_assoc($result)) {
    $GLOBALS['prod_views'] = $row["prod_views"];
}
$new_prod_views = $GLOBALS['prod_views'] + 1;

$updateViews = "UPDATE product SET prod_views = '" . $new_prod_views . "' WHERE prod_id = '" . $_POST['prod_ID'] . "'";
mysqli_query($db, $updateViews);

?>