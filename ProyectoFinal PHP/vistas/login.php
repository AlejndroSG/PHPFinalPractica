<main>
    <form action="../controladores/index.php?action=iniciarSesion" method="post">
        <h1 class="h3 mb-3 fw-normal">Inicia Sesión</h1>

        <div class="form-floating">
            <input type="text" class="form-control" name="nom" value=<?php if(isset($_COOKIE["usuario"])) echo $_COOKIE["usuario"] ?>>
            <label for="floatingInput">Nombre de Usuario</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="psw" placeholder="Contraseña">
            <label for="floatingPassword">Contraseña</label>
        </div>

        <div class="form-check text-start my-3">
        <input class="form-check-input" type="checkbox" name="rec" <?php if(isset($_COOKIE["usuario"])) echo "checked"; ?> id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            Recuerdame
        </label>
        </div>
        <button class="btn btn-primary w-100 py-2" value="Enviar" name="fini" type="submit">Iniciar Sesión</button>
    </form>

    <?php if(isset($err)) echo $err; ?>
</main>