<main>
    <?php
        if(isset($_POST["modificar"])){
            echo "<h1>Modificando juego</h1>";
            echo "<form action='../controladores/index.php?action=modificarJuego' method='post' enctype='multipart/form-data'>";
                echo "<table border='1'>";
                    echo "<input type='hidden' name='idJuego' value='$idJuego'>";
                    echo "<tr>";
                        echo "<td>";
                            echo "<label>Nueva Imagen</label><br>";
                            echo "<input type='file' name='imgnew' value='$juego[1]'>";
                            echo "<img src='$juego[1]'>";
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
        <h1>NUEVO JUEGO</h1>
        <div>
            <label for="floatingInput">Título</label>
            <br>
            <input type="text" name="tit">
        </div>
        <div>
            <label for="floatingInput">Plataforma</label>
            <br>
            <input type="text" name="plat">
        </div>
        <div>
            <label for="floatingInput">Año de edición</label>
            <br>
            <input type="text" name="anio">
        </div>
        <div>
            <label for="floatingInput">Foto del juego</label>
            <br>
            <input type="file" name="foto">
        </div>
        <button value="Enviar" type="submit">Enviar</button>
    </form>

    <?php
        }
        if(isset($msg)) echo $msg;
        ?>
    <a href="index.php?action=volverJuegos">Atrás</a>
</main>