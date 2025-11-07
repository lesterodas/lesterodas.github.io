<?php
$host = "127.0.0.1";       
$port = 3306;              
$dbname = "videojuegos_sa";
$user = "lester";
$pass = "MiClave123!";

try {
  $pdo = new PDO(
    "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
    $user,
    $pass,
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
  );
  // echo "OK";
} catch (PDOException $e) {
  die("❌ Error de conexión: " . $e->getMessage());
}
