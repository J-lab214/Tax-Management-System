<?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accountNo = $_POST['account_no'];
    $transactionID = $_POST['trid'];

    // Check if the transaction ID already exists in the journal file
    $entries = file("journal.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($entries as $entry) {
      $fields = explode("|", $entry);
      $existingTransactionID = $fields[1]; // Transaction ID is at index 1

      if ($existingTransactionID == $transactionID) {
        $errorMessage = 'Error: Transaction ID already exists.';
        break;
      }
    }

    if (!isset($errorMessage)) {
      // Continue with saving the entry if the transaction ID is unique
      include 'config.php';
    }
  }
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
    <h2>Add entry</h2>
    <?php
      if (isset($errorMessage)) {
        echo '<div class="error-message">' . $errorMessage . '</div>';
      }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="input-box">
        <input type="text" name="account_no" autocomplete="off" required>
        <label for="">PAN Number</label>
      </div>
      <div class="input-box">
        <input type="number" name="trid" autocomplete="off" required>
        <label for="">Transaction ID</label>
      </div>
      <div class="input-box">
        <input type="text" name="name" autocomplete="off" required>
        <label for="">Name</label>
      </div>
      <div class="input-box">
        <br>
        <input type="date" name="date" autocomplete="off" required>
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
        <input type="number" name="amount" autocomplete="off" required>
        <label for="">Amount</label>
      </div>
      <input type="submit" value="Save">
    </form>
  </div>
</body>
</html>
