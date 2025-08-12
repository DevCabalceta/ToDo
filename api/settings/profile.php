<?php
// ToDo/api/settings/profile.php
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
$nombre = trim($_POST['nombre'] ?? '');
$email  = trim($_POST['email'] ?? '');

if ($nombre === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  respond(false, 'Datos inválidos. Verifica nombre y correo.');
}

// ¿Email en uso por otro usuario?
$stmt = $db->prepare("SELECT id FROM usuarios WHERE email = ? AND id <> ?");
$stmt->execute([$email, $userId]);
if ($stmt->fetch()) {
  respond(false, 'El correo ya está en uso por otro usuario.');
}

// Actualizar
$stmt = $db->prepare("UPDATE usuarios SET nombre_completo = ?, email = ? WHERE id = ?");
$stmt->execute([$nombre, $email, $userId]);

// Sincronizar sesión
$_SESSION['user']['nombre'] = $nombre;
$_SESSION['user']['email']  = $email;

respond(true, 'Perfil actualizado correctamente.');
