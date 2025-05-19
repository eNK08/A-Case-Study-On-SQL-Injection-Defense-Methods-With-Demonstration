<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();

$mysqli = new mysqli("localhost","vuln","","bankdb");

$u = $_POST['username'] ?? '';
$p = $_POST['password'] ?? '';

$q = "SELECT * FROM users WHERE username='$u' AND password='$p'";
$res = $mysqli->query($q);

if ($row = $res->fetch_assoc()) {
    $_SESSION['uid']  = $row['id'];
    $_SESSION['role'] = $row['role'];     // 'customer' or 'admin'
    header("Location: ".($row['role']==='admin' ? 'admin.php' : 'search.php'));
    exit;
}
echo "Login failed.";
?>
