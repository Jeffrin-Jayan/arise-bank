// back-end/routes/login.js
const express = require("express");
const router = express.Router();
const db = require("../db");
const bcrypt = require("bcrypt");

// POST /login
router.post("/", (req, res) => {
  const { email, password } = req.body;

  // Fetch user by email
  const sql = "SELECT * FROM Customers WHERE email=?";
  db.query(sql, [email], async (err, results) => {
    if (err) return res.send("Error: " + err);

    if (results.length === 1) {
      const user = results[0];
      
      // Compare hashed password
      const match = await bcrypt.compare(password, user.password);
      if (match) {
        res.send("Login successful! Welcome " + user.name);
      } else {
        res.send("Invalid login details.");
      }

    } else {
      res.send("Invalid login details.");
    }
  });
});

module.exports = router;
