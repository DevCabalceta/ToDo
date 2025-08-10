<?php
require_once __DIR__.'/../models/Tarea.php';

class CalendarController {
    private $modeloTarea;

    public function __construct() {
        $this->modeloTarea = new Tarea();
    }

    public function obtenerTareas() {
        return $this->modeloTarea->obtenerTareasConMateria();
    }
}