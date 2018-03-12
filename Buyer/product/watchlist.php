<?php include '../../config.php';

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'save':
            save($db);
            break;
        case 'remove':
            remove($db);
            break;
    }
}

function save($db)
{
    $sql = "INSERT INTO watchlist VALUES ('" . $_POST['buyer_ID'] . "', '" . $_POST['prod_ID'] . "')";
    $result = mysqli_query($db, $sql);
    exit;
}

function remove($db)
{
    $sql = "DELETE FROM watchlist WHERE buyer_id = '" . $_POST['buyer_ID'] . "' AND prod_id = '" . $_POST['prod_ID'] . "'";
    $result = mysqli_query($db, $sql);
    exit;
}

?>