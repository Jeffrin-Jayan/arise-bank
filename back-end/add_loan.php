<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $branch_id = $_POST['branch_id'];
    $loan_type = $_POST['loan_type'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO Loans (customer_id, branch_id, loan_type, amount) 
            VALUES ('$customer_id', '$branch_id', '$loan_type', '$amount')";

    if ($conn->query($sql) === TRUE) {
        echo "Loan request submitted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
