<?php
class Database {
    // Conexión en local
    private $host = "localhost";
    private $db_name = "kanban_app";
    private $username = "root";
    private $password = "Gc123456";

    // Conexión en produccion
    // private $host = "sql306.infinityfree.com";
    // private $db_name = "if0_39695396_kanban_app";
    // private $username = "if0_39695396";
    // private $password = "6liNpp646EZ1T";

    public $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            // No hacer echo aquí para no romper JSON en endpoints
            // Puedes loguear si quieres: error_log($e->getMessage());
            return null;
        }

        return $this->conn;
    }
}
