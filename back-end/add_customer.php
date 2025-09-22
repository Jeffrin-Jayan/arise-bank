<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $aadhar_no = $_POST['aadhar_no'];

    $sql = "INSERT INTO Customers (name, dob, address, phone, email, aadhar_no) 
            VALUES ('$name', '$dob', '$address', '$phone', '$email', '$aadhar_no')";

    if ($conn->query($sql) === TRUE) {
        echo "Customer added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
