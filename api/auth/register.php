<?php
// ToDo/api/auth/register.php
header('Content-Type: application/json; charset=utf-8');
session_start();

function respond($ok, $message, $extra = []) {
  echo json_encode(array_merge(['ok' => $ok, 'message' => $message], $extra), JSON_UNESCAPED_UNICODE);
  exit;
}

set_error_handler(function($errno, $errstr, $errfile, $errline){
  respond(false, "PHP: $errstr en $errfile:$errline");
});
set_exception_handler(function($e){
  respond(false, "Excepción: " . $e->getMessage());
});

require_once __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  respond(false, 'Método no permitido');
}

/** Conexión PDO */
$dbObj = new Database();
$db = $dbObj->connect();
if (!$db instanceof PDO) {
  respond(false, 'No se pudo conectar a la base de datos.');
}

/** Inputs */
$name     = isset($_POST['name']) ? trim($_POST['name']) : '';
$email    = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$confirm  = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

/** Validaciones */
$errors = [];
if ($name === '')                               $errors['name'] = 'El nombre es obligatorio.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Correo inválido.';
if (strlen($password) < 8)                      $errors['password'] = 'La contraseña debe tener al menos 8 caracteres.';
if ($password !== $confirm)                     $errors['confirm_password'] = 'Las contraseñas no coinciden.';

if ($errors) respond(false, 'Revisa los datos del formulario.', ['errors' => $errors]);

/** ¿Email ya existe? */
$stmt = $db->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
  respond(false, 'El correo ya está registrado.', ['errors' => ['email' => 'Ya existe un usuario con este correo.']]);
}

/** Insertar */
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $db->prepare("INSERT INTO usuarios (nombre_completo, email, password, notificaciones) VALUES (?, ?, ?, 1)");
$stmt->execute([$name, $email, $hash]);

// ⚠️ No creamos sesión aquí
// Solo confirmamos registro y mandamos a login.php

respond(true, 'Registro exitoso. Ahora puedes iniciar sesión.', ['redirect' => 'login.php']);
