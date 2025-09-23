// backend/db.js
const mysql = require("mysql2");

const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "", 
  database: "bankdb"
});

db.connect(err => {
  if (err) {
    console.error("Database connection failed:", err);
    process.exit(1); // stop server if DB connection fails
  }
  console.log("MySQL Connected!");
});

module.exports = db;

