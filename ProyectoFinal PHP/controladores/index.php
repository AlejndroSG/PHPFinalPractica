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
            $listaAmigos = $amigo->listarAmigos($_SESSION["id"]);
            require_once("../header&footer/head.html");
            require_once("../header&footer/header.html");
            require_once("../vistas/amigos.php");
            require_once("../header&footer/footer.html");
    }

    function volverAmigos(){
        listarAmigos();
    }
    function volverJuegos(){
        listarJuegos();
    }
    function volverPrestamos(){
        listarPrestamos();       
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
        $fecha = formatearFecha($_POST["fecha"]);

        if($amigo->insertAmigo($_SESSION["id"],$_POST["nom"],$_POST["apell"], $fecha)){
            $msg = "<p style='color:green'>Amigo insertado correctamente</p>";
        }else{
            $msg = "<p style='color:red'>Error al insertar amigo</p>";
        }
        $listaAmigos = $amigo->listarAmigos($_SESSION["id"]);
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/amigos.php");
        require_once("../header&footer/footer.html");
    }

    function formatearFecha($fecha){
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

        $comprobar = $amigo->modifAmigo(
            $_SESSION["id"], $_POST["nombreModif"],
             $_POST["apellModif"], 
             formatearFecha($_POST["fechaModif"]), 
             $_POST["idAmigo"]);

        $msg = "";

        if($comprobar){
            $msg = "<p style='color: green'>Se ha modificado el usuario correctamente</p>";
        }

        listarAmigos($msg);
    }

    function vistaModificarJuego(){
        require_once("../modelo/juegos.class.php");
        $juego = new juegos();
        $idJuego = $_POST["idJuego"];
        $juego = $juego->seleccionarJuego($_POST["idJuego"]);
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/insertarmodificarJuego.php");
        require_once("../header&footer/footer.html");
    }

    function formBuscarAmigo($amigoSeleccionado = ""){
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/buscarAmigo.php");
        require_once("../header&footer/footer.html");
    }

    function formBuscarJuego($juegos = ""){
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/buscarJuego.php");
        require_once("../header&footer/footer.html");
    }

    function fromInsertarJuego(){
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/insertarmodificarJuego.php");
        require_once("../header&footer/footer.html");   
    }

    function formBuscarPrestamo(){
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/buscarPrestamo.php");
        require_once("../header&footer/footer.html");
    }

    function mostrarAmigos(){
        session_start();
        require_once("../modelo/amigos.class.php");
        $amigo = new amigos();
        $amigoSeleccionado = $amigo->seleccionAmigo($_POST["nomApell"], $_SESSION["id"]);
        formBuscarAmigo($amigoSeleccionado);
    }

    function mostrarJuegos(){
        session_start();
        require_once("../modelo/juegos.class.php");
        $juego = new juegos();
        $juegos = $juego->seleccionJuego(strtoupper($_POST["titPlat"]), $_SESSION["id"]);
        formBuscarJuego($juegos);
    }

    function mostrarPrestamos(){
        session_start();
        require_once("../modelo/prestamos.class.php");
        $prestamo = new prestamos();
        $prestamos = $prestamo->seleccionPrestamo($_SESSION["id"], $_POST["nomTit"]);
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/prestamos.php");
        require_once("../header&footer/footer.html");
    }

    function modificarJuego(){
        session_start();
        require_once("../modelo/juegos.class.php");
        $juego = new juegos();
        $comprobar = $juego->modificarJuego($_SESSION["id"], compRuta($_FILES["imgnew"]["tmp_name"], $_FILES["imgnew"]["name"]), $_POST["titnew"], $_POST["platnew"], $_POST["lanznew"], $_POST["idJuego"]);

        $msg = "";

        if($comprobar){
            $msg = "<p style='color: green'>Se ha modificado el juego correctamente</p>";
        }

        listarJuegos($msg);
    }

    function listarJuegos($msg = ""){
        if(session_status() == PHP_SESSION_NONE) session_start();
        require_once("../modelo/juegos.class.php");
        $juego = new juegos();
        $juegos = $juego->listarJuegos($_SESSION["id"]);
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/juegos.php");
        require_once("../header&footer/footer.html");
    }

    function listarPrestamos(){
        if(session_status() == PHP_SESSION_NONE) session_start();
        require_once("../modelo/prestamos.class.php");
        $prestamo = new prestamos();
        $prestamos = $prestamo->listarPrestamos($_SESSION["id"]);
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/prestamos.php");
        require_once("../header&footer/footer.html");
    }

    function formInsertarPrestamo(){
        if(session_status() == PHP_SESSION_NONE) session_start();
        require_once("../modelo/prestamos.class.php");
        require_once("../modelo/amigos.class.php");
        require_once("../modelo/juegos.class.php");
        $prestamo = new prestamos();
        $prestamos = $prestamo->listarPrestamos($_SESSION["id"]);
        $amigos = new amigos();
        $amigos = $amigos->listarAmigos($_SESSION["id"]);
        $juegos = new juegos();
        $juegos = $juegos->listarJuegos($_SESSION["id"]);
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/insertarmodificarPrestamo.php");
        require_once("../header&footer/footer.html");
    }

    function insertarPrestamo(){
        session_start();
        require_once("../modelo/prestamos.class.php");
        $prestamo = new prestamos();
        $msg;
        if($prestamo->insertarPrestamo($_SESSION["id"], $_POST["amigo"], $_POST["juego"], $_POST["fecha"], $_POST["devuelto"])){
            $msg = "<p style='color: green'>Prestamo insertado correctamente</p>";
        }else{
            $msg = "<p style='color: red'>Prestamo no insertado</p>";
        };
        listarPrestamos($msg);
    }

    function compRuta($nombreTemporal, $nombre){
        if(session_status() == PHP_SESSION_NONE) session_start();
        $rutaorigen = $nombreTemporal;
        $rutadestino = "../img/".$_SESSION["nom"]."/";
        
        if(!file_exists($rutadestino)){
            mkdir($rutadestino);
        }
        $rutadestino.= $nombre;
        move_uploaded_file($rutaorigen, $rutadestino);
        
        return $rutadestino;
    }

    function insertarJuego(){
        $url = compRuta($_FILES["foto"]["tmp_name"], $_FILES["foto"]["name"]);
        require_once("../modelo/juegos.class.php");
        $juego = new juegos();
        $msg;
        if($juego->insertarJuego($url, $_POST["tit"], $_POST["plat"], $_POST["anio"], $_SESSION["id"])){
            $msg = "<p style='color: green'>Juego insertado correctamente</p>";
        }else{
            $msg = "<p style='color: red'>Juego no insertado</p>";
        };
        listarjuegos($msg);
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