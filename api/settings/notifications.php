<?php
// ToDo/api/settings/notifications.php
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
// Acepta "true/false", "1/0", "on/off"
$enabledRaw = $_POST['enabled'] ?? $_POST['notificaciones'] ?? 0;
$enabled = in_array(strtolower((string)$enabledRaw), ['1','true','on','sí','si']) ? 1 : 0;

$stmt = $db->prepare("UPDATE usuarios SET notificaciones = ? WHERE id = ?");
$stmt->execute([$enabled, $userId]);

respond(true, 'Preferencia de notificaciones actualizada.', ['enabled' => (bool)$enabled]);
