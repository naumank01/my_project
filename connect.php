<?php
$server_name = "localhost";
$db_name = "stackoverflow_clone";
$user_name = "root";
$pass_word = "";
$port = 3306;

try {
  $dsn = "mysql:host=$server_name;port=$port;dbname=$db_name";
  $pdo = new PDO($dsn, $user_name, $pass_word);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}
?>