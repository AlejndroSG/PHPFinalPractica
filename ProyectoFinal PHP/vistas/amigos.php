    <main>
        <a href="index.php?action=formInsertarAmigo">Insertar Amigos</a><a>Buscar Amigos</a>
        <?php
            echo "<table border='1'>";
                echo "<tr><th>Nombre</th><th>Apellidos</th><th>Fecha de nacimiento</th></tr>";
                    foreach ($listaAmigos as $key => $value) {
                        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td></tr>";
                    }
            echo "</table>";
        ?>
    </main>