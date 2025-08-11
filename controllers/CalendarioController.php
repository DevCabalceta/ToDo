<?php
require_once __DIR__.'/../models/CalendarioModel.php';

class CalendarController {
    private $modeloTarea;

    public function __construct() {
        $this->modeloTarea = new Tarea();
    }

    // Recibe el id del usuario
    public function obtenerTareas(int $userId) {
        return $this->modeloTarea->obtenerTareasConMateria($userId);
    }
}
