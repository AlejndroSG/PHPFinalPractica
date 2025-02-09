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

        public function listarUsuarios(){
            $consulta = "SELECT id, nombre, pswd FROM usuarios Where tipo = 1";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_result($idUsu, $nomUsu, $pswd);
            $info = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($info, [$idUsu, $nomUsu, $pswd]);
            };
            $sentencia->close();
            return $info;
        }

        public function insertarUsuario($nomUsu, $pswd){
            $consulta = "INSERT INTO usuarios (nombre, pswd, tipo) VALUES (?,?,1)";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("ss", $nomUsu, $pswd);
            $sentencia->execute();
            $bool = false;
            if($sentencia->affected_rows == 1){
                $bool = true;
            };
            $sentencia->close();
            return $bool;
        }

        public function seleccionarUsuario($nomUsu){
            $consulta = "SELECT id, nombre, pswd FROM usuarios WHERE nombre = ? AND tipo = 1";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("s", $nomUsu);
            $sentencia->bind_result($idUsu, $nomUsu, $pswd);
            $info = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($info, [$idUsu, $nomUsu, $pswd]);
            };
            $sentencia->close();
            return $info;
        }

        public function modificarUsuario($idUsu, $nomUsu, $pswd){
            $consulta = "UPDATE usuarios SET nombre = ?, pswd = ? WHERE id = ? AND tipo = 1";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("ssi", $nomUsu, $pswd, $idUsu);
            $sentencia->execute();
            $bool = false;
            if($sentencia->affected_rows == 1){
                $bool = true;
            };
            $sentencia->close();
            return $bool;
        }
    }
?>