<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $aadhar_no = $_POST['aadhar_no'];

    $sql = "SELECT * FROM Customers WHERE email='$email' AND aadhar_no='$aadhar_no'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        echo "Login successful! Welcome " . $email;
        // you can start a session here if needed
        // session_start();
        // $_SESSION['customer_id'] = $row['customer_id'];
    } else {
        echo "Invalid login details.";
    }
}
$conn->close();
?>
