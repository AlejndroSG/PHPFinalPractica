<main>
    <form action="../controladores/index.php?action=insertarAmigo">
        <h1 class="h3 mb-3 fw-normal">NUEVO AMIGO</h1>

        <div class="form-floating">
            <label for="floatingInput">Nombre</label>
            <input type="text" class="form-control" name="nom">
        </div>
        <div class="form-floating">
            <label for="floatingInput">Apellidos</label>
            <input type="text" class="form-control" name="nom">
        </div>
        <div class="form-floating">
            <input type="date" class="form-control">
        </div>

        <button class="btn btn-primary w-100 py-2" value="Enviar" type="submit">Enviar</button>
    </form>
</main>