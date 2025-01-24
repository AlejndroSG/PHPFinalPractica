    <main>
        <a href="index.php?action=formInsertarAmigo">Insertar Amigos</a><a>Buscar Amigos</a>
        <form action="index.php?action=modificarAmigo" method="post">
            <?php
                echo "<table border='1'>";
                    echo "<tr><th>Nombre</th><th>Apellidos</th><th>Fecha de nacimiento</th></tr>";
                        foreach ($listaAmigos as $key => $value) {
                            ?>
                                <?php
                                    echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td><input type='radio' name='id' value='$value[3]'>  </td></tr>";
                                ?>
                            <?php
                        }
                        echo "</table>";
                if(isset($msg)) echo $msg;
        W    ?>
        <input type="submit" value="Modificar" name="modificar">
        </form>
    </main>