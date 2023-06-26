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

  // Read the entries from the journal file
  $entries = file("ledger.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  // Filter and retrieve transactions of the specific user
  $userTransactions = array_filter($entries, function($entry) use ($username) {
    $fields = explode("|", $entry);
    $entryUsername = $fields[0]; // Username is at index 0
    return $entryUsername === $username;
  });

  // Group transactions by month
  $transactionsByMonth = [];
  foreach ($userTransactions as $transaction) {
    $fields = explode("|", $transaction);
    $transactionDate = $fields[3]; // Date is at index 3
    $month = date("F Y", strtotime($transactionDate)); // Format month as "Month Year"
    $transactionsByMonth[$month][] = $fields;
  }
?>



<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>Display Transactions Summary</title>
  <style>
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 20px;
      margin-top: 75px; /* Add margin-top to create a gap */
    }

    table {
      margin: 0 auto;
      background-color: whitesmoke;
      color: blueviolet;
      border-collapse: separate;
      border-spacing: 0;
      border: 1px solid blueviolet;
      border-radius: 10px;
    }

    th,
    td {
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
          <!--<li><a href="modify.php">Modify</a></li>-->
          <li><a href="user_display.php">Display</a></li>
          <li><a href="login.php">Logout</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <?php
// Check if there are transactions for the user
if (empty($transactionsByMonth)) {
  echo "<h2>No transactions found for this user.</h2>";
} else {
  // Loop through the transactions by month and display them in tables
  foreach ($transactionsByMonth as $month => $transactions) {
    echo '<div class="container">';
    echo "<table>";
    echo "<tr><th colspan='7' style='text-align: center; font-weight: bold;'>$month Transactions</th></tr>";
    //echo "<tr><td colspan='7'>USERNAME: $username</td></tr>";
    echo "<tr><th colspan='7' style='text-align: center; font-weight: bold;'>USERNAME: $username</th></tr>";
    echo "<tr><th>Account No.</th><th>Transaction ID</th><th>Name</th><th>Date</th><th>Type of Transaction</th><th>Amount</th><th>Tax</th></tr>";

    foreach ($transactions as $transaction) {
      echo "<tr>";
      foreach ($transaction as $field) {
        echo "<td>$field</td>";
      }
      echo "</tr>";
    }

    // Calculate and display total tax
    $totalTax = array_sum(array_column($transactions, 6)); // Sum the tax column (index 6)
    echo "<tr><td colspan='7'style='text-align: center; font-weight: bold;'>TOTAL TAX: ₹ $totalTax</td></tr>";
    //echo "<tr><th colspan='7' style='text-align: center; font-weight: bold;'>$month Transactions</th></tr>";
    echo "</table>";
    echo '</div>';
  }

  // Calculate the total tax for the year
  $totalTaxYear = 0;
  foreach ($transactionsByMonth as $transactions) {
    $totalTaxMonth = array_sum(array_column($transactions, 6)); // Sum the tax column (index 6)
    $totalTaxYear += $totalTaxMonth;
  }

  // Add the table for total tax for the year
  echo '<div class="container">';
  echo "<table>";
  echo "<tr><th colspan='2'>Total Tax for the Year</th></tr>";
  echo "<tr><td>Username:</td><td>$username</td></tr>";
  echo "<tr><td>Total Tax:</td><td>$totalTaxYear</td></tr>";
  echo "</table>";
  echo '</div>';
}
?>

</body>
</html>
