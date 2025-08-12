<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
function respond($ok,$message,$extra=[]){ echo json_encode(array_merge(['ok'=>$ok,'message'=>$message],$extra),JSON_UNESCAPED_UNICODE); exit; }
if(!isset($_SESSION['user']['id'])){ http_response_code(401); respond(false,'No autenticado'); }
require_once __DIR__.'/../../config/database.php';
$db=(new Database())->connect(); if(!$db instanceof PDO) respond(false,'No se pudo conectar a la base de datos.');

$userId=(int)$_SESSION['user']['id'];
$id=(int)($_POST['id']??0);
$titulo=trim($_POST['titulo']??'');
$id_materia=(int)($_POST['id_materia']??0);
$id_estado=(int)($_POST['id_estado']??1);
$fecha=trim($_POST['fecha_vencimiento']??'');
$desc=trim($_POST['descripcion']??'');

if($id<=0||$titulo==='') respond(false,'Datos inválidos.');
if($id_materia<=0) respond(false,'Debes seleccionar una materia.');
if(!in_array($id_estado,[1,2,3],true)) respond(false,'Estado inválido.');
if($fecha!=='' && !preg_match('/^\d{4}-\d{2}-\d{2}$/',$fecha)) respond(false,'Fecha inválida.');

$chk=$db->prepare("SELECT id FROM tareas WHERE id=? AND id_usuario=?");
$chk->execute([$id,$userId]);
if(!$chk->fetch()) respond(false,'No autorizado.');

// Verificar materia del usuario
$cm=$db->prepare("SELECT id FROM materias WHERE id=? AND id_usuario=?");
$cm->execute([$id_materia,$userId]);
if(!$cm->fetch()) respond(false,'Materia no válida.');

$stmt=$db->prepare("UPDATE tareas SET id_materia=?, id_estado=?, titulo=?, descripcion=?, fecha_vencimiento=? WHERE id=? AND id_usuario=?");
$stmt->execute([$id_materia,$id_estado,$titulo,$desc,$fecha!==''?$fecha:null,$id,$userId]);

respond(true,'Tarea actualizada');
