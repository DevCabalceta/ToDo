<?php
// ToDo/api/settings/password.php
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

if (!isset($_SESSION['user']['id'])) {
  http_response_code(401);
  respond(false, 'No autenticado');
}

require_once __DIR__ . '/../../config/database.php';
$db = (new Database())->connect();
if (!$db instanceof PDO) respond(false, 'No se pudo conectar a la base de datos.');

$userId = (int)$_SESSION['user']['id'];
$actual = trim($_POST['pass_actual'] ?? '');
$nueva  = trim($_POST['pass_nueva']  ?? '');
$conf   = trim($_POST['pass_confirm'] ?? '');

if ($actual === '' || $nueva === '' || $conf === '') {
  respond(false, 'Completa todos los campos.');
}
if (strlen($nueva) < 8) {
  respond(false, 'La nueva contraseña debe tener al menos 8 caracteres.');
}
if ($nueva !== $conf) {
  respond(false, 'La confirmación no coincide.');
}

// Obtener hash actual
$stmt = $db->prepare("SELECT password FROM usuarios WHERE id = ?");
$stmt->execute([$userId]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$row || !password_verify($actual, $row['password'])) {
  respond(false, 'La contraseña actual es incorrecta.');
}
if (password_verify($nueva, $row['password'])) {
  respond(false, 'La nueva contraseña no puede ser igual a la actual.');
}

// Actualizar contraseña
$hash = password_hash($nueva, PASSWORD_DEFAULT);
$stmt = $db->prepare("UPDATE usuarios SET password = ? WHERE id = ?");
$stmt->execute([$hash, $userId]);

respond(true, 'Contraseña actualizada correctamente.');
