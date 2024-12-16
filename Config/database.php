<?php
    class Database {
        private $host = 'practicas.fimaz.uas.edu.mx';
        private $db_name = 'lisi4150_productos';
        private $username = 'lisi4150';
        private $password = 'lisi4150';

        public $conn;

        public function getConnection() {
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, 
                $this->username, $this->password);
                $this->conn->exec("set names utf8");
            } catch(PDOException $exception) {
                echo "Error al conectar la base de dato Error:" .$exception->getMessage();
            }
            return $this->conn;
        }
    }

    // Prueba - Intentar conectar a la base de datos
    // $database = new Database();
    // $db = $database->getConnection();
    // $db->connect();