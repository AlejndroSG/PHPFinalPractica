<?php
    require_once("modelo.php");

    class amigos{
        public $db;
        public $conn;

        public function __construct(){
            $this->db = new db();
            $this->conn = $this->db->getConn();
        }

        public function validar($id){
            $consulta = "UPDATE amigos SET validar = 1  WHERE id = ?";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("i", $id);
            $sentencia->execute();

            if($sentencia->affected_rows == 1){
                $bool = true;
            }else{
                $bool = false;
            }
            $sentencia->close();
            return $bool;
        }

        public function listarAmigosOrdenados($id){
            $consulta = "SELECT amigos.nombre, amigos.apellidos, amigos.fNac, amigos.id, avg(prestamos.nota) media FROM amigos left join prestamos on amigos.id = prestamos.id_Amigo WHERE amigos.id_Usuario = ? and amigos.validar = 1 GROUP BY amigos.nombre, amigos.apellidos, amigos.fNac, amigos.id order by amigos.nombre asc";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("i", $id);
            $sentencia->bind_result($nom, $apell, $fnac, $id_Amigo, $media);
            $infoAmigos = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($infoAmigos, [$nom, $apell, $fnac, $id_Amigo, $media]);
            };
            $sentencia->close();
            return $infoAmigos;
        }
        
        public function listarAmigosOrdenadosFecha($id){
            $consulta = "SELECT amigos.nombre, amigos.apellidos, amigos.fNac, amigos.id, avg(prestamos.nota) media FROM amigos left join prestamos on amigos.id = prestamos.id_Amigo WHERE amigos.id_Usuario = ? and amigos.validar = 1 GROUP BY amigos.nombre, amigos.apellidos, amigos.fNac, amigos.id order by amigos.fNac asc";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("i", $id);
            $sentencia->bind_result($nom, $apell, $fnac, $id, $media);
            $infoAmigos = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($infoAmigos, [$nom, $apell, $fnac, $id, $media]);
            };
            $sentencia->close();
            return $infoAmigos;
        }

        // Listamos todos los amigos de ese usuario en concreto
        public function listarAmigos($id){
            $consulta = "SELECT amigos.nombre, amigos.apellidos, amigos.fNac, amigos.id, avg(prestamos.nota) media FROM amigos left join prestamos on amigos.id = prestamos.id_Amigo WHERE amigos.id_Usuario = ? and amigos.validar = 1 GROUP BY amigos.nombre, amigos.apellidos, amigos.fNac, amigos.id";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("i", $id);
            $sentencia->bind_result($nom, $apell, $fnac, $id, $media);
            $infoAmigos = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($infoAmigos, [$nom, $apell, $fnac, $id, $media]);
            };
            $sentencia->close();
            return $infoAmigos;
        }

        // Listamos todos los contactos del sistema para el administrador
        public function listarContactos(){
            $consulta = "SELECT amigos.nombre, amigos.apellidos, amigos.fNac, usuarios.nombre, amigos.id, amigos.validar FROM amigos, usuarios WHERE amigos.id_Usuario = usuarios.id;";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_result($nom, $apell, $fnac, $nombreDuenio, $id, $validar);
            $infoAmigos = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($infoAmigos, [$nom, $apell, $fnac, $nombreDuenio, $id, $validar]);
            };
            $sentencia->close();
            return $infoAmigos;
        }

        // Seleccionamos un amigo en concreto para poder modificarlo
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

        // Lo mismo pero seleccionamos el contacto para el administrador, ya que le podemos seleccionar el usuario
        public function seleccionarContacto($idAmigo){
            $consulta = "SELECT amigos.nombre, amigos.apellidos, amigos.fNac, usuarios.nombre, amigos.id_Usuario FROM amigos, usuarios WHERE amigos.id_Usuario = usuarios.id AND amigos.id = ?";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("i", $idAmigo);
            $sentencia->bind_result($nom, $apell, $fnac, $duenio, $idDuenio);
            $sentencia->execute();
            $sentencia->fetch();
            $sentencia->close();

            return [$nom, $apell, $fnac, $duenio, $idDuenio];
        }

        // Insertamos un amigo en la base de datos
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

        // Modificamos un amigo en concreto
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

        // Seleccionamos los amigos que tengan ese nombre o apellido
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

        // Seleccionamos los contactos que tengan ese nombre o apellido
        public function seleccionContacto($nomApell){
            $consulta = "SELECT amigos.id, amigos.nombre, amigos.apellidos, amigos.fNac, usuarios.nombre FROM amigos, usuarios WHERE amigos.id_Usuario = usuarios.id and (amigos.nombre = ? or amigos.apellidos = ?)";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("ss", $nomApell, $nomApell);
            $sentencia->bind_result($id, $nom, $apell, $fNac, $duenio);
            $sentencia->execute();
            $infoAmigos = array();
            while($sentencia->fetch()){
                array_push($infoAmigos, [$id, $nom, $apell, $fNac, $duenio]);
            };
            $sentencia->close();
            return $infoAmigos;
        }
    }
?>