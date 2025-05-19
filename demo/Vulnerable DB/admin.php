<?php
session_start();
if (($_SESSION['role'] ?? '') !== 'admin') { header("Location: login.html"); exit; }

$mysqli = new mysqli("localhost","vuln","","bankdb");

/* ----- handle delete ----- */
if (isset($_GET['delete'])) {
    $del = (int)$_GET['delete'];         // still injectable if someone drops the cast
    $mysqli->query("DELETE FROM users WHERE id=$del");       // demo‑insecure
    $mysqli->query("DELETE FROM accounts WHERE user_id=$del");
    $mysqli->query("DELETE t FROM transactions t JOIN accounts a ON a.acct_id=t.acct_id WHERE a.user_id=$del");
}

/* list all customers and their balances */
$sql = "SELECT u.id, u.username, u.role, SUM(a.balance) AS total
        FROM users u
        LEFT JOIN accounts a ON a.user_id = u.id
        GROUP BY u.id";
$rows = $mysqli->query($sql);
?>
<!doctype html><html><head>
<meta charset="utf-8"><title>Admin Dashboard</title>
<link rel="stylesheet" href="style.css">
</head><body>
<h1>Admin Dashboard</h1>

<table>
 <tr><th>ID</th><th>User</th><th>Role</th><th>Total Balance</th><th>Actions</th></tr>
 <?php while($r=$rows->fetch_assoc()): ?>
   <tr>
     <td><?= $r['id'] ?></td><td><?= $r['username'] ?></td><td><?= $r['role'] ?></td>
     <td><?= $r['total'] ?? '0.00' ?></td>
     <td>
       <a class="button" href="search.php?uid=<?= $r['id'] ?>&admin=1">View Txns</a>
       <?php if ($r['role']!=='admin'): ?>
       <a class="button" href="admin.php?delete=<?= $r['id'] ?>"
          onclick="return confirm('Delete user <?= $r['username'] ?>?');">Delete</a>
       <?php endif; ?>
     </td>
   </tr>
 <?php endwhile; ?>
</table>
</body></html>
