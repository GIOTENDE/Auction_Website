<?php include '../../config.php'; ?>
<?php require '../../includes/pagetop.php'; ?>
<?php include 'searchBarHeader.php';?>
<?php 
//   $query = "SELECT * FROM messages ORDER BY id DESC";
//   $messages = mysqli_query($connection, $query);
?>





<!--<!doctype html>-->
<!--<html>-->
<html lang="en-Us">
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li> <a href="../../logout.php" class="active">Logout</a></li>
            <li> <a href="../BuyerProfile/BuyerChangeDetails.php" class="active">Change Details</></li>
        </ul>
    </div>
</div>
</div>






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



    <div id="container">
        <header>
            <h1>Chat Room</h1>
        </header>
        <div id="messages">
            <ul>
                <?php while($row = mysqli_fetch_assoc($messages)) : ?>
                    <li class="message">
                        <span><?php echo $row['time'] ?> - </span><strong>
                            <?php echo $row['user']?></strong>
                        : <?php echo $row['message'] ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
        <div id="input">
            <?php if (isset($_GET['error'])) : ?>
                <div class="error"><?php echo $_GET['error']; ?></div>
            <?php endif; ?>
            <form method="post" action="process.php">
                <input type="text" id="user" name="user" placeholder="Enter Your Name"/>
                <input type="text" id="newmessage" name="message" placeholder="Enter A Message"/>
                <input id="show-btn" type="submit" name="submit" value="Show It"/>
            </form>
        </div>
    </div>


  </body>
  <?php require '../../includes/footer.php'; ?>
</html>
