<?php

    function compUsu(){
        require_once("../modelo/modelo.php");
        $modelo = new db();

        if($modelo->compCredenciales($_POST["nom"], $_POST["psw"])){
            session_start();
            $_SESSION["nom"] = $_POST["nom"];
            $_SESSION["psw"] = $_POST["psw"];
            require_once("../modelo/usuarios.class.php");
            $usu = new usuarios();
            $id = $usu->getId($_SESSION["nom"]);
            $_SESSION["id"] = $id;
            require_once("../modelo/amigos.class.php");
            $amigo = new amigos();
            $listaAmigos = $amigo->listarAmigos($_SESSION["nom"]);
            require_once("../header&footer/head.html");
            require_once("../header&footer/header.html");
            require_once("../vistas/amigos.php");
            require_once("../header&footer/footer.html");
        }else{
            $err = "<p style='color:red'>El usuario o la contraseña son incorrectos</p>";
            require_once("../vistas/login.php");
        }
    }


    function formInsertarAmigo(){
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/insertarAmigo.php");
        require_once("../header&footer/footer.html");
    }

    function insertarAmigo(){
        session_start();
        require_once("../modelo/amigos.class.php");
        $amigo = new amigo();
        if($amigo->insertAmigo($_SESSION["id"],$_POST["nombre"],$_POST["apell"],$_POST["f_Nac"])){
            $msg = "<p style='color:green'>Amigo insertado correctamente</p>";
        }else{
            $msg = "<p style='color:red'>Error al insertar amigo</p>";
        }
        $listaAmigos = $amigo->listarAmigos($_SESSION["nom"]);
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/amigos.php");
        require_once("../header&footer/footer.html");
    }

    if(!isset($_REQUEST["action"])){
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/login.php");
        require_once("../header&footer/footer.html");
    }else{
        $action = $_REQUEST["action"];
        $action();
    }
?>