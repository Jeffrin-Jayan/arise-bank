<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $branch_id   = $_POST['branch_id'];
    $aadhar_no   = $_POST['aadhar_no'];
    $loan_type   = $_POST['loan_type'];
    $amount      = $_POST['amount'];
    $tenure      = $_POST['tenure'];

    $sql = "INSERT INTO Loans (customer_id, branch_id, aadhar_no, loan_type, amount, tenure) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissdi", $customer_id, $branch_id, $aadhar_no, $loan_type, $amount, $tenure);

    if ($stmt->execute()) {
        echo "Loan added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
