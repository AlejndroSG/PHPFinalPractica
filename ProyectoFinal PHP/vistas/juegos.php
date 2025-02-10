<main>
    <a href="../controladores/index.php?action=fromInsertarJuego">Insertar Juego</a>
    <a href="../controladores/index.php?action=formBuscarJuego">Buscar Juegos</a>
    <form action="index.php?action=vistaModificarJuego" method="post">
        <?php
            echo "<table border='1'>";
                echo "<tr><th>Imagen</th><th>Titulo</th><th>Plataforma</th><th>Fecha de Lanzamiento</th><th>Modificar</th></tr>";
                    foreach ($juegos as $key => $value) {
                        ?>
                            <?php
                                echo "<tr><td><img src='$value[1]'></td><td>$value[2]</td><td>$value[3]</td><td>$value[4]</td><td><input type='radio' name='idJuego' value='$value[0]' required></td></tr>";
                            ?>
                        <?php
                    }
                    echo "</table>";
            if(isset($msg)) echo $msg;
        ?>
    <input type="submit" value="Modificar" name="modificar">
    </form>
</main>