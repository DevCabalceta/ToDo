<?php
header('Content-Type: application/json; charset=utf-8');
session_start();

function respond($ok,$message,$extra=[]){ echo json_encode(array_merge(['ok'=>$ok,'message'=>$message],$extra),JSON_UNESCAPED_UNICODE); exit; }

if(!isset($_SESSION['user']['id'])){ http_response_code(401); respond(false,'No autenticado'); }

require_once __DIR__.'/../../config/database.php';
$db=(new Database())->connect(); if(!$db instanceof PDO) respond(false,'No se pudo conectar a la base de datos.');

$userId=(int)$_SESSION['user']['id'];

$stmt=$db->prepare("SELECT id, nombre, color FROM materias WHERE id_usuario=? ORDER BY nombre");
$stmt->execute([$userId]);
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

respond(true,'OK',['items'=>$rows,'count'=>count($rows)]);
