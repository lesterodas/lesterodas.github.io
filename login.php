<?php
// login.php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: login.html'); exit;
}

$correo = trim($_POST['correo'] ?? '');
$clave  = trim($_POST['clave'] ?? '');

if ($correo === '' || $clave === '') {
  echo "<script>alert('Completa correo y contraseña'); window.location='login.html';</script>";
  exit;
}

$stmt = $pdo->prepare("SELECT id, nombre, correo, clave_hash FROM usuarios WHERE correo = ?");
$stmt->execute([$correo]);
$user = $stmt->fetch();

if (!$user || !password_verify($clave, $user['clave_hash'])) {
  echo "<script>alert('❌ Credenciales inválidas'); window.location='login.html';</script>";
  exit;
}

// Login OK
$_SESSION['user_id']     = $user['id'];
$_SESSION['user_nombre'] = $user['nombre'];
$_SESSION['user_correo'] = $user['correo'];

echo "<script>alert('✅ Bienvenido, {$user['nombre']}'); window.location='index.html';</script>";
