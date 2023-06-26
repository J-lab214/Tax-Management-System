<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
  <style>
.container {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  height: 100vh;
  margin-left: 5%;
}

table {
  margin-right: auto;
  background-color: whitesmoke;
  color: blueviolet;
  border-collapse: separate;
  border-spacing: 0;
  border: 1px solid blueviolet;
  border-radius: 10px;
}

th, td {
  padding: 10px;
  border-bottom: 1px solid blueviolet;
}

th {
  background-color: whitesmoke;
}

tr:last-child td {
  border-bottom: none;
}

tr:nth-child(even) {
  background-color: whitesmoke;
}
.error-message {
            color: white;
        }


</style>
</head>
<body>
<header>
    <nav>
    <div class="navbox">
      <ul>
        <li><a href="user_index.php">Add</a></li>
        <li><a href="user_search.php">Search</a></li>
        <!--<li><a href="delete.php">Delete</a></li>-->
        <li><a href="user_display.php">Display</a></li>
        <li><a href="login.php">Logout</a></li>
      </ul>
    </div>
    </nav>
  </header>
  
  <div class="box">
    <h2>Search</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
      <div class="input-box">
        <input type="number" name="transaction_id" autocomplete="off" required>
        <label for="">Enter Transaction ID to Search</label>
      </div>
      <input type="submit" value="Search">
    </form>
    </div>
    <?php
  // Start the session
  session_start();

  // Check if the username is stored in the session
  if (!isset($_SESSION['username'])) {
    // Redirect the user or handle the case when the username is not set
    // For example:
    header('Location: login.php');
    exit();
  }

  // Retrieve the username from the session
  $username = $_SESSION['username'];

  // Check if the transaction ID is provided in the search form
  if (isset($_GET['transaction_id'])) {
    $searched_transaction_id = $_GET['transaction_id'];

    // Read the entries from the file
    $entries = file("ledger.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Array to store matched entries
    $matchedEntries = [];

    // Loop through each entry and check for a match with the searched transaction ID and username
    foreach ($entries as $entry) {
      $fields = explode("|", $entry);
      $transactionID = $fields[1]; // Transaction ID is at index 1
      $entryUsername = $fields[0]; // Username is at index 0

      if ($transactionID == $searched_transaction_id && $entryUsername === $username) {
        $matchedEntries[] = $entry;
      }
    }

    echo "<div class='container'>";
    if (count($matchedEntries) > 0) {
      // Display the matched entries as a table
      echo "<table>";
      echo "<tr><th>Account No.</th><th>Transaction ID</th><th>Name</th><th>Date</th><th>Type of Transaction</th><th>Amount</th><th>Tax</th></tr>";

      foreach ($matchedEntries as $matchedEntry) {
        $fields = explode("|", $matchedEntry);
        echo "<tr>";
        echo "<td>" . $fields[0] . "</td>"; // Account number is at index 0
        echo "<td>" . $fields[1] . "</td>"; // Transaction ID is at index 1
        echo "<td>" . $fields[2] . "</td>"; // Name is at index 2
        echo "<td>" . $fields[3] . "</td>"; // Date is at index 3
        echo "<td>" . $fields[4] . "</td>"; // Type of transaction is at index 4
        echo "<td>" . $fields[5] . "</td>"; // Amount is at index 5
        echo "<td>" . $fields[6] . "</td>"; // Tax is at index 6
        echo "</tr>";
      }

      echo "</table>";
    } else {
      echo "<table>";
      echo "<tr><th>No transactions found for the provided Transaction ID under the username: $username. Please re-enter.</th></tr>";
      echo "</table>";
    }
    echo "</div>";
  }
?>

  
</body>
</html>
