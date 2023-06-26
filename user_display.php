<?php
  session_start(); // Start the session

  // Check if the user is authenticated and retrieve the username
  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
  } else {
    // If the user is not authenticated, redirect to the login page
    header('Location: login.php');
    exit();
  }
?>

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
          <li><a href="user_index.php">Add</a></li>
          <li><a href="user_search.php">Search</a></li>
          <!--<li><a href="delete.php">Delete</a></li>-->
          <!--<li><a href="modify.php">Modify</a></li>-->
          <li><a href="user_display.php">Display</a></li>
          <li><a href="login.php">Logout</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <div class="box">
    <h2>Display</h2>
    <div class="input-box">
      <form action="displaymonuser.php" method="POST">
        <input type="hidden" name="username" value="<?php echo $username; ?>">
        <input type="submit" value="Display Monthly">
      </form>
      <form action="displaysumm.php">
        <!--<input type="submit" value="Display All">-->
      </form>
      <form action="displaysumm.php">
        <input type="submit" value="Summary">
      </form>
    </div>
  </div>
</body>
</html>
