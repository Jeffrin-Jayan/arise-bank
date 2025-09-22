<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php

include "db_connect.php"; // adjust path if needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name      = $_POST['name'];
    $dob       = $_POST['dob'];
    $address   = $_POST['address'];
    $phone     = $_POST['phone'];
    $email     = $_POST['email'];
    $aadhar_no = $_POST['aadhar_no'];
    $password  = $_POST['password'];

    // Securely hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into Customers
    $sql = "INSERT INTO Customers (name, dob, address, phone, email, aadhar_no, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $name, $dob, $address, $phone, $email, $aadhar_no, $hashed_password);

    if ($stmt->execute()) {
        $customer_id = $stmt->insert_id;  // newly created customer

        // (Optional) Create a default Savings account for new customer
        $default_branch_id = 1; // change this based on your Branches table
        $account_type = "Savings";
        $balance = 0;

        $sql_acc = "INSERT INTO Accounts (customer_id, branch_id, account_type, balance) 
                    VALUES (?, ?, ?, ?)";
        $stmt_acc = $conn->prepare($sql_acc);
        $stmt_acc->bind_param("iisd", $customer_id, $default_branch_id, $account_type, $balance);
        $stmt_acc->execute();

        echo "Customer registered successfully! Account created.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
