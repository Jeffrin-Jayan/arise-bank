const express = require("express");
const router = express.Router();
const db = require("../db");

router.post("/", (req, res) => {
  const { customer_id, branch_id, account_type, balance } = req.body;

  const sql = "INSERT INTO Accounts (customer_id, branch_id, account_type, balance, opening_date) VALUES (?,?,?,?,CURDATE())";
  db.query(sql, [customer_id, branch_id, account_type, balance || 0], (err) => {
    if (err) return res.status(500).send("Error: " + err);
    res.send("Account created successfully!");
  });
});

module.exports = router;
