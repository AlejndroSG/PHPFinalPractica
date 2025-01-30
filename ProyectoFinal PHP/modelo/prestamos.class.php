<?php
    require_once("modelo.php");

    class prestamos{
        public $db;
        public $conn;

        public function __construct(){
            $this->db = new db();
            $this->conn = $this->db->getConn();
        }

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
    }
?>