<?php
    require_once("modelo.php");

    class usuarios{
        public $db;
        public $conn;

        public function __construct(){
            $this->db = new db();
            $this->conn = $this->db->getConn();
        }

        public function getID($nomUsu){
            $consulta = "SELECT id, tipo FROM usuarios WHERE nombre = ?";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("s", $nomUsu);
            $sentencia->bind_result($id, $type);
            $info = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($info, [$id, $type]);
            };
            $sentencia->close();
            return $info;
        }
    }
?>