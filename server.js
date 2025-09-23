const express = require("express");
const path = require("path");
const app = express();
const port = 3000;

// Middleware to parse JSON and form data
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// Serve static files from frontend folder
app.use(express.static(path.join(__dirname, "frontend")));

// Import backend routes
const addCustomerRouter = require("./back-end/routes/add_customer");
const loginRouter = require("./back-end/routes/login");
const addTransactionRouter = require("./back-end/routes/add_transaction");
const addLoanRouter = require("./back-end/routes/add_loan");  
const addAccountRouter = require("./back-end/routes/add_account");
const branchesRouter = require("./back-end/routes/branches");


// Use backend routes
app.use("/branches", branchesRouter);
app.use("/add_customer", addCustomerRouter); 
app.use("/login", loginRouter);
app.use("/add_transaction", addTransactionRouter);
app.use("/add_loan", addLoanRouter);
app.use("/add_account", addAccountRouter);

// Start server
app.listen(port, () => {
  console.log(`Server running on http://localhost:${port}`);
});
