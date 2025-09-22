<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $branch_id = $_POST['branch_id'];
    $account_type = $_POST['account_type'];
    $balance = $_POST['balance'];

    $sql = "INSERT INTO Accounts (customer_id, branch_id, account_type, balance) 
            VALUES ('$customer_id', '$branch_id', '$account_type', '$balance')";

    if ($conn->query($sql) === TRUE) {
        echo "Account created successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
