<main>
<audio id="audio" src="../audio/inicio.mp3" controls autoplay hidden></audio>
    <form action="../controladores/index.php?action=iniciarSesion" method="post">
        <h1>Inicia Sesión</h1>

        <div>
            <label for="floatingInput">Nombre de Usuario</label>
            <br>
            <input type="text" name="nom" value=<?php if(isset($_COOKIE["nom"])) echo $_COOKIE["nom"] ?>>
        </div>
        <div>
            <label for="floatingPassword">Contraseña</label>
            <br>
            <input type="password" name="psw" placeholder="Contraseña">
        </div>

        <div>
            <label for="flexCheckDefault">Recuerdame</label>
            <input type="checkbox" name="rec" <?php if(isset($_COOKIE["nom"])) echo "checked"; ?> id="flexCheckDefault">
        </div>
        <button value="Enviar" name="fini" type="submit">Iniciar Sesión</button>
    </form>
    <script>
  document.addEventListener('click', function() {
    document.getElementById('audio').play();
  });
</script>

    <?php if(isset($err)) echo $err; ?>
</main>