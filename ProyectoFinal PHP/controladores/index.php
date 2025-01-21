<?php

    function compUsu(){
        require_once("../modelo/modelo.php");
        $modelo = new db();
        $modelo->compCredenciales($_POST["nom"], $_POST["psw"]);

        if($modelo->compCredenciales($_POST["nom"], $_POST["psw"])){
            $modelo->start_session();
            $_SESSION["nom"] = $_POST["nom"];
            $_SESSION["psw"] = $_POST["psw"];
            $err = "De locos";
            require_once("../vistas/login.php");
        }else{
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