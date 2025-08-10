<?php
require_once __DIR__ . '/../config/database.php';

class Tarea {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function obtenerTareasConMateria() {
        $stmt = $this->db->prepare("
            SELECT
                t.id,
                t.titulo,
                t.descripcion,
                t.fecha_vencimiento,
                m.nombre AS materia,
                m.color
            FROM tareas t
            LEFT JOIN materias m ON t.id_materia = m.id
            ORDER BY t.fecha_vencimiento 
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*public function agregar($titulo, $fecha, $id_materia = null, $descripcion = null) {
        $idUsuario = $_SESSION['id_usuario'] ?? 1;
        $stmt = $this->db->prepare("
            INSERT INTO tareas (id_usuario, id_materia, id_estado, titulo, descripcion, fecha_vencimiento)
            VALUES (?, ?, 1, ?, ?, ?)
        ");
        $stmt->execute([$idUsuario, $id_materia, $titulo, $descripcion, $fecha]);
    }*/
}