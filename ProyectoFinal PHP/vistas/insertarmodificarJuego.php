<main>
    <?php
        if(isset($_POST["modificar"])){
            echo "<form action='../controladores/index.php?action=modificarJuego' method='post'>";
                echo "<table border='1'>";
                    echo "<input type='hidden' name='idJuego' value='$idJuego'>";
                    echo "<tr>";
                        echo "<td>";
                            echo "<label>Nuevo Nombre</label><br>";
                            echo "<input type='text' name='nombreModif' value='$amigo[0]'>";
                        echo "</td>";
                        echo "<td>";
                            echo "<label>Nuevo Apellido</label><br>";
                            echo "<input type='text' name='apellModif' value='$amigo[1]'>";
                        echo "</td>";
                        echo "<td>";
                            echo "<label>Nueva Fecha</label><br>";
                            echo "<input type='date' name='fechaModif' value='$amigo[2]'>";
                        echo "</td>";
                    echo "</tr>";
                echo "</table>";
                echo "<input type='submit' value='Modificar' name='modificar'>";
            echo "</form>";
        }else{
    ?>
    <form action="../controladores/index.php?action=insertarJuego" method="post" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal">NUEVO JUEGO</h1>
        <div class="form-floating">
            <label for="floatingInput">Título</label>
            <input type="text" class="form-control" name="tit">
        </div>
        <div class="form-floating">
            <label for="floatingInput">Plataforma</label>
            <input type="text" class="form-control" name="plat">
        </div>
        <div class="form-floating">
            <label for="floatingInput">Año de edición</label>
            <input type="text" class="form-control" name="anio">
        </div>
        <div class="form-floating">
            <label for="floatingInput">Foto del juego</label>
            <input type="file" class="form-control" name="foto">
        </div>
        <button class="btn btn-primary w-100 py-2" value="Enviar" type="submit">Enviar</button>
    </form>

    <?php
        }
        ?>
    <a href="index.php?action=volverJuegos">Atrás</a>
</main>