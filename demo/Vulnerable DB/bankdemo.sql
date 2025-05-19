-- bankdemo.sql  (intentionally insecure)
Drop DATABASE IF EXISTS bankdb;
CREATE DATABASE bankdb;
USE bankdb;

/* --------  USERS  -------- */
CREATE TABLE users (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    username  VARCHAR(50)  NOT NULL,
    password  VARCHAR(50)  NOT NULL,      -- plain text on purpose
    role      ENUM('customer','admin')    -- new column
);

INSERT INTO users (username,password,role) VALUES
  ('alice','wonderland','customer'),
  ('bob'  ,'builder'   ,'customer'),
  ('carol','12345'     ,'customer'),
  ('admin' ,'adminpass','admin');         -- demo admin

/* --------  ACCOUNTS  -------- */
CREATE TABLE accounts (
    acct_id   INT AUTO_INCREMENT PRIMARY KEY,
    user_id   INT,
    balance   DECIMAL(10,2),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO accounts (user_id,balance) VALUES
  (1,1250.50),
  (2,987.00),
  (3,42.00);

/* --------  TRANSACTIONS  -------- */
CREATE TABLE transactions (
    txn_id     INT AUTO_INCREMENT PRIMARY KEY,
    acct_id    INT,
    amount     DECIMAL(10,2),
    txn_type   ENUM('deposit','charge'),
    note       VARCHAR(100),
    ts         TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (acct_id) REFERENCES accounts(acct_id)
);

/* seed a couple of moves */
INSERT INTO transactions (acct_id,amount,txn_type,note) VALUES
  (1,-50.00 ,'charge' ,'ATM withdrawal'),
  (1, 15.00 ,'deposit','Refund'),
  (2,-25.00 ,'charge' ,'Coffee'),
  (3, 12.00 ,'deposit','Gift');
