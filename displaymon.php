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
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
    margin-top: 70px; /* Add margin-top to create a gap */
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

  <?php 
    include('sort.php'); 

    // Read the contents of the ledger.txt file
    $ledgerContent = file_get_contents('ledger.txt');

    // Explode the content into individual rows
    $rows = explode("\n", $ledgerContent);

    // Create an empty array to store tables for each month
    $monthlyTables = [];

    // Loop through each row and categorize by month
    foreach ($rows as $row) {
      // Explode the row into individual fields
      $fields = explode("|", $row);

      // Check if the fields array has enough elements
      if (count($fields) >= 4) {
        // Get the month from the date field (assuming it's at index 3)
        $date = $fields[3];
        $month = date('F', strtotime($date));

        // Add the row to the corresponding month's table
        $monthlyTables[$month][] = $row;
      }
    }

    // Define an array of months in the desired order
    $monthsInOrder = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    // Display tables for each month in the desired order
    foreach ($monthsInOrder as $month) {
      if (isset($monthlyTables[$month])) {
        // Start the HTML table for the month
        echo '<div class="container">';
        echo "<table>";
        echo "<tr><th colspan='7'>$month Transactions</th></tr>";
        echo "<tr><th>Account No.</th><th>Transaction ID</th><th>Name</th><th>Date</th><th>Type of Transaction</th><th>Amount</th><th>Tax</th></tr>";

        // Loop through each row in the month's table and display as table rows
        foreach ($monthlyTables[$month] as $row) {
          // Explode the row into individual fields
          $fields = explode("|", $row);

          // Display the fields as table cells
          echo "<tr>";
          foreach ($fields as $field) {
            echo "<td>" . $field . "</td>";
          }
          echo "</tr>";
        }

        // End the HTML table for the month
        echo "</table>";
        echo '</div>';
      }
    }
  ?>

</body>
</html>
