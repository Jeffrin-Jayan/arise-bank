<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $account_id = $_POST['account_id'];
    $transaction_type = $_POST['transaction_type'];
    $amount = $_POST['amount'];

    // Insert transaction
    $sql = "INSERT INTO Transactions (account_id, transaction_type, amount) 
            VALUES ('$account_id', '$transaction_type', '$amount')";

    if ($conn->query($sql) === TRUE) {
        // Update balance in Accounts table
        if ($transaction_type == 'Deposit') {
            $conn->query("UPDATE Accounts SET balance = balance + $amount WHERE account_id = $account_id");
        } elseif ($transaction_type == 'Withdraw') {
            $conn->query("UPDATE Accounts SET balance = balance - $amount WHERE account_id = $account_id");
        }
        echo "Transaction successful!";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
