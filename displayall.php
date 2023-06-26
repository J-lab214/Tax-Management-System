
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
  height: 100vh;
  margin-top: 70px;
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
 <!-- <div class="box">-->
  <?php 
include('sort.php'); 
// Read the contents of the ledger.txt file
$ledgerContent = file_get_contents('journal.txt');

// Explode the content into individual rows
$rows = explode("\n", $ledgerContent);

// Start the HTML table0
//echo '<div class="navbox">';
echo '<div class="container">';
echo "<table>";
echo "<tr><th>Account No.</th><th>Transaction ID</th><th>Name</th><th>Date</th><th>Type of Transaction</th><th>Amount</th><th>Tax</th></tr>";

// Loop through each row and display as table rows
foreach ($rows as $row) {
    // Explode the row into individual fields
    $fields = explode("|", $row);

    // Display the fields as table cells
    echo "<tr>";
    foreach ($fields as $field) {
        echo "<td>" . $field . "</td>";
    }
    echo "</tr>";
}

// End the HTML table
echo "</table>";
echo '</div>'; 
?>
  <!--</div>-->
</body>
</html>
