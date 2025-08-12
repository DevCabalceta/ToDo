<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
function respond($ok,$message,$extra=[]){ echo json_encode(array_merge(['ok'=>$ok,'message'=>$message],$extra),JSON_UNESCAPED_UNICODE); exit; }
if(!isset($_SESSION['user']['id'])){ http_response_code(401); respond(false,'No autenticado'); }
require_once __DIR__.'/../../config/database.php';
$db=(new Database())->connect(); if(!$db instanceof PDO) respond(false,'No se pudo conectar a la base de datos.');

$userId=(int)$_SESSION['user']['id'];
$titulo=trim($_POST['titulo']??'');
$id_materia=(int)($_POST['id_materia']??0);
$id_estado=(int)($_POST['id_estado']??1);
$fecha=trim($_POST['fecha_vencimiento']??'');
$desc=trim($_POST['descripcion']??'');

if($titulo==='') respond(false,'El título es obligatorio.');
if($id_materia<=0) respond(false,'Debes seleccionar una materia.');
if(!in_array($id_estado,[1,2,3],true)) respond(false,'Estado inválido.');
if($fecha!=='' && !preg_match('/^\d{4}-\d{2}-\d{2}$/',$fecha)) respond(false,'Fecha inválida (YYYY-MM-DD).');

// Verificar que la materia sea del usuario
$chk=$db->prepare("SELECT id, nombre, color FROM materias WHERE id=? AND id_usuario=?");
$chk->execute([$id_materia,$userId]);
$mat=$chk->fetch(PDO::FETCH_ASSOC);
if(!$mat) respond(false,'Materia no válida.');

$stmt=$db->prepare("INSERT INTO tareas (id_usuario,id_materia,id_estado,titulo,descripcion,fecha_vencimiento) VALUES (?,?,?,?,?,?)");
$stmt->execute([$userId,$id_materia,$id_estado,$titulo,$desc,$fecha!==''?$fecha:null]);
$id=(int)$db->lastInsertId();

respond(true,'Tarea creada',[
  'id'=>$id,
  'materia'=>$mat['nombre'],
  'color'=>$mat['color']
]);
