const express = require("express");
const router = express.Router();
const db = require("../db");
const bcrypt = require("bcrypt");

router.post("/", async (req, res) => {
  const { name, dob, address, phone, email, aadhar_no, password } = req.body;

  try {
    const hashedPassword = await bcrypt.hash(password, 10);

    const sql = "INSERT INTO Customers (name, dob, address, phone, email, aadhar_no, password) VALUES (?,?,?,?,?,?,?)";
    db.query(sql, [name, dob, address, phone, email, aadhar_no, hashedPassword], (err, result) => {
      if (err) return res.status(500).send("Error: " + err);

      const customer_id = result.insertId;
      const default_branch_id = 1;
      const account_type = "Savings";
      const balance = 0;

      const sqlAcc = "INSERT INTO Accounts (customer_id, branch_id, account_type, balance, opening_date) VALUES (?,?,?,?,CURDATE())";
      db.query(sqlAcc, [customer_id, default_branch_id, account_type, balance], (err2) => {
        if (err2) return res.status(500).send("Error creating account: " + err2);
        res.send("Customer registered successfully! Account created.");
      });
    });
  } catch (e) {
    res.status(500).send("Error: " + e.message);
  }
});

module.exports = router;
