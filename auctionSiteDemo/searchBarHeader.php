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
        <h1>Auction Site</h1>
          <h3>Find yourself a deal!!</h3>
      </header>
      <div id="searchBar">

        <ul>
            <input type="text" id="search" name="search" placeholder="Search for an item"/>
            <select name="categories">
                <option value="All Categories">All Categories</option>
                <option value="Antiques">Antiques</option>
                <option value="Home & Garden">Home & Garden</option>
                <option value="Sports & Active Goods">Sports & Active Goods</option>
                <option value="Electronics">Electronics</option>
                <option value="Jewellery & Watches">Jewellery & Watches</option>
                <option value="Toys & Games">Toys & Games</option>
                <option value="Fashion">Fashion</option>
                <option value="Fashion">Fashion</option>
                <option value="Other">Other</option>
            </select>
            <input id="show-btn" type="submit" name="submit" value="Search"/>
        </ul>

      </div>
    </div>
