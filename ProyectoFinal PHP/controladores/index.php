<?php

    // FUNCIÓN PRINCIPAL PARA INICIAR SESIÓN
    function iniciarSesion(){
        require_once("../modelo/modelo.php");
        $modelo = new db();

        if($modelo->compCredenciales($_POST["nom"], $_POST["psw"])){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
                $_SESSION["nom"] = $_POST["nom"];
            }
            if(isset($_POST["rec"])){
                $_COOKIE["nom"] = $_POST["nom"];
                setcookie("nom", $_POST["nom"], time() + (86400 * 30), "/");
            }else{
                unset($_COOKIE["nom"]);
                setcookie("nom", "", time() - 3600, "/");
            }
            require_once("../modelo/usuarios.class.php");
            $usu = new usuarios();
            $idTipo = $usu->getId($_SESSION["nom"]);
            if($idTipo[0][1] == 0){
                $_SESSION["tipo"] = true;
            }else{
                $_SESSION["tipo"] = false;
            }
            $_SESSION["id"] = $idTipo[0][0];
            header("Location:../controladores/index.php?action=listarAmigos");
        }else{
            $err = "<p style='color:red'>El usuario o la contraseña son incorrectos</p>";
            require_once("../header&footer/head.html");
            require_once("../header&footer/header.html");
            require_once("../vistas/login.php");
            require_once("../header&footer/footer.html");
        }
    }
        
    // Todas las funciones para volver atrás, es decir, para los botones de volver
    function volverAmigos(){
        listarAmigos();
    }
    function volverJuegos(){
        listarJuegos();
    }
    function volverPrestamos(){
        listarPrestamos();       
    }
    function volverUsuarios(){
        listarUsuarios();
    }
    
    
    // Funciones de los usuarios, para mostrarle el formulario y para obtener la respuesta e insertar el usuario
    // Con esta función se listan los usuarios del sistema (Administrador)
    function listarUsuarios($msg = ""){
        // No compruebo la sesión porque solo el administrador puede acceder a esta función
        require_once("../modelo/usuarios.class.php");
        $usu = new usuarios();
        $listaUsuarios = $usu->listarUsuarios();
        require_once("../header&footer/head.html");
        require_once("../header&footer/headerAdmin.html");
        require_once("../vistas/usuarios.php");
        require_once("../header&footer/footer.html");
    }
    function formInsertarUsuario(){
        require_once("../header&footer/head.html");
        require_once("../header&footer/headerAdmin.html");
        require_once("../vistas/insertarmodificarUsuario.php");
        require_once("../header&footer/footer.html");
    }
    function insertarUsuario(){
        require_once("../modelo/usuarios.class.php");
        $usu = new usuarios();
        if($usu->insertarUsuario($_POST["nom"], $_POST["pswd"])){
            $msg = "<p style='color:green'>Usuario insertado correctamente</p>";
        }else{
            $msg = "<p style='color:red'>Error al insertar usuario</p>";
        }
        listarUsuarios($msg);
    }
    function vistaModificarUsuario(){
        require_once("../modelo/usuarios.class.php");
        $usu = new usuarios();
        $usuario = $usu->seleccionarUsuario($_POST["nomUsu"]); 
        require_once("../header&footer/head.html");
        require_once("../header&footer/headerAdmin.html");
        require_once("../vistas/insertarmodificarUsuario.php");
        require_once("../header&footer/footer.html");
    }
    function modificarUsuario(){
        require_once("../modelo/usuarios.class.php");
        $usu = new usuarios();
        if($usu->modificarUsuario($_POST["idUsu"], $_POST["nombreModif"], $_POST["pswdModif"])){
            $msg = "<p style='color:green'>Usuario modificado correctamente</p>";
        }else{
            $msg = "<p style='color:red'>Error al modificar usuario</p>";
        }
        listarUsuarios($msg);
    }
    function formBuscarUsuario($usuarioSeleccionado = "", $contrasena = "123456789"){
        require_once("../header&footer/head.html");
        require_once("../header&footer/headerAdmin.html");
        require_once("../vistas/buscarUsuario.php");
        require_once("../header&footer/footer.html");
    }
    function mostrarUsuarios(){
        require_once("../modelo/usuarios.class.php");
        $usu = new usuarios();
        $usuarios = $usu->seleccionarUsuario($_POST["nom"]);
        formBuscarUsuario($usuarios);
    }
    

    // Funciones de los amigos, para mostrarle el formulario y para obtener la respuesta e insertar el amigo
    function listarAmigos($msg = ""){
        require_once("../modelo/amigos.class.php");

        if(session_status() == PHP_SESSION_NONE) session_start();

        require_once("../header&footer/head.html");
        $amigo = new amigos();
        if($_SESSION["tipo"]){ //Comprobamos si el tipo es admin o usuario normal, para así poder listar los AMIGOS o los CONTACTOS
            $listaAmigos = $amigo->listarContactos();
            $admin = true;
            require_once("../header&footer/headerAdmin.html");
        }else{
            $listaAmigos = $amigo->listarAmigos($_SESSION["id"]);
            $admin = false;
            require_once("../header&footer/header.html");
        } 
        for ($i=0; $i < count($listaAmigos); $i++) { 
            reformatearFecha($listaAmigos[$i][2]); //Reformateamos la fecha de nacimiento, para imprimirlo en la tabla en formato español
        }
        require_once("../vistas/amigos.php");
        require_once("../header&footer/footer.html");
    }
    function formInsertarAmigo(){
        if(session_status() == PHP_SESSION_NONE) session_start();
        $admin = $_SESSION["tipo"];
        if($admin){
            require_once("../modelo/usuarios.class.php");
            $usu = new usuarios();
            $usuarios = $usu->listarUsuarios();
        }
        require_once("../header&footer/head.html");
        if($admin){
            require_once("../header&footer/headerAdmin.html");
        }else{
            require_once("../header&footer/header.html");
        }
        require_once("../vistas/insertarmodificarAmigo.php");
        require_once("../header&footer/footer.html");
    }
    function insertarAmigo(){
        session_start();
        require_once("../modelo/amigos.class.php");
        $amigo = new amigos();
        $fecha=$_POST["fecha"];
        if(isset($_POST["idUsuario"])){
            $id = $_POST["idUsuario"];
        }else{
            $id = $_SESSION["id"];
        };
        if(formatearFecha($_POST["fecha"])){
            if($amigo->insertAmigo($id, $_POST["nom"],$_POST["apell"], $fecha)){
                $msg = "<p style='color:green'>Amigo insertado correctamente</p>";
            }else{
                $msg = "<p style='color:red'>Error al insertar amigo</p>";
            }    
        }else{
            $msg = "<p style='color:red'>Error al insertar amigo</p>";
        }
        if($_SESSION["tipo"]){
            $listaAmigos = $amigo->listarContactos();
        }else{
            $listaAmigos = $amigo->listarAmigos($_SESSION["id"]);
        }
        require_once("../header&footer/head.html");
        $admin = $_SESSION["tipo"];
        if($admin){
            require_once("../header&footer/headerAdmin.html");
        }else{
            require_once("../header&footer/header.html");
        }
        require_once("../vistas/amigos.php");
        require_once("../header&footer/footer.html");
        
    }
    function vistaModificarAmigo(){
        if(session_status() == PHP_SESSION_NONE) session_start();
        require_once("../modelo/amigos.class.php");
        $amigo = new amigos();
        $idAmigo = $_POST["idAmigo"];
        $admin = $_SESSION["tipo"];
        require_once("../header&footer/head.html");
        if($_SESSION["tipo"]){
            require_once("../header&footer/headerAdmin.html");
            require_once("../modelo/amigos.class.php");
            $amigo = new amigos();
            $amigo = $amigo->seleccionarContacto($idAmigo);
            require_once("../modelo/usuarios.class.php");
            $usu = new usuarios();
            $usuarios = $usu->listarUsuarios();
        }else{
            $amigo = $amigo->seleccionarAmigo($_POST["idAmigo"]);
            require_once("../header&footer/header.html");
        }
        require_once("../vistas/insertarmodificarAmigo.php");
        require_once("../header&footer/footer.html");
    }
    function modificarAmigo(){
        session_start();
        require_once("../modelo/amigos.class.php");
        $amigo = new amigos();
        if(formatearFecha($_POST["fechaModif"])){
            if(!$_SESSION["tipo"]){
                $comprobar = $amigo->modifAmigo($_SESSION["id"], $_POST["nombreModif"], $_POST["apellModif"], $_POST["fechaModif"], $_POST["idAmigo"]);
            }else{
                $comprobar = $amigo->modifAmigo($_POST["idUsuario"], $_POST["nombreModif"], $_POST["apellModif"], $_POST["fechaModif"], $_POST["idAmigo"]);
            }
            $msg = "";
    
            if($comprobar){
                $msg = "<p style='color: green'>Se ha modificado el usuario correctamente</p>";
            }
        }else{
            $msg = "<p style='color:red'>La fecha introducida es posterior a la actual</p>";
        }
        
        listarAmigos($msg);
    }
    function formBuscarAmigo($amigoSeleccionado = ""){
        if(session_status() == PHP_SESSION_NONE) session_start();
        require_once("../header&footer/head.html");
        if($_SESSION["tipo"]){
            require_once("../header&footer/headerAdmin.html");
            $admin = true;
        }else{
            require_once("../header&footer/header.html");
        }
        require_once("../vistas/buscarAmigo.php");
        require_once("../header&footer/footer.html");
    }
    function mostrarAmigos(){
        session_start();
        require_once("../modelo/amigos.class.php");
        $amigo = new amigos();
        if(!$_SESSION["tipo"]){
            $amigoSeleccionado = $amigo->seleccionAmigo($_POST["nomApell"], $_SESSION["id"]);
        }else{
            $amigoSeleccionado = $amigo->seleccionContacto($_POST["nomApell"]);
        }
        reformatearFecha($amigoSeleccionado[0][2]);
        formBuscarAmigo($amigoSeleccionado);
    }

    // Funciones de los juegos, para mostrarle el formulario y para obtener la respuesta e insertar el juego
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
    function formBuscarJuego($juegos = ""){
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/buscarJuego.php");
        require_once("../header&footer/footer.html");
    }
    function mostrarJuegos(){
        session_start();
        require_once("../modelo/juegos.class.php");
        $juego = new juegos();
        $juegos = $juego->seleccionJuego(strtoupper($_POST["titPlat"]), $_SESSION["id"]);
        formBuscarJuego($juegos);
    }
    function modificarJuego(){
        session_start();
        require_once("../modelo/juegos.class.php");
        $juego = new juegos();
        $comprobar = $juego->modificarJuego($_SESSION["id"], compRuta($_FILES["imgnew"]["tmp_name"], $_FILES["imgnew"]["name"], $_POST["imgold"]), $_POST["titnew"], $_POST["platnew"], $_POST["lanznew"], $_POST["idJuego"]);

        $msg = "";

        if($comprobar){
            $msg = "<p style='color: green'>Se ha modificado el juego correctamente</p>";
        }

        listarJuegos($msg);
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
    function fromInsertarJuego(){
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/insertarmodificarJuego.php");
        require_once("../header&footer/footer.html");   
    }

    // Funciones de los prestamos, para mostrarlos y poder modificarlos, insertarlos etc
    function listarPrestamos($msg = ""){
        if(session_status() == PHP_SESSION_NONE) session_start();
        require_once("../modelo/prestamos.class.php");
        $prestamo = new prestamos();
        $prestamos = $prestamo->listarPrestamos($_SESSION["id"]);
        for ($i=0; $i < count($prestamos); $i++) { 
            reformatearFecha($prestamos[$i][4]);
            if($prestamos[$i][5] == 1){
                $prestamos[$i][5] = "Si";
            }else{
                $prestamos[$i][5] = "No";
            }
        }
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/prestamos.php");
        require_once("../header&footer/footer.html");
    }
    function mostrarPrestamos(){
        session_start();
        require_once("../modelo/prestamos.class.php");
        $prestamo = new prestamos();
        $prestamos = $prestamo->seleccionPrestamo($_SESSION["id"], $_POST["nomTit"]);
        for ($i=0; $i < count($prestamos); $i++) { 
            reformatearFecha($prestamos[$i][4]);
        }
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/prestamos.php");
        require_once("../header&footer/footer.html");
    }
    function formBuscarPrestamo(){
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/buscarPrestamo.php");
        require_once("../header&footer/footer.html");
    }
    function devolverPrestamo(){
        require_once("../modelo/prestamos.class.php");
        $prestamo = new prestamos();
        $idPrestamo = $_POST["idPrestamo"];
        if($prestamo->devolverPrestamo($idPrestamo)){
            $msg = "<p style='color:green'>Se ha devuelto el juego correctamente</p>";
        }else{
            $msg = "<p style='color:red'>Error al devolver el juego</p>";
        }
        listarPrestamos($msg);
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
        $juegos = $juegos->listarJuegosNoPrestados($_SESSION["id"]);
        require_once("../header&footer/head.html");
        require_once("../header&footer/header.html");
        require_once("../vistas/insertarmodificarPrestamo.php");
        require_once("../header&footer/footer.html");
    }
    function insertarPrestamo(){
        session_start();
        require_once("../modelo/prestamos.class.php");
        $prestamo = new prestamos();
        if(formatearFechaPosteriori($_POST["fecha"])){
            if($prestamo->insertarPrestamo($_SESSION["id"], $_POST["amigo"], $_POST["juego"], $_POST["fecha"], $_POST["devuelto"])){
                $msg = "<p style='color: green'>Prestamo insertado correctamente</p>";
            }else{
                $msg = "<p style='color: red'>Prestamo no insertado</p>";
            };
        }else{
            $msg = "<p style='color:red'>La fecha introducida es anterior a la actual</p>";
        }
        listarPrestamos($msg);
    }


    // Funciones para formatear TODAS las fechas del sistema
    // Formateamos la fecha a formato inglés para poder insertarla en la BD
    function formatearFecha(&$fecha){
        if(strtotime($fecha) < time()){
            $fecha = date('Y-m-d', strtotime($fecha));
            return true;
        }else{
            return false;
        }
    }
    // Reformateamos la fecha desde la BD a formato español para listarla en la tabla, pero que sea inferior a la actual
    function reformatearFecha(&$fecha){
        $fecha = date('d-m-Y', strtotime($fecha));
    }
    // Formateamos la fecha para poder insertarla en la BD, pero comprobando que sea posterior a la actual para los préstamos
    function formatearFechaPosteriori(&$fecha){
        if(strtotime($fecha) > time()){
            date('Y-m-d', strtotime($fecha));
            return true;
        }else{
            return false;
        }
    }


    // Función para comprobar la ruta de la imagen, y moverla a la carpeta correspondiente creándola en caso de que no exista
    function compRuta($nombreTemporal, $nombre, $urlAntigua = ""){
        if(session_status() == PHP_SESSION_NONE) session_start();
        $rutaorigen = $nombreTemporal;
        $rutadestino = "../img/".$_SESSION["nom"]."/";
        
        if(!file_exists($rutadestino)){
            mkdir($rutadestino);
        }
        $rutadestinoCompleta = $rutadestino . $nombre;
        move_uploaded_file($rutaorigen, $rutadestinoCompleta);
    
        // Eliminar la imagen antigua si la URL no está vacía
        if ($urlAntigua != "") {
            $rutaAntigua = $urlAntigua; // Usar la ruta completa proporcionada
            if (file_exists($rutaAntigua)) {
                unlink($rutaAntigua);
            }
        }
    
        return $rutadestinoCompleta;
    }

    // Función para salir de la sesión
    function salir(){
        session_start();
        session_destroy();
        header("Location:../controladores/index.php");
    }

    // Si no ha sido iniciado el action
    if(!isset($_REQUEST["action"])){
        require_once("../header&footer/head.html");
        require_once("../vistas/login.php");
        require_once("../header&footer/footer.html");
    }else{
        $action = $_REQUEST["action"];
        $action(); //La cabra del sistema, lo acciona absolutamente todo
    }
?>