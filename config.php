<?php
    extract($_REQUEST);

    // Read the existing entries from the file
    $entries = file("journal.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Append the new entry to the array
    $newEntry = $account_no ."|". $trid ."|". $name ."|". $date ."|". $typet ."|". $amount ."|". ($amount * 0.05);
    $entries[] = $newEntry;

    // Sort the entries based on the date in ascending order
    usort($entries, function($a, $b) {
        $aDate = explode("|", $a)[3]; // Date is at index 3
        $bDate = explode("|", $b)[3]; // Date is at index 3
        return strtotime($aDate) - strtotime($bDate);
    });

    // Write the sorted entries back to the file
    $file = fopen("journal.txt", "w");
    fwrite($file, implode("\n", $entries));
    fclose($file);

    header("location: index.php");
?>
