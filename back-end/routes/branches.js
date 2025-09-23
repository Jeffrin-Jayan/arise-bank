const express = require("express");
const router = express.Router();
const db = require("../db");

// GET /branches → fetch all branches
router.get("/", (req, res) => {
  const sql = "SELECT * FROM Branches";
  db.query(sql, (err, results) => {
    if (err) return res.status(500).send("Error fetching branches: " + err);
    res.json(results); // send as JSON
  });
});

module.exports = router;
