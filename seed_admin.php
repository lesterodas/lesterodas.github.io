<?php
require 'db.php';

$correo = 'admin@lrgamershop.com';
$nombre = 'Administrador';
$clave_plana = 'Admin123!'; // cámbiala si quieres

$hash = password_hash($clave_plana, PASSWORD_BCRYPT);

try {
  // Evitar duplicado de usuario
  $existe = $pdo->prepare("SELECT id FROM usuarios WHERE correo = ?");
  $existe->execute([$correo]);
  if ($existe->fetch()) {
    exit("Ya existe un usuario con ese correo.");
  }

  $stmt = $pdo->prepare("INSERT INTO usuarios (correo, clave_hash, nombre) VALUES (?, ?, ?)");
  $stmt->execute([$correo, $hash, $nombre]);

  echo "Usuario creado: $correo<br>Contraseña: $clave_plana (puedes cambiarla luego)";
} catch (Throwable $e) {
  echo "Error: " . $e->getMessage();
}
