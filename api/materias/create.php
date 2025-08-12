<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
function respond($ok,$message,$extra=[]){ echo json_encode(array_merge(['ok'=>$ok,'message'=>$message],$extra),JSON_UNESCAPED_UNICODE); exit; }
if(!isset($_SESSION['user']['id'])){ http_response_code(401); respond(false,'No autenticado'); }
require_once __DIR__.'/../../config/database.php';
$db=(new Database())->connect(); if(!$db instanceof PDO) respond(false,'No se pudo conectar a la base de datos.');

$userId=(int)$_SESSION['user']['id'];
$nombre=trim($_POST['nombre']??'');
$color=trim($_POST['color']??'#888888');
if($nombre==='') respond(false,'El nombre de la materia es obligatorio.');

$stmt=$db->prepare("INSERT INTO materias (id_usuario,nombre,color) VALUES (?,?,?)");
$stmt->execute([$userId,$nombre,$color]);
$id=(int)$db->lastInsertId();

respond(true,'Materia creada',['id'=>$id,'nombre'=>$nombre,'color'=>$color]);
