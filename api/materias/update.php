<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
function respond($ok,$message,$extra=[]){ echo json_encode(array_merge(['ok'=>$ok,'message'=>$message],$extra),JSON_UNESCAPED_UNICODE); exit; }
if(!isset($_SESSION['user']['id'])){ http_response_code(401); respond(false,'No autenticado'); }
require_once __DIR__.'/../../config/database.php';
$db=(new Database())->connect(); if(!$db instanceof PDO) respond(false,'No se pudo conectar a la base de datos.');

$userId=(int)$_SESSION['user']['id'];
$id=(int)($_POST['id']??0);
$nombre=trim($_POST['nombre']??'');
$color=trim($_POST['color']??'#888888');
if($id<=0||$nombre==='') respond(false,'Datos inválidos.');

$chk=$db->prepare("SELECT id FROM materias WHERE id=? AND id_usuario=?");
$chk->execute([$id,$userId]);
if(!$chk->fetch()) respond(false,'No autorizado.');

$stmt=$db->prepare("UPDATE materias SET nombre=?, color=? WHERE id=? AND id_usuario=?");
$stmt->execute([$nombre,$color,$id,$userId]);

respond(true,'Materia actualizada');
