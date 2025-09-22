const express = require("express");
const router = express.Router();
const db = require("../db");

router.post("/", (req, res) => {
  const { customer_id, branch_id, aadhar_no, loan_type, amount, tenure } = req.body;

  const sql = "INSERT INTO Loans (customer_id, branch_id, aadhar_no, loan_type, amount, tenure, issue_date) VALUES (?,?,?,?,?,?,CURDATE())";
  db.query(sql, [customer_id, branch_id, aadhar_no, loan_type, amount, tenure], (err) => {
    if (err) return res.status(500).send("Error: " + err);
    res.send("Loan added successfully!");
  });
});

module.exports = router;
