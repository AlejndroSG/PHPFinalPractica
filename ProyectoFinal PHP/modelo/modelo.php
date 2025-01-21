<?php
    function set_cookie(String $nom, $val){
        setcookie($nom, $val, time()+(86400*30));
    }

    function unset_cookie(String $nom){
        $comp = false;

        if(isset($_COOKIE[$nom])){
            setcookie($nom, "", time()-30);
            $comp = true;
        }
        return $comp;
    }

    function start_session(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }

    function set_session(String $nom, $val){
        start_session();
        $_SESSION[$nom] = $val;
    }

    function get_session(String $nom){
        start_session();
        return $_SESSION[$nom];
    }
    
    function unset_session(){
        start_session();
        session_unset();
        session_destroy();
    }

    function is_session(String $nom){
        start_session();
        $isset = isset($_SESSION[$nom]);

        return $isset;
    }

    require_once("../../../cred.php");

    class db{
        private $conn;
        public function __construct(){
            $this->conn = new mysqli("localhost", USUARIO_CON, PSW_CON, "db_escuela");
        }

        public function getConn() {
            return $this->conn;
        }
        
        public function compCredenciales(String $nom, String $psw){
            $sentencia = "SELECT count(*) FROM usuarios WHERE nomUsu = ? AND passwd = ?"; 
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