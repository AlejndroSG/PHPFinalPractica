<?php

    function compUsu(){
        require_once("../modelo/modelo.php");
        $modelo = new db();
        $modelo->compCredenciales($_POST["nom"], $_POST["psw"]);

        if($modelo->compCredenciales($_POST["nom"], $_POST["psw"])){
            session_start();
            $_SESSION["nom"] = $_POST["nom"];
            $_SESSION["psw"] = $_POST["psw"];
            require_once("../modelo/amigos.class.php");
            $amigo = new amigos();
            $listaAmigos = $amigo->listarAmigos($_POST["nom"]);
            require_once("../vistas/amigos.php");
        }else{
            $err = "<p style='color:red'>El usuario o la contraseña son incorrectos</p>";
            require_once("../vistas/login.php");
        }
    }

    if(!isset($_REQUEST["action"])){
        require_once("../vistas/login.php");
    }else{
        $action = $_REQUEST["action"];
        $action();
    }
?>