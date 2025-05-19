<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();

$mysqli = new mysqli("localhost","vuln","","bankdb");

$u = $_POST['username'] ?? '';
$p = $_POST['password'] ?? '';

// Prepare the statement with placeholders
$stmt = $mysqli->prepare(
    "SELECT id FROM users WHERE username = ? AND password = ?"
  );
  $stmt->bind_param("ss", $u, $p);
  $stmt->execute();
  $stmt->bind_result($id);
  
  if ($stmt->fetch()) {
    header("Location: search.php?uid=$id");
    exit;
  }
  echo "Login failed.";
?>
