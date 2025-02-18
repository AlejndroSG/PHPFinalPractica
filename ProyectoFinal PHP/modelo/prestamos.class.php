<?php
    require_once("modelo.php");

    class prestamos{
        public $db;
        public $conn;

        public function __construct(){
            $this->db = new db();
            $this->conn = $this->db->getConn();
        }

        public function setearNota($id, $nota = 0.0){
            $consulta = "UPDATE prestamos SET nota = ? WHERE prestamos.id = ?";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("di", $nota, $id);
            $sentencia->execute();
            if($sentencia->affected_rows == 1){
                $bool = true;
            }else{
                $bool = false;
            }
            $sentencia->close();
            return $bool;
        }

        // Listamos todos los prestamos de ese usuario en concreto
        public function listarPrestamos($id){
            $consulta = "SELECT prestamos.id, amigos.nombre, juegos.titulo, juegos.url, prestamos.fecha_inicio, prestamos.devuelto 
                        FROM usuarios, amigos, juegos, prestamos 
                        WHERE prestamos.id_Usu = usuarios.id AND prestamos.id_Amigo = amigos.id AND prestamos.id_Juego = juegos.id AND prestamos.id_Usu = ?";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("i", $id);
            $sentencia->bind_result($IdP, $Anom, $Jutit, $Jurl, $Finicio, $Dev);
            $infoPrestamo = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($infoPrestamo, [$IdP, $Anom, $Jutit, $Jurl, $Finicio, $Dev]);
            };
            $sentencia->close();
            return $infoPrestamo;
        }

        // Insertamos un prestamo en la base de datos
        public function insertarPrestamo($idUsu, $idAmigo, $idJuego, $fecha, $devuelto){
            $consulta = "INSERT INTO prestamos (id_Usu, id_Amigo, id_Juego, fecha_inicio, devuelto) VALUES (?,?,?,?,?)";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("iiiss", $idUsu, $idAmigo, $idJuego, $fecha, $devuelto);
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

        // Seleccionamos un prestamo en concreto para poder modificarlo
        public function seleccionPrestamo($idUsu, $nomTit){
            $consulta = "SELECT prestamos.id, amigos.nombre, juegos.titulo, juegos.url, prestamos.fecha_inicio, prestamos.devuelto 
                        FROM usuarios, amigos, juegos, prestamos 
                        WHERE prestamos.id_Usu = usuarios.id AND prestamos.id_Amigo = amigos.id AND prestamos.id_Juego = juegos.id AND prestamos.id_Usu = ? AND (juegos.titulo = ? OR amigos.nombre = ?)";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("iss", $idUsu, $nomTit, $nomTit);
            $sentencia->bind_result($IdP, $Anom, $Jutit, $Jurl, $Finicio, $Dev);
            $infoPrestamo = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($infoPrestamo, [$IdP, $Anom, $Jutit, $Jurl, $Finicio, $Dev]);
            };
            $sentencia->close();
            return $infoPrestamo;
        }

        // Modificamos un prestamo en concreto para poder devolverlo
        public function devolverPrestamo($idPrestamo){
            $consulta = "UPDATE prestamos SET devuelto = 1 WHERE prestamos.id = ?";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("i", $idPrestamo);
            $sentencia->execute();
            if($sentencia->affected_rows == 1){
                $bool = true;
            }else{
                $bool = false;
            }
            $sentencia->close();
            return $bool;
        }
    }
?>