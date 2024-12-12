<?php
    class Database {
        private $host = 'practicas.fimaz.uas.edu.mx';
        private $db_name = 'lisi4150_productos';
        private $username = 'lisi4150';
        private $password = 'lisi4150';

        public $conn;

        public function getConnection() {
            $this->conn = null;
            try {
                $this->conn = new PDO("mysql:host=" .$this->host. ";dbname=" .$this->db_name,$this->username, $this->password);
                $this->conn->exec("SET CHARACTER SET utf8");
                echo "Connection established";
            } catch (PDOException $exception) {
                echo "Error al conectar a la base de datos: ". $exception->getMessage();
            }
            return $this->conn;
        }
    }

    // Intentar conectar a la base de datos
    $database = new Database();
    $db = $database->getConnection();
    $db->connect();
    

    ?>