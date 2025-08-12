<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
function respond($ok,$message,$extra=[]){ echo json_encode(array_merge(['ok'=>$ok,'message'=>$message],$extra),JSON_UNESCAPED_UNICODE); exit; }
if(!isset($_SESSION['user']['id'])){ http_response_code(401); respond(false,'No autenticado'); }
require_once __DIR__.'/../../config/database.php';
$db=(new Database())->connect(); if(!$db instanceof PDO) respond(false,'No se pudo conectar a la base de datos.');

$userId=(int)$_SESSION['user']['id'];
$id=(int)($_POST['id']??0);
if($id<=0) respond(false,'ID inválido.');

$chk=$db->prepare("SELECT id FROM materias WHERE id=? AND id_usuario=?");
$chk->execute([$id,$userId]);
if(!$chk->fetch()) respond(false,'No autorizado.');

$db->beginTransaction();
try {
  // 1) Eliminar tareas de esa materia del usuario (tu requerimiento)
  $delTasks=$db->prepare("DELETE FROM tareas WHERE id_usuario=? AND id_materia=?");
  $delTasks->execute([$userId,$id]);

  // 2) Eliminar la materia
  $delMat=$db->prepare("DELETE FROM materias WHERE id=? AND id_usuario=?");
  $delMat->execute([$id,$userId]);

  $db->commit();
  respond(true,'Materia y tareas relacionadas eliminadas');
} catch (Exception $e) {
  $db->rollBack();
  respond(false,'Error al eliminar: '.$e->getMessage());
}
