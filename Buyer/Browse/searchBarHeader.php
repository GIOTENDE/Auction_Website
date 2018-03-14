<?php
?>

<!doctype html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <head>
    <meta charset="utf-8"/>
    <title>Buyer Search</title>
    <link rel="stylesheet" href="style.css" type="text/css">
  </head>
  <body>


    <div id="container">
      <header>
          <h3>Find yourself a deal!!</h3>
      </header>
      <div id="searchBar">

        
            <form action="dynamicProductList.php" method ="post">
            <input type="text" id="search" name="search" placeholder="Search for an item"/>


            <select name="searchCategories">
                <option value="*">All Categories</option>
                <option value="Collectables and antiques">Antiques</option>
                <option value="Home and Garden">Home & Garden</option>
                <option value="Sporting Goods">Sports & Active Goods</option>
                <option value="Electronics">Electronics</option>
                <option value="Jewellery and Watches">Jewellery & Watches</option>
                <option value="Toys and Games">Toys & Games</option>
                <option value="Fashion">Fashion</option>
                <option value="Motors">Motors</option>
                <option value="Other">Other</option>
            </select>
            <input id="show-btn" type="submit" name="submit" value="Search">
      </div>
    </div>
            </form>
      





