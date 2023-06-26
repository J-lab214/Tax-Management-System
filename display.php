<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>
<body>
<header>
    <nav>
    <div class="navbox">
      <ul>
        <li><a href="index.php">Add</a></li>
        <li><a href="search.php">Search</a></li>
        <!--<li><a href="delete.php">Delete</a></li>-->
        <li><a href="modify.php">Modify</a></li>
        <li><a href="display.php">Display</a></li>
        <li><a href="login.php">Logout</a></li>
      </ul>
    </div>
    </nav>
  </header>
  <div class="box">
    <h2>Display</h2>
    
    <div class="input-box">
    <form action="displaymon.php">
    <input type="submit" value="Display Monthly" action></form>
    <form action="displayall.php">
    <input type="submit" value="Display All Transactions (Journal)"></form>
    <form action="displayledger.php">
    <input type="submit" value="Display All Transactions (Ledger)"></form>
  </div>
</body>
</html>
