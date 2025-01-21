<?php
    require_once("modelo.php");

    class amigos{
        public $db;
        public $conn;

        public function __construct(){
            $this->db = new db();
            $this->conn = $this->db->getConn();
        }

        public function listarAmigos($nomUsu){
            $consulta = "SELECT amigos.nombre, amigos.apellidos, amigos.fNac FROM amigos WHERE amigos.id_Usuario in (SELECT id FROM usuarios WHERE nombre = ?)";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("s", $nomUsu);
            $sentencia->bind_result($nom, $apell, $fnac);
            $infoAmigos = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($infoAmigos, [$nom, $apell, $fnac]);
            };
            $sentencia->close();
            return $infoAmigos;
        }
    }
?>