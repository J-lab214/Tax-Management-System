<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted form data
    $typeOfTransaction = $_POST['type_of_transaction'];

    // Get the transaction ID from the URL parameter
    $transactionID = $_GET['transaction_id'];

    // Read the entries from the file
    $entries = file("journal.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Loop through each entry and check for a match with the transaction ID
    foreach ($entries as &$entry) {
        $fields = explode("|", $entry);
        $existingTransactionID = $fields[1]; // Transaction ID is at index 1

        if ($existingTransactionID == $transactionID) {
            // Update the type of transaction
            $fields[4] = $typeOfTransaction;
            $entry = implode("|", $fields);
            break;
        }
    }

    // Write the updated entries back to the file
    file_put_contents("journal.txt", implode("\n", $entries));
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Edit Transaction</title>
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
        <h2>Edit Transaction</h2>
        <?php
        // Check if the transaction ID is available in the URL parameters
        if (isset($_GET['transaction_id'])) {
            // Get the transaction ID from the URL
            $transactionID = $_GET['transaction_id'];

            // Display the transaction ID
            echo '<p style="color: white;">Transaction ID: ' . $transactionID . '</p>';

        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] . '?transaction_id=' . $transactionID; ?>" method="POST">
            <div class="input-box">
                <br>
                <select name="type_of_transaction" autocomplete="off" required> 
                    <option value="Tax Deducted at Source">Tax Deducted at Source</option> 
                    <option value="Cash Deposit">Cash Deposit</option> 
                    <option value="Gold Purchase">Gold Purchase</option> 
                    <option value="International Travel">International Travel</option> 
                    <option value="Donations">Donations</option>
                </select>
                <br>
                <br>
                <label for="">Enter New Type of Transaction</label>
                <br>
            </div>

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
