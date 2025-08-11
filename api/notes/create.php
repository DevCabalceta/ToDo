<?php
// ToDo/api/notes/create.php
header('Content-Type: application/json; charset=utf-8');
session_start();

function respond($ok, $message, $extra = []) {
  echo json_encode(array_merge(['ok' => $ok, 'message' => $message], $extra), JSON_UNESCAPED_UNICODE);
  exit;
}

if (!isset($_SESSION['user']['id'])) {
  http_response_code(401);
  respond(false, 'No autenticado');
}

require_once __DIR__ . '/../../config/database.php';
$db = (new Database())->connect();
if (!$db instanceof PDO) respond(false, 'No se pudo conectar a la base de datos.');

$userId = (int)$_SESSION['user']['id'];
$contenido = trim($_POST['contenido'] ?? '');

if ($contenido === '') respond(false, 'La nota no puede estar vacía.');

$stmt = $db->prepare("INSERT INTO notas_rapidas (id_usuario, contenido) VALUES (?, ?)");
$stmt->execute([$userId, $contenido]);

$id = (int)$db->lastInsertId();
respond(true, 'Nota creada', ['id' => $id, 'contenido' => $contenido, 'fecha_creacion' => date('Y-m-d H:i:s')]);
