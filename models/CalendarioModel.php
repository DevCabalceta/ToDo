<?php
require_once __DIR__ . '/../config/database.php';

class Tarea {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect(); // PDO
    }

    public function obtenerTareasConMateria(int $userId): array {

        $sql = "
            SELECT
                t.id,
                t.titulo,
                t.descripcion,
                t.fecha_vencimiento,
                m.nombre AS materia,
                m.color
            FROM tareas t
            LEFT JOIN materias m 
                   ON m.id = t.id_materia 
                  AND m.id_usuario = t.id_usuario
            WHERE t.id_usuario = ?
            ORDER BY t.fecha_vencimiento
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
}
