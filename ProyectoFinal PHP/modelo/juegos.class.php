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
    }
?>