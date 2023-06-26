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
    <h2>Search</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
    <div class="input-box">
        <input type="Text" name="account_no"  autocomplete="off" required>
        <label for="">Enter PAN Number to Search</label>
      </div>
   
        <input type="submit" value="Search">
        </div> 
    </form>
  
  <?php
    if(isset($_GET['account_no'])){
        $searched_account = $_GET['account_no'];
        
        // Read the entries from the file
        $entries = file("journal.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Array to store matched entries
        $matchedEntries = [];

        // Loop through each entry and check for a match with the searched account number
        foreach ($entries as $entry) {
            $fields = explode("|", $entry);
            $accountNo = $fields[0]; // Account number is at index 0

            if ($accountNo == $searched_account) {
                $matchedEntries[] = $entry;
            }
        }

        if (count($matchedEntries) > 0) {
            // Display the matched entries as a table
            echo '<div class="container">';
            echo "<table>";
            echo "<tr><th>Account No.</th><th>Transaction ID</th><th>Name</th><th>Date</th><th>Type of Transaction</th><th>Amount</th><th>Tax</th></tr>";

            foreach ($matchedEntries as $matchedEntry) {
                $fields = explode("|", $matchedEntry);
                echo "<tr>";
                echo "<td>" . $fields[0] . "</td>"; // Account number is at index 0
                echo "<td>" . $fields[1] . "</td>"; // Name is at index 1
                echo "<td>" . $fields[2] . "</td>"; // Date is at index 2
                echo "<td>" . $fields[3] . "</td>"; // Type of transaction is at index 3
                echo "<td>" . $fields[4] . "</td>"; // Amount is at index 4
                echo "<td>" . $fields[5] . "</td>";
                echo "<td>" . $fields[6] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
            echo '</div>';
        } else {
          echo '<div class="container">';
          echo "<table>";
          echo "<tr><th>There are no transactions under this PAN. Please re-enter PAN Number</th></tr>";
          echo "</table>";
          echo '</div>';
        }
    }
?>


</body>
</html>
