<?php include '../../config.php';

session_start();
$userID = $_SESSION['userID'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Auction Categories</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand">Auction Website</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="../BuyerProfile/BuyerProfile.php"><span class="glyphicon glyphicon-user"></span>
                    My Account</a></li>
            <li><a href="../../logout.php" class="active"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
            </li>
        </ul>
    </div>
</nav>

<?php include 'searchBarHeader.php'; ?>

<div id="container2">
    <div class="gallery">
        <a href="dynamicProductList.php?category=Collectables and antiques">
            <img src="Images/pic_antique.jpg" alt="Collectables and antiques" width="300" height="200">
        </a>
        <div class="desc">Collectables and antiques</div>
    </div>

    <div class="gallery">
        <a href="dynamicProductList.php?category=Home and Garden">
            <img src="Images/pic_homeGarden.jpg" alt="Home and Garden" width="300" height="200">
        </a>
        <div class="desc">Home & Garden</div>
    </div>

    <div class="gallery">
        <a href="dynamicProductList.php?category=Sporting Goods">
            <img src="Images/pic_sport.jpg" alt="Sporting Goods" width="300" height="200">
        </a>
        <div class="desc">Sporting Goods</div>
    </div>

    <div class="gallery">
        <a href="dynamicProductList.php?category=Electronics">
            <img src="Images/pic_electronics.jpg" alt="Electronics" width="300" height="200">
        </a>
        <div class="desc">Electronics</div>
    </div>

    <div class="gallery">
        <a href="dynamicProductList.php?category=Jewellery and Watches">
            <img src="Images/pic_jAndW.jpg" alt="Jewellery and Watches" width="300" height="200">
        </a>
        <div class="desc">Jewellery and Watches</div>
    </div>

    <div class="gallery">
        <a href="dynamicProductList.php?category=Toys and Games">
            <img src="Images/pic_toysAndGames.jpg" alt="Toys and Games" width="300" height="200">
        </a>
        <div class="desc">Toys and Games</div>
    </div>

    <div class="gallery">
        <a href="dynamicProductList.php?category=Fashion">
            <img src="Images/pic_fashion.jpg" alt="Fashion" width="300" height="200">
        </a>
        <div class="desc">Fashion</div>
    </div>

    <div class="gallery">
        <a href="dynamicProductList.php?category=Motors">
            <img src="Images/pic_vehicles.jpg" alt="Motors" width="300" height="200">
        </a>
        <div class="desc">Motors</div>
    </div>

    <div class="gallery">
        <a href="dynamicProductList.php?category=Other">
            <img src="Images/pic_other.jpg" alt="Other" width="300" height="200">
        </a>
        <div class="desc">Other</div>
    </div>
</div>
</body>
</html>
