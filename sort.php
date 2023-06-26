<?php
// Read rows from journal.txt file
$rows = file('journal.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Array to store unpacked data
$ledgerData = array();

// Unpack and process each row
foreach ($rows as $row) {
    // Unpack row data using the delimiter "|"
    $data = explode('|', $row);

    // Extract the account number
    $accountNo = trim($data[0]);

    // Store the unpacked data in the ledger array
    $ledgerData[$accountNo][] = array(
        'account_no' => $accountNo,
        'tid' => trim($data[1]),
        'name' => trim($data[2]),
        'date' => trim($data[3]),
        'type_of_transaction' => trim($data[4]),
        'amount' => trim($data[5]),
        'tax' => trim($data[6])
    );
}

// Define a custom comparison function for account numbers
function compareAccountNumbers($a, $b) {
    // Check if the account numbers are numeric
    if (is_numeric($a) && is_numeric($b)) {
        // Compare as numeric values
        return $a - $b;
    } else {
        // Compare as strings
        return strcmp($a, $b);
    }
}

// Sort the ledger array based on the account number using the custom comparison function
uksort($ledgerData, 'compareAccountNumbers');

// Create and write to the ledger.txt file
$ledgerFile = fopen('ledger.txt', 'w');
foreach ($ledgerData as $accountNo => $transactions) {
    foreach ($transactions as $transaction) {
        // Write account number and transaction details to the file
        fwrite($ledgerFile, "{$transaction['account_no']}|");
        fwrite($ledgerFile, "{$transaction['tid']}|");
        fwrite($ledgerFile, "{$transaction['name']}|");
        fwrite($ledgerFile, "{$transaction['date']}|");
        fwrite($ledgerFile, "{$transaction['type_of_transaction']}|");
        fwrite($ledgerFile, "{$transaction['amount']}|");
        fwrite($ledgerFile, "{$transaction['tax']}\n");
    }
}
fclose($ledgerFile);

//echo "Ledger data has been sorted and stored in ledger.txt file.";
?>