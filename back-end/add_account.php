<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id  = $_POST['customer_id'];
    $branch_id    = $_POST['branch_id'];
    $account_type = $_POST['account_type'];
    $balance      = $_POST['balance'];

    $sql = "INSERT INTO Accounts (customer_id, branch_id, account_type, balance) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisd", $customer_id, $branch_id, $account_type, $balance);

    if ($stmt->execute()) {
        echo "Account created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
