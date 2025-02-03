<?php
    require_once("modelo.php");

    class amigos{
        public $db;
        public $conn;

        public function __construct(){
            $this->db = new db();
            $this->conn = $this->db->getConn();
        }

        public function listarAmigos($id){
            $consulta = "SELECT amigos.nombre, amigos.apellidos, amigos.fNac, id FROM amigos WHERE amigos.id_Usuario = ?";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("i", $id);
            $sentencia->bind_result($nom, $apell, $fnac, $id);
            $infoAmigos = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($infoAmigos, [$nom, $apell, $fnac, $id]);
            };
            $sentencia->close();
            return $infoAmigos;
        }

        public function listarContactos(){
            $consulta = "SELECT amigos.nombre, amigos.apellidos, amigos.fNac, usuarios.nombre FROM amigos, usuarios WHERE amigos.id_Usuario = usuarios.id;";
            $sentencia = $this->conn->prepare($consulta);
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
            $sentencia->bind_param("isss", $id_Usuario, $nombre, $apellido, $fnac);
            $sentencia->execute();
            $bool;
            
            if($sentencia->affected_rows == 1){
                $bool = true;
            }else{
                $bool = false;
            }
            $sentencia->close();

            return $bool;
        }

        public function modifAmigo($idUsuario, $nombre, $apellidos, $fNac, $id){
            $consulta = "UPDATE amigos SET id_Usuario = ?, nombre = ?, apellidos =  ?, fNac = ?  WHERE id = ?";
        
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("isssi", $idUsuario, $nombre, $apellidos, $fNac, $id);
            $sentencia->execute();

            if($sentencia->affected_rows == 1){
                $bool = true;
            }else{
                $bool = false;
            }
            $sentencia->close();
            return $bool;
        }

        public function seleccionAmigo($nomApell, $idUsu){
            $consulta = "SELECT nombre, apellidos, fNac, id FROM amigos WHERE id_Usuario = ? and (nombre = ? or apellidos = ?)";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("iss",$idUsu, $nomApell, $nomApell);
            $sentencia->bind_result($nom, $apell, $fNac, $id);
            $sentencia->execute();
            $infoAmigos = array();
            while($sentencia->fetch()){
                array_push($infoAmigos, [$nom, $apell, $fNac, $id]);
            };
            $sentencia->close();
            return $infoAmigos;
        }
    }
?>