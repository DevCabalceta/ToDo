<?php
// ToDo/api/dashboard/metrics.php
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

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

// Conteos por estado
// IDs de estados: 1=Pendiente, 2=En progreso, 3=Completada (según tus inserts)
$counts = ['pendiente' => 0, 'progreso' => 0, 'completada' => 0];

$stmt = $db->prepare("SELECT id_estado, COUNT(*) AS c FROM tareas WHERE id_usuario = ? GROUP BY id_estado");
$stmt->execute([$userId]);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $estado = (int)$row['id_estado'];
  if ($estado === 1) $counts['pendiente']  = (int)$row['c'];
  if ($estado === 2) $counts['progreso']   = (int)$row['c'];
  if ($estado === 3) $counts['completada'] = (int)$row['c'];
}

// Materias del usuario
$stmt = $db->prepare("SELECT COUNT(*) FROM materias WHERE id_usuario = ?");
$stmt->execute([$userId]);
$materias = (int)$stmt->fetchColumn();

// Notas rápidas del usuario
$stmt = $db->prepare("SELECT COUNT(*) FROM notas_rapidas WHERE id_usuario = ?");
$stmt->execute([$userId]);
$notas = (int)$stmt->fetchColumn();

respond(true, 'OK', [
  'chart' => $counts,
  'metrics' => [
    'notas'       => $notas,
    'materias'    => $materias,
    'pendientes'  => $counts['pendiente'],
    'completadas' => $counts['completada']
  ]
]);
