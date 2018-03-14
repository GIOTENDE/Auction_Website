<?php include '../../config.php';

$sql = "SELECT prod_highest_bid FROM product WHERE prod_id = '" . $_POST['prod_ID'] . "'";
$result = mysqli_query($db, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $prod_highest_bid = $row["prod_highest_bid"];
}
echo $prod_highest_bid;
?>
