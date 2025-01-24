    <main>
        <?php
            if(isset($_POST["modificar"])){
                echo "<table border='1'>";
                    echo "<tr><th>Nombre</th><th>Apellidos</th><th>Fecha de nacimiento</th></tr>";
                    echo "<tr><td>$amigo[0]</td><td>$amigo[1]</td><td>$amigo[2]</td></tr>";
                echo "</table>";
            };
        ?>
        <a href="index.php?action=formInsertarAmigo">Insertar Amigos</a><a>Buscar Amigos</a>
        <form action="index.php?action=vistaModificarAmigo" method="post">
            <?php
                echo "<table border='1'>";
                    echo "<tr><th>Nombre</th><th>Apellidos</th><th>Fecha de nacimiento</th></tr>";
                        foreach ($listaAmigos as $key => $value) {
                            ?>
                                <?php
                                    echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td><input type='radio' name='idAmigo' value='$value[3]'>  </td></tr>";
                                ?>
                            <?php
                        }
                        echo "</table>";
                if(isset($msg)) echo $msg;
            ?>
        <input type="submit" value="Modificar" name="modificar">
        </form>
    </main>