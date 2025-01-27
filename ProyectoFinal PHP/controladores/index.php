<?php
    function iniciarSesion(){
        require_once("../modelo/modelo.php");
        $modelo = new db();

        if($modelo->compCredenciales($_POST["nom"], $_POST["psw"])){
            if(session_status() == PHP_SESSION_NONE){
                // require_once("../modelo/usuarios.class.php");
                session_start();
                $_SESSION["nom"] = $_POST["nom"];
            }
            require_once("../modelo/usuarios.class.php");
            $usu = new usuarios();
            $id = $usu->getId($_SESSION["nom"]);
            $_SESSION["id"] = $id;
            header("Location:../controladores/index.php?action=listarAmigos");
        }else{
            $err = "<p style='color:red'>El usuario o la contraseña son incorrectos</p>";
            require_once("../header&footer/head.html");
            require_once("../header&footer/header.html");
            require_once("../vistas/login.php");
            require_once("../header&footer/footer.html");
        }
    }
    
    function listarAmigos($msg = ""){
            require_once("../modelo/amigos.class.php");

            if(session_status() == PHP_SESSION_NONE) session_start();

            $amigo = new amigos();
            $listaAmigos = $amigo->listarAmigos($_SESSION["nom"]);
            require_once("../header&footer/head.html");
            require_once("../header&footer/header.html");
            require_once("../vistas/amigos.php");
            require_once("../header&footer/footer.html");
    }

    function volverAmigos(){
        listarAmigos();
    }


    function formInsertarAmigo(){
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/insertarmodificarAmigo.php");
        require_once("../header&footer/footer.html");
    }

    function insertarAmigo(){
        session_start();
        require_once("../modelo/amigos.class.php");
        $amigo = new amigos();
        if($amigo->insertAmigo($_SESSION["id"],$_POST["nom"],$_POST["apell"],formatearFecha($_POST["fecha"]))){
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

    function formatearFecha($fecha){
        $fecha = str_replace('-', '/', $fecha); // Cambia los guiones por barras para que la función date funcione correctamente
        return date('Y-m-d', strtotime($fecha));
    }

    function vistaModificarAmigo(){
        require_once("../modelo/amigos.class.php");
        $amigo = new amigos();
        $idAmigo = $_POST["idAmigo"];
        $amigo = $amigo->seleccionarAmigo($_POST["idAmigo"]);
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/insertarmodificarAmigo.php");
        require_once("../header&footer/footer.html");
    }
    function modificarAmigo(){
        session_start();
        require_once("../modelo/amigos.class.php");
        $amigo = new amigos();
        $comprobar = $amigo->modifAmigo($_SESSION["id"], $_POST["nombreModif"], $_POST["apellModif"], formatearFecha($_POST["fechaModif"]), $_POST["idAmigo"]);

        $msg = "";

        if($comprobar){
            $msg = "<p style='color: green'>Se ha modificado el usuario correctamente</p>";
        }

        listarAmigos($msg);
    }

    function formBuscarAmigo($amigoSeleccionado = ""){
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/buscarAmigo.php");
        require_once("../header&footer/footer.html");
    }

    function mostrarAmigos(){
        session_start();
        require_once("../modelo/amigos.class.php");
        $amigo = new amigos();
        $amigoSeleccionado = $amigo->seleccionAmigo($_POST["nomApell"], $_SESSION["id"]);
        formBuscarAmigo($amigoSeleccionado);
    }

    function salir(){
        session_start();
        session_destroy();
        header("Location:../controladores/index.php");
    }

    if(!isset($_REQUEST["action"])){
        require_once("../header&footer/head.html");
        // require_once("../header&footer/header.html");
        require_once("../vistas/login.php");
        require_once("../header&footer/footer.html");
    }else{
        $action = $_REQUEST["action"];
        $action();
    }
?>