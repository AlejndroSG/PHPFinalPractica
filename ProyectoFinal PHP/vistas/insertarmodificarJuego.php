<main>
    <?php
        if(isset($_POST["modificar"])){
            echo "<form action='../controladores/index.php?action=modificarJuego' method='post' enctype='multipart/form-data'>";
                echo "<table border='1'>";
                    echo "<input type='hidden' name='idJuego' value='$idJuego'>";
                    echo "<tr>";
                        echo "<td>";
                            echo "<label>Nueva Imagen</label><br>";
                            echo "<input type='file' name='imgnew' value='$juego[1]'>";
                        echo "</td>";
                        echo "<td>";
                            echo "<label>Nuevo Título</label><br>";
                            echo "<input type='text' name='titnew' value='$juego[2]'>";
                        echo "</td>";
                        echo "<td>";
                            echo "<label>Nueva Plataforma</label><br>";
                            echo "<input type='text' name='platnew' value='$juego[3]'>";
                        echo "</td>";
                        echo "<td>";
                            echo "<label>Nuevo Lanzamiento</label><br>";
                            echo "<input type='text' name='lanznew' value='$juego[4]'>";
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
        if(isset($msg)) echo $msg;
        ?>
    <a href="index.php?action=volverJuegos">Atrás</a>
</main>