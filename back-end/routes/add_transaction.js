const express = require("express");
const router = express.Router();
const db = require("../db");

router.post("/", (req, res) => {
  const { account_id, transaction_type, amount } = req.body;

  const sql = "INSERT INTO Transactions (account_id, transaction_type, amount, transaction_date) VALUES (?,?,?,CURDATE())";
  db.query(sql, [account_id, transaction_type, amount], (err) => {
    if (err) return res.status(500).send("Error: " + err);

    let updateSql = "";
    if (transaction_type === "Deposit") {
      updateSql = "UPDATE Accounts SET balance = balance + ? WHERE account_id=?";
    } else if (transaction_type === "Withdraw") {
      updateSql = "UPDATE Accounts SET balance = balance - ? WHERE account_id=?";
    } else {
      return res.status(400).send("Invalid transaction type.");
    }

    db.query(updateSql, [amount, account_id], (err2) => {
      if (err2) return res.status(500).send("Error updating balance: " + err2);
      res.send("Transaction successful!");
    });
  });
});

module.exports = router;
