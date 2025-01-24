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
            $consulta = "SELECT amigos.nombre, amigos.apellidos, amigos.fNac, id FROM amigos WHERE amigos.id_Usuario in (SELECT id FROM usuarios WHERE nombre = ?)";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("s", $nomUsu);
            $sentencia->bind_result($nom, $apell, $fnac, $id);
            $infoAmigos = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($infoAmigos, [$nom, $apell, $fnac, $id]);
            };
            $sentencia->close();
            return $infoAmigos;
        }

        public function seleccionarAmigo($idAmigo){
            $consulta = "SELECT amigos.nombre, amigos.apellidos, amigos.fNac FROM amigos WHERE amigos.id = ?";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("i", $idAmigo);
            $sentencia->bind_result($nom, $apell, $fnac);
            $sentencia->execute();
            $sentencia->fetch();
            $sentencia->close();
            return [$nom, $apell, $fnac];
        }

        public function insertAmigo($id_Usuario, $nombre, $apellido, $fnac){
            $consulta = "INSERT INTO amigos (id_Usuario, nombre, apellidos, fNac) values (?,?,?,?)";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("issd", $id_Usuario, $nombre, $apellido, $fnac);
            $sentencia->execute();
            $bool;
            
            if($sentencia->affected_rows == 1){
                $bool = true;
            }else{
                $bool = false;
            }

            return $bool;
        }
    }
?>