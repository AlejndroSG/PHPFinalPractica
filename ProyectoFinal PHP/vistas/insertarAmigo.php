<main>
    <form action="../controladores/index.php?action=insertarAmigo" method="post">
        <h1 class="h3 mb-3 fw-normal">NUEVO AMIGO</h1>

        <div class="form-floating">
            <label for="floatingInput">Nombre</label>
            <input type="text" class="form-control" name="nom">
        </div>
        <div class="form-floating">
            <label for="floatingInput">Apellidos</label>
            <input type="text" class="form-control" name="apell">
        </div>
        <div class="form-floating">
            <input type="date" class="form-control" name="fecha">
        </div>

        <button class="btn btn-primary w-100 py-2" value="Enviar" type="submit">Enviar</button>
    </form>

    <a href="index.php?action=volverAmigos">Atrás</a>
</main>