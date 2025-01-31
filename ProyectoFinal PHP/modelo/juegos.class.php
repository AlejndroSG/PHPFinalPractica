<?php
    require_once("modelo.php");

    class juegos{
        public $db;
        public $conn;

        public function __construct(){
            $this->db = new db();
            $this->conn = $this->db->getConn();
        }

        public function listarJuegos($id){
            $consulta = "SELECT juegos.id, juegos.url, juegos.titulo, juegos.plataforma, juegos.lanzamiento FROM juegos WHERE id_Usu = ?";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("i", $id);
            $sentencia->bind_result($idJuegos, $url, $titulo, $plataf, $lanza);
            $infoJuegos = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($infoJuegos, [$idJuegos, $url, $titulo, $plataf, $lanza]);
            };
            $sentencia->close();
            return $infoJuegos;
        }

        public function listarJuegosNoPrestados($id){
            $consulta = "SELECT juegos.id, juegos.url, juegos.titulo, juegos.plataforma, juegos.lanzamiento
            FROM juegos
            WHERE juegos.id_Usu = ? and juegos.id not in (select id_juego from prestamos where prestamos.devuelto = 0)";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("i", $id);
            $sentencia->bind_result($idJuegos, $url, $titulo, $plataf, $lanza);
            $infoJuegos = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($infoJuegos, [$idJuegos, $url, $titulo, $plataf, $lanza]);
            };
            $sentencia->close();
            return $infoJuegos;
        }

        public function seleccionarJuego($idJuego){
            $consulta = "SELECT juegos.id, juegos.url, juegos.titulo, juegos.plataforma, juegos.lanzamiento FROM juegos WHERE juegos.id = ?";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("i", $idJuego);
            $sentencia->bind_result($idJuegos, $url, $titulo, $plataf, $lanza);
            $sentencia->execute();
            $sentencia->fetch();
            $sentencia->close();
            return [$idJuegos, $url, $titulo, $plataf, $lanza];
        }

        public function insertarJuego($url, $tit, $plat, $anio, $id_Usu){
            $consulta = "INSERT INTO juegos (url, titulo, plataforma, lanzamiento, id_Usu) values (?,?,?,?,?)";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("ssssi", $url, $tit, $plat, $anio, $id_Usu);
            $sentencia->execute();
            $bol;
            if($sentencia->affected_rows == 1){
                $bol = true;
            }else{
                $bol = false;
            }
            $sentencia->close();
            return $bol;
        }

        public function seleccionJuego($nomJuego, $idUsu){
            $consulta = "SELECT juegos.id, juegos.url, juegos.titulo, juegos.plataforma, juegos.lanzamiento FROM juegos WHERE juegos.id_Usu = ? and (juegos.titulo = ? or juegos.plataforma = ?)";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("iss", $idUsu, $nomJuego, $nomJuego);
            $sentencia->bind_result($idJuegos, $url, $titulo, $plataf, $lanza);
            $infoJuegos = array();
            $sentencia->execute();
            while($sentencia->fetch()){
                array_push($infoJuegos, [$idJuegos, $url, $titulo, $plataf, $lanza]);
            };
            $sentencia->close();
            return $infoJuegos;
        }

        public function modificarJuego($id_usu, $url, $tit, $plat, $anio, $id_juego){
            $consulta = "UPDATE juegos SET url = ?, titulo = ?, plataforma = ?, lanzamiento = ? WHERE id_Usu = ? AND id = ?";
            $sentencia = $this->conn->prepare($consulta);
            $sentencia->bind_param("ssssii", $url, $tit, $plat, $anio, $id_usu, $id_juego);
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