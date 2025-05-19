<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['uid'])) { header("Location: login.html"); exit; }

$mysqli = new mysqli("localhost","vuln","","bankdb");
$uid  = (int)$_GET['uid'];       // cast to int for safety
$term = $_GET['q'] ?? '';

// Prepare with two parameters
$stmt = $mysqli->prepare(
  "SELECT t.txn_id, a.acct_id, t.amount, t.txn_type, t.note, t.ts
   FROM transactions t
   JOIN accounts a ON a.acct_id = t.acct_id
   WHERE a.user_id = ?
     AND t.note LIKE CONCAT('%',?,'%')"
);
$stmt->bind_param("is", $uid, $term);
$stmt->execute();
$rows = $stmt->get_result();
?>
<!doctype html><html><head>
<meta charset="utf-8"><title>Your Transactions</title>
<link rel="stylesheet" href="style.css">
</head><body>
<h1>Your Transactions</h1>
<form method="get">
  <input name="q" value="<?= htmlspecialchars($term) ?>" placeholder="memo contains…">
  <button>Search</button>
</form>
<table>
 <tr><th>ID</th><th>Acct</th><th>Amt</th><th>Type</th><th>Note</th><th>Date/Time</th></tr>
 <?php while($r=$rows->fetch_assoc()): ?>
   <tr>
     <td><?= $r['txn_id']   ?></td><td><?= $r['acct_id']  ?></td>
     <td><?= $r['amount']   ?></td><td><?= $r['txn_type'] ?></td>
     <td><?= htmlspecialchars($r['note']) ?></td><td><?= $r['ts'] ?></td>
   </tr>
 <?php endwhile; ?>
</table>
</body></html>
