<?php 
include('passvalid.php'); 
?>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
  <style>
        .error-message {
            color: white;
        }
    </style>
    
</head>
<body>
<!--<header>
    <nav>
    <div class="navbox">
      <ul>
        <li><a href="index.php">Add</a></li>
        <li><a href="search.php">Search</a></li>
        <li><a href="delete.php">Delete</a></li>
        <li><a href="modify.php">Modify</a></li>
        <li><a href="display.php">Display</a></li>
      </ul>
    </div>
    </nav>
  </header>-->
  <h1><center style="color:aliceblue; font: size 150px;">Tax Management System</center></h1>
  <div class="box">
    <h2>Login</h2>
    <form method = post action="passvalid.php">
    <?php
        if (isset($_GET['error'])) {
            echo '<p class="error-message">' . $_GET['error'] . '</p>';
        }
        ?>
    <div class="input-box">
        <input type="text" name="username"  autocomplete="off" required>
        <label for="">PAN Number/Username</label>
      </div>
      <div class="input-box">
        <input type="password" name="password"  autocomplete="off" required>
        <label for="">Password</label>
      </div>
      <!--<div class="input-box">
        <br>
        <input type="date" name="date"  autocomplete="off" required>
        <label for="">Date of Transaction</label>
      </div>
      <div class="input-box">
        <br><br>
    <select name="typet" id="Transactions"> 
        <option value="Tax Deducted at Source">Tax Deducted at Source</option> 
        <option value="Cash Deposit">Cash Deposit</option> 
        <option value="Gold Purchase">Gold Purchase</option> 
        <option value="International Travel">International Travel</option> 
        <option value="Donations">Donations</option>
    </select>
    <br>
        <label for="">Type of Transaction</label>
        <br>
      </div>
      <div class="input-box">
        <input type="Number" name="amount"  autocomplete="off" required>
        <label for="">Amount</label>
      </div>-->
        <input type="submit" value="Login" >
    </form>
  </div>
</body>
</html>
