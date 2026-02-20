<?php
// ToDo/api/auth/login.php
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
$email    = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
  respond(false, 'Correo o contraseña inválidos.');
}

/** Buscar usuario */
$stmt = $db->prepare("SELECT id, nombre_completo, email, password FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password'])) {
  respond(false, 'Correo o contraseña incorrectos.');
}

/** Sesión */
$_SESSION['user'] = [
  'id'     => (int)$user['id'],
  'nombre' => $user['nombre_completo'],
  'email'  => $user['email']
];

respond(true, 'Login exitoso.', ['redirect' => 'escritorio']);
