<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
function respond($ok,$message,$extra=[]){ echo json_encode(array_merge(['ok'=>$ok,'message'=>$message],$extra),JSON_UNESCAPED_UNICODE); exit; }
if(!isset($_SESSION['user']['id'])){ http_response_code(401); respond(false,'No autenticado'); }
require_once __DIR__.'/../../config/database.php';
$db=(new Database())->connect(); if(!$db instanceof PDO) respond(false,'No se pudo conectar a la base de datos.');

$userId=(int)$_SESSION['user']['id'];

$sql="
SELECT 
  t.id, t.titulo, t.descripcion, t.fecha_vencimiento, t.id_estado, t.id_materia,
  m.nombre AS materia, m.color
FROM tareas t
LEFT JOIN materias m ON m.id=t.id_materia AND m.id_usuario=t.id_usuario
WHERE t.id_usuario=?
ORDER BY 
  CASE WHEN t.fecha_vencimiento IS NULL THEN 1 ELSE 0 END, t.fecha_vencimiento ASC, t.id DESC
";
$stmt=$db->prepare($sql);
$stmt->execute([$userId]);
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

respond(true,'OK',['items'=>$rows,'count'=>count($rows)]);
