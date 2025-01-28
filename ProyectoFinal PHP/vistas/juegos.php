<main class="text-center">
    <a href="../controladores/index.php?action=fromInsertarJuego" class="btn btn-danger btn-sm mb-3 text-center mx-auto">Insertar Juego</a>
    <a href="../controladores/index.php?action=formBuscarJuego" class="btn btn-danger btn-sm mb-3 mx-3">Buscar Juegos</a>
    <form action="index.php?action=vistaModificarAmigo" method="post" class="container mt-3 mb-3 w-50 text-center mx-auto">
        <?php
            echo "<table border='1' class='table table-striped table-dark table-hover table-bordered table-sm text-center'>";
                echo "<tr><th>Imagen</th><th>Titulo</th><th>Plataforma</th><th>Fecha de Lanzamiento</th><th>Modificar</th></tr>";
                    foreach ($juegos as $key => $value) {
                        ?>
                            <?php
                                echo "<tr><td><img src='$value[1]'></td><td>$value[2]</td><td>$value[3]</td><td>$value[4]</td><td><input type='radio' name='idAmigo' value='$value[3]' required></td></tr>";
                            ?>
                        <?php
                    }
                    echo "</table>";
            if(isset($msg)) echo $msg;
        ?>
    <input type="submit" value="Modificar" name="modificar">
    </form>
</main>