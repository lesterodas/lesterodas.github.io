<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $mensaje = trim($_POST['mensaje'] ?? '');

    if ($nombre && $correo && $mensaje) {
        $stmt = $pdo->prepare("INSERT INTO contactos (nombre_completo, correo, mensaje) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $correo, $mensaje]);
        echo "<script>alert('Mensaje enviado correctamente'); window.location='contacto.html';</script>";
    } else {
        echo "<script>alert('Todos los campos son obligatorios'); window.history.back();</script>";
    }
}
?>
