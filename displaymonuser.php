<?php
  // Retrieve the username from the POST request
  $username = $_POST['username'];

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
  <title>Display Transactions by Month</title>
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
        echo "<tr><th colspan='7'>$month Transactions</th></tr>";
        echo "<tr><th>Account No.</th><th>Transaction ID</th><th>Name</th><th>Date</th><th>Type of Transaction</th><th>Amount</th><th>Tax</th></tr>";

        foreach ($transactions as $transaction) {
          echo "<tr>";
          foreach ($transaction as $field) {
            echo "<td>$field</td>";
          }
          echo "</tr>";
        }

        echo "</table>";
        echo '</div>';
      }
    }
  ?>
</body>
</html>
