<?php
    require_once("../../../../cred.php");

    class db{
        private $conn;
        public function __construct(){
            $this->conn = new mysqli("localhost", USUARIO_CON, PSW_CON, "proyectoamigos");
        }

        public function getConn() {
            return $this->conn;
        }
        
        public function compCredenciales(String $nom, String $psw){
            $sentencia = "SELECT count(*) FROM usuarios WHERE nombre = ? AND pswd = ?"; 
            $consulta = $this->conn->prepare($sentencia);
            $consulta->bind_param("ss", $nom, $psw);
            $consulta->bind_result($count);
            $consulta->execute();

            $consulta->fetch();

            $existe = false;

            if($count == 1){
                $existe = true;
            }

            $consulta->close();
            return $existe;
        }

        public function checkUsuario(String $nom){
            $sentencia = "SELECT count(*) FROM usuarios WHERE nomUsu = ?"; 
            $consulta = $this->conn->prepare($sentencia);
            $consulta->bind_param("s", $nom);
            $consulta->bind_result($count);
            $consulta->execute();

            $consulta->fetch();

            $existe = false;

            if($count == 1){
                $existe = true;
            }

            $consulta->close();
            return $existe;
        }

        public function registrarUsu(String $nom, String $psw){
            $sentencia = "INSERT INTO usuarios VALUES (?,?)";
            $consulta = $this->conn->prepare($sentencia);
            $consulta->bind_param("ss", $nom, $psw);
            
            $consulta->execute();

            $res = false;
            if($consulta->affected_rows == 1){
                $res = true;
            }

            $consulta->close();

            return $res;
        }
    }
?>